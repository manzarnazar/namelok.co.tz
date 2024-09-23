<div class="d-flex flex-row cart--table-scroll">
    <div class="table-responsive">
        <table class="table table-bordered border-left-0 border-right-0 middle-align">
            <thead class="thead-light">
            <tr>
                <th scope="col"><?php echo e(translate('item')); ?></th>
                <th scope="col" class="text-center"><?php echo e(translate('qty')); ?></th>
                <th scope="col"><?php echo e(translate('price')); ?></th>
                <th scope="col"><?php echo e(translate('delete')); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subtotal = 0;
            $discount = 0;
            $discountType = 'amount';
            $discountOnProduct = 0;
            $totalTax = 0;
            $updatedTotalTax=0;
            $vatStatus = \App\CentralLogics\Helpers::get_business_settings('product_vat_tax_status') === 'included' ? 'included' : 'excluded';
            ?>
            <?php if(session()->has('cart') && count( session()->get('cart')) > 0): ?>
                <?php
                $cart = session()->get('cart');
                if (isset($cart['discount'])) {
                    $discount = $cart['discount'];
                    $discountType = $cart['discount_type'];
                }
                ?>
                <?php $__currentLoopData = session()->get('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(is_array($cartItem)): ?>
                        <?php
                        $productSubtotal = ($cartItem['price']) * $cartItem['quantity'];
                        $discountOnProduct += ($cartItem['discount'] * $cartItem['quantity']);
                        $subtotal += $productSubtotal;
                        $product = \App\Model\Product::find($cartItem['id']);
                        $totalTax += \App\CentralLogics\Helpers::tax_calculate($product, $cartItem['price']) * $cartItem['quantity'];
                        $updatedTotalTax += $vatStatus === 'included' ? 0 : \App\CentralLogics\Helpers::tax_calculate($product, $cartItem['price']) * $cartItem['quantity'];

                        ?>
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <?php if(!empty(json_decode($cartItem['image'],true))): ?>
                                        <img class="avatar avatar-sm mr-1"
                                            src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e(json_decode($cartItem['image'], true)[0]); ?>"
                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/2.png')); ?>'"
                                            alt="<?php echo e($cartItem['name']); ?> <?php echo e(translate('image')); ?>">
                                    <?php else: ?>
                                        <img class="avatar avatar-sm mr-1"
                                        src="<?php echo e(asset('public/assets/admin/img/160x160/2.png')); ?>">
                                    <?php endif; ?>
                                    <div class="media-body">
                                        <h6 class="text-hover-primary mb-0"><?php echo e(Str::limit($cartItem['name'], 10)); ?></h6>
                                        <small><?php echo e(Str::limit($cartItem['variant'], 20)); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-items-center text-center">
                                <input type="number" data-key="<?php echo e($key); ?>" id="<?php echo e($cartItem['id']); ?>" class="amount--input form-control text-center"
                                    value="<?php echo e($cartItem['quantity']); ?>" min="1" max="<?php echo e($product['total_stock']); ?>" onkeyup="updateQuantity(event)">
                            </td>
                            <td class="text-center px-0 py-1">
                                <div class="btn text-left">
                                    <?php echo e(\App\CentralLogics\Helpers::set_symbol($productSubtotal)); ?>

                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <a href="javascript:removeFromCart(<?php echo e($key); ?>)" class="btn btn-sm btn--danger rounded-full action-btn">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$total = $subtotal;
$sessionTotal = $subtotal+$totalTax-$discountOnProduct;
\Session::put('total', $sessionTotal);

$discountAmount = ($discountType == 'percent' && $discount > 0) ? (($total * $discount) / 100) : $discount;
$discountAmount += $discountOnProduct;
$total -= $discountAmount;

$extraDiscount = session()->get('cart')['extra_discount'] ?? 0;
$extraDiscount_type = session()->get('cart')['extra_discount_type'] ?? 'amount';
if ($extraDiscount_type == 'percent' && $extraDiscount > 0) {
    //$extraDiscount = (($total + $totalTax) * $extraDiscount) / 100;
    $extraDiscount = ($total * $extraDiscount) / 100;
}
if ($extraDiscount) {
    $total -= $extraDiscount;
}

$deliveryCharge = 0;
if (session()->get('order_type') == 'home_delivery'){
    $distance = 0;
    if (session()->has('address')){
        $address = session()->get('address');
        $distance = $address['distance'];
    }
    $deliveryType = \App\CentralLogics\Helpers::get_business_settings('delivery_management');
    if ($deliveryType['status'] == 1){
        $deliveryCharge = \App\CentralLogics\Helpers::get_delivery_charge($distance);
    }else{
        $deliveryCharge = \App\CentralLogics\Helpers::get_business_settings('delivery_charge');
    }
}else{
    $deliveryCharge = 0;
}
?>
<div class="box p-3">
    <dl class="row">
        <dt class="col-sm-6"><?php echo e(translate('sub_total')); ?> :</dt>
        <dd class="col-sm-6 text-right"><?php echo e(Helpers::set_symbol($subtotal)); ?></dd>


        <dt class="col-sm-6"><?php echo e(translate('product')); ?> <?php echo e(translate('discount')); ?>:
        </dt>
        <dd class="col-sm-6 text-right"> - <?php echo e(Helpers::set_symbol(round($discountAmount,2))); ?></dd>
        <dt class="col-sm-6"><?php echo e(translate('extra')); ?> <?php echo e(translate('discount')); ?>:
        </dt>
        <dd class="col-sm-6 text-right">
            <button class="btn btn-sm" type="button" data-toggle="modal" data-target="#add-discount"><i
                    class="tio-edit"></i>
            </button> - <?php echo e(Helpers::set_symbol($extraDiscount)); ?></dd>

        <dt class="col-sm-6"><?php echo e(translate('tax')); ?> <?php echo e(\App\CentralLogics\Helpers::get_business_settings('product_vat_tax_status') === 'included'?  '(Included)': ''); ?> :</dt>
        <dd class="col-sm-6 text-right"><?php echo e(Helpers::set_symbol(round($totalTax,2))); ?></dd>
        <dt class="col-sm-6"><?php echo e(translate('Delivery Charge')); ?> :</dt>
        <dd class="col-sm-6 text-right"><?php echo e(Helpers::set_symbol(round($deliveryCharge, 2))); ?></dd>
        <dt class="col-12">
            <hr class="mt-0">
        </dt>
        <dt class="col-sm-6"><?php echo e(translate('total')); ?> :</dt>
        <dd class="col-sm-6 text-right h4 b"><?php echo e(Helpers::set_symbol(round($total+$updatedTotalTax+$deliveryCharge, 2))); ?></dd>
    </dl>
    <div>
        <form action="<?php echo e(route('admin.pos.order')); ?>" id='order_place' method="post">
            <?php echo csrf_field(); ?>
            <div class="pos--payment-options mt-3 mb-3">
                <h5 class="mb-3"><?php echo e(translate('Payment Method')); ?></h5>
                <ul>
                    <li style="display: <?php echo e(!session()->has('order_type') || session('order_type') == 'take_away' ?  'block' : 'none'); ?>">
                        <label>
                            <input type="radio" name="type" value="cash" hidden="" <?php echo e(!session()->has('order_type') || session('order_type') == 'take_away' ? 'checked' : ''); ?>>
                            <span><?php echo e(translate('cash')); ?></span>
                        </label>
                    </li>
                    <li style="display: <?php echo e(!session()->has('order_type') || session('order_type') == 'take_away' ?  'block' : 'none'); ?>">
                        <label>
                            <input type="radio" name="type" value="card" hidden="">
                            <span><?php echo e(translate('card')); ?></span>
                        </label>
                    </li>
                    <li style="display: <?php echo e(session('order_type') == 'home_delivery' ?  'block' : 'none'); ?>">
                        <label>
                            <input type="radio" name="type" value="cash_on_delivery" hidden="" <?php echo e(session('order_type') == 'home_delivery' ? 'checked' : ''); ?>>
                            <span><?php echo e(translate('cash_on_delivery')); ?></span>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="row button--bottom-fixed g-1 bg-white ">
                <div class="col-sm-6">
                    <a class="btn btn-outline-danger btn--danger btn-sm btn-block cancel-order-button"><i
                            class="fa fa-times-circle "></i> <?php echo e(translate('Cancel Order')); ?> </a>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn  btn--primary btn-sm btn-block"><i class="fa fa-shopping-bag"></i>
                        <?php echo e(translate('Place Order')); ?>

                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="add-discount" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(translate('update_discount')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('admin.pos.discount')); ?>" method="post" class="row">
                    <?php echo csrf_field(); ?>
                    <div class="form-group col-sm-6">
                        <label for=""><?php echo e(translate('discount')); ?></label>
                        <input type="number" min="0" max="" value="<?php echo e(session()->get('cart')['extra_discount'] ?? 0); ?>"
                               id="extra_discount_input" class="form-control" name="discount" step="any" placeholder="<?php echo e(translate('Ex: 45')); ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for=""><?php echo e(translate('type')); ?></label>
                        <select name="type" class="form-control" id="discount_type_select">
                            <option value="amount" <?php echo e($extraDiscount_type=='amount'?'selected':''); ?>><?php echo e(translate('amount')); ?>

                                (<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>)
                            </option>
                            <option value="percent" <?php echo e($extraDiscount_type=='percent'?'selected':''); ?>><?php echo e(translate('percent')); ?>(%)
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <div class="btn--container justify-content-end">
                            <button class="btn btn-sm btn--reset" type="reset"><?php echo e(translate('reset')); ?></button>
                            <button class="btn btn-sm btn--primary" type="submit"><?php echo e(translate('submit')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-tax" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(translate('update_tax')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('admin.pos.tax')); ?>" method="POST" class="row">
                    <?php echo csrf_field(); ?>
                    <div class="form-group col-12">
                        <label for=""><?php echo e(translate('tax')); ?> (%)</label>
                        <input type="number" class="form-control" name="tax" min="0">
                    </div>
                    <div class="col-sm-12">
                        <div class="btn--container">
                            <button class="btn btn-sm btn--reset" type="reset"><?php echo e(translate('reset')); ?></button>
                            <button class="btn btn-sm btn--primary" type="submit"><?php echo e(translate('submit')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="coupon-discount" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(translate('coupon_discount')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-2 pt-3">
                <form class="row">
                    <?php echo csrf_field(); ?>
                    <div class="form-group col-sm-12">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-sm-12">
                        <div class="btn--container justify-content-end">
                            <button class="btn btn-sm btn--reset" type="reset"><?php echo e(translate('reset')); ?></button>
                            <button class="btn btn-sm btn--primary" type="submit"><?php echo e(translate('submit')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    "use strict";
        $('.cancel-order-button').on('click', function(event) {
            event.preventDefault();
            emptyCart();
        });
</script>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/pos/_cart.blade.php ENDPATH**/ ?>