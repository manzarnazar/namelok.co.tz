<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\CustomerLogic;
use App\CentralLogics\Helpers;
use App\CentralLogics\OrderLogic;
use App\Http\Controllers\Controller;
use App\Mail\Customer\OrderPlaced;
use App\Model\Coupon;
use App\Model\CustomerAddress;
use App\Model\DMReview;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Review;
use App\Models\GuestUser;
use App\Models\OfflinePayment;
use App\Models\OrderImage;
use App\Models\OrderPartialPayment;
use App\Traits\HelperTrait;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use function App\CentralLogics\translate;

class OrderController extends Controller
{
    use HelperTrait;
    public function __construct(
        private Coupon $coupon,
        private DMReview $deliverymanReview,
        private Order $order,
        private OrderDetail $orderDetail,
        private Product $product,
        private Review $review,
        private User $user
    ){}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function trackOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'phone' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $phone = $request->input('phone');
        $userId = (bool)auth('api')->user() ? auth('api')->user()->id : $request->header('guest-id');
        $userType = (bool)auth('api')->user() ? 0 : 1;

        $order = $this->order->find($request['order_id']);

        if (!isset($order)){
            return response()->json([
                'errors' => [['code' => 'order', 'message' => 'Order not found!']]], 404);
        }

        if (!is_null($phone)){
            if ($order['is_guest'] == 0){
                $trackOrder = $this->order
                    ->with(['customer', 'delivery_address'])
                    ->where(['id' => $request['order_id']])
                    ->whereHas('customer', function ($customerSubQuery) use ($phone) {
                        $customerSubQuery->where('phone', $phone);
                    })
                    ->first();
            }else{
                $trackOrder = $this->order
                    ->with(['delivery_address'])
                    ->where(['id' => $request['order_id']])
                    ->whereHas('delivery_address', function ($addressSubQuery) use ($phone) {
                        $addressSubQuery->where('contact_person_number', $phone);
                    })
                    ->first();
            }
        }else{
            $trackOrder = $this->order
                ->where(['id' => $request['order_id'], 'user_id' => $userId, 'is_guest' => $userType])
                ->first();
        }

        if (!isset($trackOrder)){
            return response()->json([
                'errors' => [['code' => 'order', 'message' => 'Order not found!']]], 404);
        }

        return response()->json(OrderLogic::track_order($request['order_id']), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function placeOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'order_amount' => 'required',
            'payment_method'=>'required',
            'delivery_address_id' => 'required',
            'order_type' => 'required|in:self_pickup,delivery',
            'branch_id' => 'required',
            'distance' => 'required',
            'is_partial' => 'required|in:0,1',
            'order_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
    
        if (count($request['cart']) <1) {
            return response()->json(['errors' => [['code' => 'empty-cart', 'message' => translate('cart is empty')]]], 403);
        }
    
        $userId = (bool)auth('api')->user() ? auth('api')->user()->id : $request->header('guest-id');
        $userType = (bool)auth('api')->user() ? 0 : 1;
    
        if(auth('api')->user()){
            $customer = $this->user->find(auth('api')->user()->id);
        }
    
        $minimumAmount = Helpers::get_business_settings('minimum_order_value');
        if ($minimumAmount > $request['order_amount']){
            $errors = [];
            $errors[] = ['code' => 'auth-001', 'message' => 'Order amount must be equal or more than '. $minimumAmount];
            return response()->json(['errors' => $errors], 401);
        }
    
        $maximumAmount = Helpers::get_business_settings('maximum_amount_for_cod_order');
        if ($request->payment_method == 'cash_on_delivery' && Helpers::get_business_settings('maximum_amount_for_cod_order_status') == 1 && ($maximumAmount < $request['order_amount'])){
            $errors = [];
            $errors[] = ['code' => 'auth-001', 'message' => 'For Cash on Delivery, order amount must be equal or less than '. $maximumAmount];
            return response()->json(['errors' => $errors], 401);
        }
    
        if($request->payment_method == 'wallet_payment' && Helpers::get_business_settings('wallet_status') != 1)
        {
            return response()->json(['errors' => [['code' => 'payment_method', 'message' => translate('customer_wallet_status_is_disable')]]], 403);
        }
    
        if($request->payment_method == 'wallet_payment' && $customer->wallet_balance < $request['order_amount'])
        {
            return response()->json([
                'errors' => [['code' => 'payment_method', 'message' => translate('you_do_not_have_sufficient_balance_in_wallet')]]], 403);
        }
    
        if ($request['is_partial'] == 1) {
            if (Helpers::get_business_settings('wallet_status') != 1){
                return response()->json(['errors' => [['code' => 'payment_method', 'message' => translate('customer_wallet_status_is_disable')]]], 403);
            }
            if (isset($customer) && $customer->wallet_balance > $request['order_amount']){
                return response()->json(['errors' => [['code' => 'payment_method', 'message' => translate('since your wallet balance is more than order amount, you can not place partial order')]]], 403);
            }
            if (isset($customer) && $customer->wallet_balance < 1){
                return response()->json(['errors' => [['code' => 'payment_method', 'message' => translate('since your wallet balance is less than 1, you can not place partial order')]]], 403);
            }
        }
    
        foreach ($request['cart'] as $c) {
            $product = $this->product->find($c['product_id']);
            if (count(json_decode($product['variations'], true)) > 0) {
                $type = $c['variation'][0]['type'];
                foreach (json_decode($product['variations'], true) as $var) {
                    if ($type == $var['type'] && $var['stock'] < $c['quantity']) {
                        $validator->getMessageBag()->add('stock', 'One or more product stock is insufficient!');
                    }
                }
            } else {
                if ($product['total_stock'] < $c['quantity']) {
                    $validator->getMessageBag()->add('stock', 'One or more product stock is insufficient!');
                }
            }
        }
    
        if ($validator->getMessageBag()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
    
        $freeDeliveryAmount = 0;
        if ($request['order_type'] == 'self_pickup'){
            $deliveryCharge = 0;
        } elseif (Helpers::get_business_settings('free_delivery_over_amount_status') == 1 && (Helpers::get_business_settings('free_delivery_over_amount') <= $request['order_amount'])){
            $deliveryCharge = 0;
            $freeDeliveryAmount = Helpers::get_delivery_charge($request['distance']);
        } else{
            $deliveryCharge = Helpers::get_delivery_charge($request['distance']);
        }
    
        $coupon = $this->coupon->active()->where(['code' => $request['coupon_code']])->first();
    
        if (isset($coupon)) {
            if ($coupon['coupon_type'] == 'free_delivery') {
                $freeDeliveryAmount = Helpers::get_delivery_charge($request['distance']);
                $couponDiscount = 0;
                $deliveryCharge = 0;
            } else {
                $couponDiscount = $request['coupon_discount_amount'];
            }
        }else{
            $couponDiscount = $request['coupon_discount_amount'];
        }
    
        if ($request['is_partial'] == 1) {
            $paymentStatus = ($request->payment_method == 'cash_on_delivery' || $request->payment_method == 'offline_payment') ? 'partially_paid' : 'paid';
        } else {
            $paymentStatus = ($request->payment_method == 'cash_on_delivery' || $request->payment_method == 'offline_payment') ? 'unpaid' : 'paid';
        }
    
        $orderStatus = ($request->payment_method == 'cash_on_delivery' || $request->payment_method == 'offline_payment') ? 'pending' : 'confirmed';
    
        try {
            DB::beginTransaction();
            $orderId = 100000 + Order::all()->count() + 1;
            $isWholesale = 0; // Default value for is_wholesale
    
            $or = [
                'id' => $orderId,
                'user_id' => $userId,
                'is_guest' => $userType,
                'order_amount' => $request['order_amount'],
                'coupon_code' =>  $request['coupon_code'],
                'coupon_discount_amount' => $couponDiscount,
                'coupon_discount_title' => $request->coupon_discount_title == 0 ? null : 'coupon_discount_title',
                'payment_status' => $paymentStatus,
                'order_status' => $orderStatus,
                'payment_method' => $request->payment_method,
                'transaction_reference' => $request->transaction_reference ?? null,
                'order_note' => $request['order_note'],
                'order_type' => $request['order_type'],
                'branch_id' => $request['branch_id'],
                'delivery_address_id' => $request->delivery_address_id,
                'time_slot_id' => $request->time_slot_id,
                'delivery_date' => $request->delivery_date,
                'delivery_address' => json_encode(CustomerAddress::find($request->delivery_address_id) ?? null),
                'date' => date('Y-m-d'),
                'delivery_charge' => $deliveryCharge,
                'payment_by' => $request['payment_method'] == 'offline_payment' ? $request['payment_by'] : null,
                'payment_note' => $request['payment_method'] == 'offline_payment' ? $request['payment_note'] : null,
                'free_delivery_amount' => $freeDeliveryAmount,
                'is_wholesale' => $isWholesale, // Add this line
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            $orderTimeSlotId = $or['time_slot_id'];
            $orderDeliveryDate = $or['delivery_date'];
    
            $totalTaxAmount = 0;
    
            foreach ($request['cart'] as $c) {
                $product = $this->product->find($c['product_id']);
    
                if ($product['maximum_order_quantity'] < $c['quantity']){
                    return response()->json(['errors' => $product['name']. ' '. translate('quantity_must_be_equal_or_less_than '. $product['maximum_order_quantity'])], 403);
                }
                if (isset($product['variations']) && count(json_decode($product['variations'], true)) > 0) {
                    $type = $c['variation'][0]['type'];
                    $price = 0;
                    foreach (json_decode($product['variations'], true) as $var) {
                        if ($type == $var['type']) {
                            $price = $var['price'];
                            if ($var['stock'] < $c['quantity']) {
                                return response()->json(['errors' => [['code' => 'stock', 'message' => 'Stock is insufficient for '.$product['name']]]], 403);
                            }
                        }
                    }
                } else {
                    $price = $product['unit_price'];
                    if ($product['total_stock'] < $c['quantity']) {
                        return response()->json(['errors' => [['code' => 'stock', 'message' => 'Stock is insufficient for '.$product['name']]]], 403);
                    }
                }
    
                $tax = $product['tax'];
                $totalTaxAmount += ($price * $c['quantity'] * $tax / 100);
    
                $productPrice = $price;
                $totalAmount = $productPrice * $c['quantity'];
    
                $orderDetail = [
                    'order_id' => $orderId,
                    'product_id' => $c['product_id'],
                    'quantity' => $c['quantity'],
                    'price' => $productPrice,
                    'total_amount' => $totalAmount,
                    'tax' => $tax,
                    'is_wholesale' => $isWholesale, // Add this line
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
    
                OrderDetail::create($orderDetail);
            }
    
            $orderAmount = $request['order_amount'];
            $totalAmount = $orderAmount + $totalTaxAmount;
    
            $order = Order::create($or);
    
            if (isset($request['order_images']) && count($request['order_images']) > 0) {
                foreach ($request['order_images'] as $orderImage) {
                    $imageName = time() . '.' . $orderImage->extension();
                    $orderImage->move(public_path('images/order_images'), $imageName);
                    OrderImage::create([
                        'order_id' => $order->id,
                        'image' => $imageName,
                    ]);
                }
            }
    
            DB::commit();
            return response()->json(['message' => translate('order_placed_successfully')], 200);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => [['code' => 'server_error', 'message' => $e->getMessage()]]], 500);
        }
    }
    

    /**
     * @param $orderImages
     * @param $orderId
     * @return true
     */
    private function uploadOrderImage($orderImages, $orderId): bool
    {
        foreach ($orderImages as $image) {
            $image = Helpers::upload('order/', 'png', $image);
            $orderImage = new OrderImage();
            $orderImage->order_id = $orderId;
            $orderImage->image = $image;
            $orderImage->save();
        }
        return true;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getOrderList(Request $request): \Illuminate\Http\JsonResponse
    {
        $userId = (bool)auth('api')->user() ? auth('api')->user()->id : $request->header('guest-id');
        $userType = (bool)auth('api')->user() ? 0 : 1;

        $orders = $this->order->with(['customer', 'delivery_man.rating', 'details:id,order_id,quantity'])
            ->where(['user_id' => $userId, 'is_guest' => $userType])
            ->get();

        $orders->each(function ($order) {
            $order->total_quantity = $order->details->sum('quantity');
        });

        $orders->map(function ($data) {
            $data['deliveryman_review_count'] = $this->deliverymanReview->where(['delivery_man_id' => $data['delivery_man_id'], 'order_id' => $data['id']])->count();
            return $data;
        });

        return response()->json($orders->map(function ($data) {
            $data->details_count = (integer)$data->details_count;
            return $data;
        }), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getOrderDetails(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'phone' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $phone = $request->input('phone');
        $userId = (bool)auth('api')->user() ? auth('api')->user()->id : $request->header('guest-id');
        $userType = (bool)auth('api')->user() ? 0 : 1;

        $order = $this->order->find($request['order_id']);
        if (!isset($order)){
            return response()->json([
                'errors' => [['code' => 'order', 'message' => 'Order not found!']]], 404);
        }

        if (!is_null($phone)){
            if ($order['is_guest'] == 0){
                $details = $this->orderDetail
                    ->with(['order', 'order.delivery_address' ,'order.customer', 'order.partial_payment', 'order.offline_payment', 'order.order_image'])
                    ->where(['order_id' => $request['order_id']])
                    ->whereHas('order.customer', function ($customerSubQuery) use ($phone) {
                        $customerSubQuery->where('phone', $phone);
                    })
                    ->get();
            }else{
                $details = $this->orderDetail
                    ->with(['order', 'order.delivery_address', 'order.partial_payment', 'order.offline_payment', 'order.order_image'])
                    ->where(['order_id' => $request['order_id']])
                    ->whereHas('order.delivery_address', function ($addressSubQuery) use ($phone) {
                        $addressSubQuery->where('contact_person_number', $phone);
                    })
                    ->get();
            }
        }else{
            $details = $this->orderDetail
                ->with(['order', 'order.partial_payment', 'order.offline_payment'])
                ->where(['order_id' => $request['order_id']])
                ->whereHas('order', function ($q) use ($userId, $userType){
                    $q->where(['user_id' => $userId, 'is_guest' => $userType]);
                })
                ->orderBy('id', 'desc')
                ->get();
        }


        if ($details->count() > 0) {
            foreach ($details as $detail) {

                $keepVariation = $detail['variation'];

                $variation = json_decode($detail['variation'], true);

                $detail['add_on_ids'] = json_decode($detail['add_on_ids']);
                $detail['add_on_qtys'] = json_decode($detail['add_on_qtys']);
                if (gettype(json_decode($keepVariation)) == 'array'){
                    $new_variation = json_decode($keepVariation);
                }else{
                    $new_variation = [];
                    $new_variation[] = json_decode($detail['variation']);

                }

                $detail['variation'] = $new_variation;

                $detail['formatted_variation'] = $new_variation[0] ?? null;
                if (isset($new_variation[0]) && $new_variation[0]->type == null){
                    $detail['formatted_variation'] = null;
                }

                $detail['review_count'] = $this->review->where(['order_id' => $detail['order_id'], 'product_id' => $detail['product_id']])->count();
                $detail['product_details'] = Helpers::product_data_formatting(json_decode($detail['product_details'], true));

            }
            return response()->json($details, 200);
        } else {
            return response()->json([
                'errors' => [
                    ['code' => 'order', 'message' => 'Order not found!']
                ]
            ], 404);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function cancelOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $order = $this->order::find($request['order_id']);

        if (!isset($order)){
            return response()->json(['errors' => [['code' => 'order', 'message' => 'Order not found!']]], 404);
        }

        if ($order->order_status != 'pending'){
            return response()->json(['errors' => [['code' => 'order', 'message' => 'Order can only cancel when order status is pending!']]], 403);
        }

        $userId = (bool)auth('api')->user() ? auth('api')->user()->id : $request->header('guest-id');
        $userType = (bool)auth('api')->user() ? 0 : 1;

        if ($this->order->where(['user_id' => $userId, 'is_guest' => $userType, 'id' => $request['order_id']])->first()) {

            $order = $this->order->with(['details'])->where(['user_id' => $userId, 'is_guest' => $userType, 'id' => $request['order_id']])->first();

            foreach ($order->details as $detail) {
                if ($detail['is_stock_decreased'] == 1) {
                    $product = $this->product->find($detail['product_id']);
                    if (isset($product)){
                        $type = json_decode($detail['variation'])[0]->type;
                        $variationStore = [];
                        foreach (json_decode($product['variations'], true) as $var) {
                            if ($type == $var['type']) {
                                $var['stock'] += $detail['quantity'];
                            }
                            $variationStore[] = $var;
                        }

                        $this->product->where(['id' => $product['id']])->update([
                            'variations' => json_encode($variationStore),
                            'total_stock' => $product['total_stock'] + $detail['quantity'],
                        ]);

                        $this->orderDetail->where(['id' => $detail['id']])->update([
                            'is_stock_decreased' => 0,
                        ]);
                    }
                }
            }
            $this->order->where(['user_id' => $userId, 'is_guest' => $userType, 'id' => $request['order_id']])->update([
                'order_status' => 'canceled',
            ]);
            return response()->json(['message' => 'Order canceled'], 200);
        }
        return response()->json([
            'errors' => [
                ['code' => 'order', 'message' => 'not found!'],
            ],
        ], 401);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePaymentMethod(Request $request): \Illuminate\Http\JsonResponse
    {
        $userId = (bool)auth('api')->user() ? auth('api')->user()->id : $request->header('guest-id');
        $userType = (bool)auth('api')->user() ? 0 : 1;

        if ($this->order->where(['user_id' => $userId, 'is_guest' => $userType, 'id' => $request['order_id']])->first()) {
            $this->order->where(['user_id' => $userId, 'is_guest' => $userType, 'id' => $request['order_id']])->update([
                'payment_method' => $request['payment_method'],
            ]);
            return response()->json(['message' => 'Payment method is updated.'], 200);
        }
        return response()->json([
            'errors' => [
                ['code' => 'order', 'message' => 'not found!'],
            ],
        ], 401);
    }
}
