<?php $__env->startSection('title', translate('Order Details')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        figure{
            margin-bottom: -1px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('/public/assets/admin/css/lightbox.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="content container-fluid">
        <div class="page-header d-flex justify-content-between">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/order.png')); ?>" class="w--20" alt="">
                </span>
                <span>
                    <?php echo e(translate('order details')); ?>

                </span>
            </h1>
        </div>

        <div class="row" id="printableArea">
            <div class="col-lg-8 order-print-area-left">
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header flex-wrap align-items-start border-0">
                        <div class="order-invoice-left">
                            <h1 class="page-header-title">
                                <span class="mr-3"><?php echo e(translate('order ID')); ?> #<?php echo e($order['id']); ?></span>
                                <span class="badge badge-soft-info py-2 px-3"><?php echo e($order->branch?$order->branch->name:translate('Branch deleted!')); ?></span>
                            </h1>
                            <span><i class="tio-date-range"></i>
                                <?php echo e(date('d M Y',strtotime($order['created_at']))); ?> <?php echo e(date(config('time_format'), strtotime($order['created_at']))); ?></span>
                        </div>
                        <div class="order-invoice-right mt-3 mt-sm-0">
                            <div class="btn--container ml-auto align-items-center justify-content-end">
                                <?php if($order['order_type']!='self_pickup' && $order['order_type'] != 'pos'): ?>
                                    <?php if($order['order_status']=='out_for_delivery'): ?>
                                        <?php ($origin=\App\Model\DeliveryHistory::where(['deliveryman_id'=>$order['delivery_man_id'],'order_id'=>$order['id']])->first()); ?>
                                        <?php ($current=\App\Model\DeliveryHistory::where(['deliveryman_id'=>$order['delivery_man_id'],'order_id'=>$order['id']])->latest()->first()); ?>
                                        <?php if(isset($origin)): ?>
                                            <a class="btn btn-outline-info font-semibold" target="_blank"
                                            title="<?php echo e(translate('Delivery Boy Last Location')); ?>" data-toggle="tooltip" data-placement="top"
                                            href="https://www.google.com/maps/dir/?api=1&origin=<?php echo e($origin['latitude']); ?>,<?php echo e($origin['longitude']); ?>&destination=<?php echo e($current['latitude']); ?>,<?php echo e($current['longitude']); ?>">
                                                <i class="tio-map"></i>
                                                <?php echo e(translate('Show Location in Map')); ?>

                                            </a>
                                        <?php else: ?>
                                            <a class="btn btn-outline-info font-semibold" href="javascript:" data-toggle="tooltip"
                                            data-placement="top" title="<?php echo e(translate('Waiting for location...')); ?>">
                                                <i class="tio-map"></i>
                                                <?php echo e(translate('Show Location in Map')); ?>

                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a class="btn btn-outline-info font-semibold last-location-view" href="javascript:"
                                        data-toggle="tooltip" data-placement="top"
                                        title="<?php echo e(translate('Only available when order is out for delivery!')); ?>">
                                            <i class="tio-map"></i>
                                            <?php echo e(translate('Show Location in Map')); ?>

                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <a class="btn btn--info print--btn" target="_blank" href=<?php echo e(route('admin.orders.generate-invoice',[$order['id']])); ?>>
                                    <i class="tio-print mr-1"></i> <?php echo e(translate('print')); ?> <?php echo e(translate('invoice')); ?>

                                </a>
                            </div>
                            <div class="text-right mt-3 order-invoice-right-contents text-capitalize">
                                <h6>
                                    <?php echo e(translate('Status')); ?> :
                                    <?php if($order['order_status']=='pending'): ?>
                                        <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">
                                        <?php echo e(translate('pending')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='confirmed'): ?>
                                        <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">
                                        <?php echo e(translate('confirmed')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='processing'): ?>
                                        <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize">
                                        <?php echo e(translate('packaging')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='out_for_delivery'): ?>
                                        <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize">
                                        <?php echo e(translate('out_for_delivery')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='delivered'): ?>
                                        <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize">
                                        <?php echo e(translate('delivered')); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger ml-2 ml-sm-3 text-capitalize">
                                        <?php echo e(str_replace('_',' ',$order['order_status'])); ?>

                                        </span>
                                    <?php endif; ?>
                                </h6>
                                <h6 class="text-capitalize">
                                    <span class="text-body mr-2"><?php echo e(translate('payment')); ?> <?php echo e(translate('method')); ?>

                                    :</span> <span class="text--title font-bold"><?php echo e(translate(str_replace('_',' ',$order['payment_method']))); ?></span>
                                </h6>
                                <?php if(!in_array($order['payment_method'], ['cash_on_delivery', 'wallet_payment', 'offline_payment'])): ?>
                                    <h6 class="text-capitalize">
                                        <?php if($order['transaction_reference']==null && $order['order_type']!='pos'): ?>
                                            <span class="text-body mr-2"> <?php echo e(translate('reference')); ?> <?php echo e(translate('code')); ?>

                                        :</span>
                                            <button class="btn btn-outline-primary py-1 btn-sm" data-toggle="modal"
                                                    data-target=".bd-example-modal-sm">
                                                <?php echo e(translate('add')); ?>

                                            </button>
                                        <?php elseif($order['order_type']!='pos'): ?>
                                            <span class="text-body mr-2"><?php echo e(translate('reference')); ?> <?php echo e(translate('code')); ?>

                                        :</span> <span class="text--title font-bold"> <?php echo e($order['transaction_reference']); ?></span>
                                        <?php endif; ?>
                                    </h6>
                                <?php endif; ?>

                                <h6>
                                    <span class="text-body mr-2"><?php echo e(translate('payment')); ?> <?php echo e(translate('status')); ?> : </span>

                                    <?php if($order['payment_status']=='paid'): ?>
                                        <span class="badge badge-soft-success ml-sm-3">
                                            <?php echo e(translate('paid')); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger ml-sm-3">
                                            <?php echo e(translate($order['payment_status'])); ?>

                                        </span>
                                    <?php endif; ?>
                                </h6>
                                <h6 class="text-capitalize">
                                    <span class="text-body"><?php echo e(translate('order')); ?> <?php echo e(translate('type')); ?></span>
                                    :<label class="badge badge-soft-primary ml-3"><?php echo e(translate(str_replace('_',' ',$order['order_type']))); ?></label>
                                </h6>
                            </div>
                        </div>
                        <?php if($order['order_type'] != 'pos'): ?>
                        <div class="w-100">
                            <h6>
                                <strong><?php echo e(translate('order')); ?> <?php echo e(translate('note')); ?></strong>
                                : <span class="text-body"> <?php echo e($order['order_note']); ?> </span>
                            </h6>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                    <?php ($subTotal=0); ?>
                    <?php ($amount=0); ?>
                    <?php ($totalTax=0); ?>
                    <?php ($total_dis_on_pro=0); ?>
                    <?php ($totalItemDiscount=0); ?>
                    <?php ($price_after_discount=0); ?>
                    <?php ($updatedTotalTax=0); ?>
                    <?php ($vatStatus = ''); ?>
                    <div class="table-responsive">
                        <table class="table table-borderless table-nowrap table-align-middle card-table dataTable no-footer mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0"><?php echo e(translate('SL')); ?></th>
                                    <th class="border-0"><?php echo e(translate('Item details')); ?></th>
                                    <th class="border-0 text-right"><?php echo e(translate('Price')); ?></th>
                                    <th class="border-0 text-right"><?php echo e(translate('Discount')); ?></th>
                                    <th class="text-right border-0"><?php echo e(translate('Total Price')); ?></th>
                                </tr>
                            </thead>
                            <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($detail->product_details !=null): ?>
                                    <?php ($product = json_decode($detail->product_details, true)); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($loop->iteration); ?>

                                        </td>
                                        <td>
                                            <div class="media media--sm">
                                                <div class="avatar avatar-xl mr-3">
                                                    <?php if($detail->product && $detail->product['image'] != null ): ?>
                                                    <img class="img-fluid rounded aspect-ratio-1"
                                                         src="<?php echo e($detail->product->identityImageFullPath[0]); ?>"
                                                        alt="<?php echo e(translate('Image Description')); ?>">
                                                    <?php else: ?>
                                                        <img
                                                        src="<?php echo e(asset('public/assets/admin/img/160x160/2.png')); ?>"
                                                        class="img-fluid rounded aspect-ratio-1"
                                                        >
                                                    <?php endif; ?>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="line--limit-1"><?php echo e($product['name']); ?></h5>
                                                    <?php if(count(json_decode($detail['variation'],true)) > 0): ?>
                                                        <?php $__currentLoopData = json_decode($detail['variation'],true)[0]??json_decode($detail['variation'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 =>$variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="font-size-sm text-body text-capitalize">
                                                                <?php if($variation != null): ?>
                                                                <span><?php echo e($key1); ?> :  </span>
                                                                <?php endif; ?>
                                                                <span class="font-weight-bold"><?php echo e($variation); ?></span>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <h5 class="mt-1"><span class="text-body"><?php echo e(translate('Unit')); ?></span> : <?php echo e($detail['unit']); ?> </h5>
                                                    <h5 class="mt-1"><span class="text-body"><?php echo e(translate('Unit Price')); ?></span> : <?php echo e($detail['price']); ?> </h5>
                                                    <h5 class="mt-1"><span class="text-body"><?php echo e(translate('QTY')); ?></span> : <?php echo e($detail['quantity']); ?> </h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <h6><?php echo e(Helpers::set_symbol($detail['price'] * $detail['quantity'])); ?></h6>
                                        </td>
                                        <td class="text-right">
                                            <h6><?php echo e(Helpers::set_symbol($detail['discount_on_product'] * $detail['quantity'])); ?></h6>
                                        </td>
                                        <td class="text-right">
                                            <?php ($amount+=$detail['price']*$detail['quantity']); ?>
                                            <?php ($totalTax+=$detail['tax_amount']*$detail['quantity']); ?>
                                            <?php ($updatedTotalTax+= $detail['vat_status'] === 'included' ? 0 : $detail['tax_amount']*$detail['quantity']); ?>
                                            <?php ($vatStatus = $detail['vat_status']); ?>
                                            <?php ($totalItemDiscount += $detail['discount_on_product'] * $detail['quantity']); ?>
                                            <?php ($price_after_discount+=$amount-$totalItemDiscount); ?>
                                            <?php ($subTotal+=$price_after_discount); ?>
                                            <h5><?php echo e(Helpers::set_symbol(($detail['price'] * $detail['quantity']) - ($detail['discount_on_product'] * $detail['quantity']))); ?></h5>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="12" class="td-p-0">
                                            <hr class="m-0" >
                                        </td>
                                    </tr>
                            </table>
                        </div>

                        <div class="row justify-content-md-end mb-3 mt-4">
                            <div class="col-md-9 col-lg-8">
                                <dl class="row text-right justify-content-end">
                                    <dt class="col-6 text-left">
                                        <div class="ml-auto max-w-130px">
                                            <?php echo e(translate('items')); ?> <?php echo e(translate('price')); ?> :
                                        </div>
                                    </dt>
                                    <dd class="col-6 col-xl-5 pr-5">
                                            
                                            <?php echo e(Helpers::set_symbol($amount)); ?>

                                    </dd>
                                    <dt class="col-6 text-left">
                                        <div class="ml-auto max-w-130px">
                                            <?php echo e(translate('Item Discount')); ?> :
                                        </div>
                                    </dt>
                                    <dd class="col-6 col-xl-5 pr-5">
                                        - <?php echo e(Helpers::set_symbol($totalItemDiscount)); ?>

                                    </dd>
                                    <dt class="col-6 text-left">
                                        <div class="ml-auto max-w-130px">
                                            <?php echo e(translate('Sub Total')); ?> :
                                        </div>
                                    </dt>
                                    <dd class="col-6 col-xl-5 pr-5">
                                        <?php echo e(Helpers::set_symbol($total = $amount-$totalItemDiscount)); ?>

                                    </dd>
                                    <dt class="col-6 text-left">
                                        <div class="ml-auto max-w-130px">
                                            <?php echo e(translate('TAX')); ?> / <?php echo e(translate('VAT')); ?> <?php echo e($vatStatus == 'included' ? translate('(included)') : ''); ?>:
                                        </div>
                                    </dt>
                                    <dd class="col-6 col-xl-5 pr-5">
                                        <?php echo e(Helpers::set_symbol($totalTax)); ?>

                                    </dd>
                                    <?php if($order['order_type'] != 'pos'): ?>
                                    <dt class="col-6 text-left">
                                        <div class="ml-auto max-w-130px">
                                            <?php echo e(translate('coupon')); ?> <?php echo e(translate('discount')); ?> :
                                        </div>
                                    </dt>
                                    <dd class="col-6 col-xl-5 pr-5">
                                        - <?php echo e(Helpers::set_symbol($order['coupon_discount_amount'])); ?>

                                    </dd>
                                    <?php endif; ?>
                                    <dt class="col-6 text-left">
                                        <div class="ml-auto max-w-130px">
                                            <?php echo e(translate('extra Discount')); ?> :
                                        </div>
                                    </dt>
                                    <dd class="col-6 col-xl-5 pr-5">
                                        - <?php echo e(Helpers::set_symbol($order['extra_discount'])); ?>

                                    </dd>
                                    <dt class="col-6 text-left">
                                        <div class="ml-auto max-w-130px">
                                            <?php echo e(translate('delivery')); ?> <?php echo e(translate('fee')); ?> :
                                        </div>
                                    </dt>
                                    <dd class="col-6 col-xl-5 pr-5">
                                        <?php if($order['order_type']=='self_pickup'): ?>
                                            <?php ($del_c=0); ?>
                                        <?php else: ?>
                                            <?php ($del_c=$order['delivery_charge']); ?>
                                        <?php endif; ?>
                                        <?php echo e(Helpers::set_symbol($del_c)); ?>

                                        <hr>
                                    </dd>

                                    <dt class="col-6 text-left">
                                        <div class="ml-auto max-w-130px">
                                            <?php echo e(translate('total')); ?>:
                                        </div>
                                    </dt>
                                    <dd class="col-6 col-xl-5 pr-5">
                                        <?php echo e(Helpers::set_symbol($total+$del_c+$updatedTotalTax-$order['coupon_discount_amount']-$order['extra_discount'])); ?>

                                        <hr>
                                    </dd>
                                    <?php if($order->partial_payment->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $order->partial_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <dt class="col-6 text-left">
                                                <div class="ml-auto max-w-130px">
                                                    <span><?php echo e(translate('Paid By')); ?> (<?php echo e(str_replace('_', ' ',$partial->paid_with)); ?>)</span>
                                                    <span>:</span>
                                                </div>
                                            </dt>
                                            <dd class="col-6 col-xl-5 pr-5">
                                                <?php echo e(\App\CentralLogics\Helpers::set_symbol($partial->paid_amount)); ?>

                                            </dd>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $due_amount = 0;
                                            $due_amount = $order->partial_payment->first()?->due_amount;
                                            ?>
                                        <dt class="col-6 text-left">
                                            <div class="ml-auto max-w-130px">
                                            <span>
                                                <?php echo e(translate('Due Amount')); ?></span>
                                                <span>:</span>
                                            </div>
                                        </dt>
                                        <dd class="col-6 col-xl-5 pr-5">
                                            <?php echo e(\App\CentralLogics\Helpers::set_symbol($due_amount)); ?>

                                        </dd>
                                    <?php endif; ?>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 order-print-area-right">
                <?php if($order['order_type'] != 'pos'): ?>
                <div class="card">
                    <div class="card-header border-0 pb-0 justify-content-center">
                        <h4 class="card-title"><?php echo e(translate('Order Setup')); ?></h4>
                    </div>

                    <?php if(isset($order->offline_payment)): ?>
                        <div class="card mt-3">
                            <div class="card-body text-center">
                                <?php if($order->offline_payment?->status == 1): ?>
                                    <h4 class=""><?php echo e(translate('Payment_verified')); ?></h4>
                                <?php else: ?>
                                    <h4 class=""><?php echo e(translate('Payment_verification')); ?></h4>
                                    <p class="text-danger"><?php echo e(translate('please verify the payment before confirm order')); ?></p>
                                    <div class="mt-3">
                                        <button class="btn btn--primary" type="button" id="verifyPaymentButton" data-id="<?php echo e($order['id']); ?>"
                                                data-target="#payment_verify_modal" data-toggle="modal"><?php echo e(translate('Verify_Payment')); ?></button>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <?php if($order['order_type'] != 'pos'): ?>
                        <div class="hs-unfold w-100">
                            <span class="d-block form-label font-bold mb-2"><?php echo e(translate('Change Order Status')); ?>:</span>
                            <div class="dropdown">
                                <button class="form-control h--45px dropdown-toggle d-flex justify-content-between align-items-center w-100" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <?php echo e($order['order_status'] == 'processing' ? translate('packaging') : translate($order['order_status'])); ?>

                                </button>
                                <div class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton">
                                    <?php if($order['payment_method'] == 'offline_payment' && $order->offline_payment?->status != 1): ?>
                                        <a class="dropdown-item manage-status" href="#" data-status="pending"><?php echo e(translate('pending')); ?></a>
                                        <a class="dropdown-item manage-status" href="#" data-status="confirmed"><?php echo e(translate('confirmed')); ?></a>
                                        <a class="dropdown-item manage-status" href="#" data-status="packaging"><?php echo e(translate('packaging')); ?></a>
                                        <a class="dropdown-item manage-status" href="#" data-status="out_for_delivery"><?php echo e(translate('out_for_delivery')); ?></a>
                                        <a class="dropdown-item manage-status" href="#" data-status="delivered"><?php echo e(translate('delivered')); ?></a>
                                        <a class="dropdown-item manage-status" href="#" data-status="returned"><?php echo e(translate('returned')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'failed'])); ?>" data-order_status="failed"><?php echo e(translate('failed')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'canceled'])); ?>" data-order_status="canceled"><?php echo e(translate('canceled')); ?></a>
                                    <?php else: ?>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'pending'])); ?>" data-order_status="pending"><?php echo e(translate('pending')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'confirmed'])); ?>" data-order_status="confirmed"><?php echo e(translate('confirmed')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'processing'])); ?>" data-order_status="packaging"><?php echo e(translate('packaging')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'out_for_delivery'])); ?>" data-order_status="out_for_delivery"><?php echo e(translate('out_for_delivery')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'delivered'])); ?>" data-order_status="delivered"><?php echo e(translate('delivered')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'returned'])); ?>" data-order_status="returned"><?php echo e(translate('returned')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'failed'])); ?>" data-order_status="failed"><?php echo e(translate('failed')); ?></a>
                                        <a class="dropdown-item manage-status" href="<?php echo e(route('admin.orders.status',['id'=>$order['id'],'order_status'=>'canceled'])); ?>" data-order_status="canceled"><?php echo e(translate('canceled')); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="hs-unfold w-100 mt-3">
                            <span class="d-block form-label font-bold mb-2"><?php echo e(translate('Payment Status')); ?>:</span>
                            <div class="dropdown">
                                <button class="form-control h--45px dropdown-toggle d-flex justify-content-between align-items-center w-100" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <?php echo e(translate($order['payment_status'])); ?>

                                </button>
                                <?php if($order['payment_method'] == 'offline_payment' && $order->offline_payment?->status != 1): ?>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item offline-payment" data-message="<?php echo e(translate('You can not change status of unverified offline payment')); ?>"
                                           data-status="paid" href="#"><?php echo e(translate('paid')); ?></a>
                                        <a class="dropdown-item offline-payment" data-message="<?php echo e(translate('You can not change status of unverified offline payment')); ?>"
                                           data-status="unpaid" href="#"><?php echo e(translate('unpaid')); ?></a>
                                    </div>
                                <?php else: ?>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item change-payment-status" data-status="paid" data-route="<?php echo e(route('admin.orders.payment-status',['id'=>$order['id'],'payment_status'=>'paid'])); ?>"><?php echo e(translate('paid')); ?></a>
                                        <a class="dropdown-item change-payment-status" data-status="unpaid" data-route="<?php echo e(route('admin.orders.payment-status',['id'=>$order['id'],'payment_status'=>'unpaid'])); ?>"><?php echo e(translate('unpaid')); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mt-3">
                            <span class="d-block form-label mb-2 font-bold"><?php echo e(translate('Delivery Date & Time')); ?>:</span>
                            <div class="d-flex flex-wrap g-2">
                                <div class="hs-unfold w-0 flex-grow min-w-160px">
                                    <label class="input-date">
                                        <input class="js-flatpickr form-control flatpickr-custom min-h-45px form-control" type="text" value="<?php echo e(date('d M Y',strtotime($order['delivery_date']))); ?>"
                                               name="deliveryDate" id="from_date" data-id="<?php echo e($order['id']); ?>" required>
                                    </label>
                                </div>
                                <div class="hs-unfold w-0 flex-grow min-w-160px">
                                    <select class="custom-select custom-select time_slote" name="timeSlot" data-id="<?php echo e($order['id']); ?>">
                                        <option disabled selected><?php echo e(translate('select')); ?> <?php echo e(translate('Time Slot')); ?></option>
                                        <?php $__currentLoopData = \App\Model\TimeSlot::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeSlot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($timeSlot['id']); ?>" <?php echo e($timeSlot->id == $order->time_slot_id ?'selected':''); ?>><?php echo e(date(config('time_format'), strtotime($timeSlot['start_time']))); ?>

                                                - <?php echo e(date(config('time_format'), strtotime($timeSlot['end_time']))); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(($order['order_type'] !='self_pickup') && ($order['order_type'] !='pos')): ?>
                                <?php if(!$order->delivery_man): ?>
                                    <div class="mt-3">
                                        <button class="btn btn--primary w-100" type="button" data-target="#assign_delivey_man_modal" data-toggle="modal"><?php echo e(translate('assign delivery man manually')); ?></button>
                                    </div>
                                <?php endif; ?>
                                <?php if($order->delivery_man): ?>
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3 d-flex flex-wrap align-items-center">
                                    <span class="card-header-icon">
                                        <i class="tio-user"></i>
                                    </span>
                                                <span><?php echo e(translate('deliveryman')); ?></span>
                                                <?php if($order->order_status != 'delivered'): ?>
                                                    <a type="button" href="#assign_delivey_man_modal" class="text--base cursor-pointer ml-auto text-sm"
                                                       data-toggle="modal" data-target="#assign_delivey_man_modal">
                                                        <?php echo e(translate('change')); ?>

                                                    </a>
                                                <?php endif; ?>
                                            </h5>
                                            <div class="media align-items-center deco-none customer--information-single">

                                                <div class="avatar avatar-circle">
                                                    <img class="avatar-img"
                                                         src="<?php echo e($order->delivery_man->imageFullPath); ?>"
                                                         alt="<?php echo e(translate('Image Description')); ?>">
                                                </div>
                                                <div class="media-body">
                                                    <a href="<?php echo e(route('admin.delivery-man.preview', [$order->delivery_man['id']])); ?>">
                                                        <span class="text-body d-block text-hover-primary mb-1"><?php echo e($order->delivery_man['f_name'] . ' ' . $order->delivery_man['l_name']); ?></span>
                                                    </a>

                                                    <span class="text--title font-semibold d-flex align-items-center">
                                                    <i class="tio-shopping-basket-outlined mr-2"></i>
                                                    <?php echo e(\App\Model\Order::where(['delivery_man_id' => $order['delivery_man_id'], 'order_status' => 'delivered'])->count()); ?> <?php echo e(translate('orders_delivered')); ?>

                                                    </span>
                                                    <span class="text--title font-semibold d-flex align-items-center">
                                                       <i class="tio-call-talking-quiet mr-2"></i>
                                                        <a href="Tel:<?php echo e($order->delivery_man['phone']); ?>"><?php echo e($order->delivery_man['phone']); ?></a>
                                                    </span>
                                                    <span class="text--title font-semibold d-flex align-items-center">
                                                        <i class="tio-email-outlined mr-2"></i>
                                                        <a href="mailto:<?php echo e($order->delivery_man['email']); ?>"><?php echo e($order->delivery_man['email']); ?></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                        <?php endif; ?>


                            <?php if($order['order_type']!='self_pickup'): ?>
                                <hr>
                                <?php ($address=\App\Model\CustomerAddress::find($order['delivery_address_id'])); ?>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">
                                    <span class="card-header-icon">
                                        <i class="tio-user"></i>
                                    </span>
                                        <span><?php echo e(translate('delivery information')); ?></span>
                                    </h5>
                                    <?php if(isset($address)): ?>
                                        <a class="link" data-toggle="modal" data-target="#shipping-address-modal"
                                           href="javascript:"><i class="tio-edit"></i></a>
                                    <?php endif; ?>
                                </div>

                                <?php if(isset($address)): ?>
                                    <div class="delivery--information-single flex-column mt-3">
                                        <div class="d-flex">
                                    <span class="name">
                                        <?php echo e(translate('name')); ?>

                                    </span>
                                            <span class="info"><?php echo e($address['contact_person_name']); ?></span>
                                        </div>
                                        <div class="d-flex">
                                            <span class="name"><?php echo e(translate('phone')); ?></span>
                                            <span class="info"><?php echo e($address['contact_person_number']); ?></span>
                                        </div>
                                        <?php if($address['road']): ?>
                                            <div class="d-flex">
                                                <span class="name"><?php echo e(translate('road')); ?></span>
                                                <span class="info">#<?php echo e($address['road']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($address['house']): ?>
                                            <div class="d-flex">
                                                <span class="name"><?php echo e(translate('house')); ?></span>
                                                <span class="info">#<?php echo e($address['house']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($address['floor']): ?>
                                            <div class="d-flex">
                                                <span class="name"><?php echo e(translate('floor')); ?></span>
                                                <span class="info">#<?php echo e($address['floor']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <hr class="w-100">
                                        <div>
                                            <a target="_blank"
                                               href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo e($address['latitude']); ?>+<?php echo e($address['longitude']); ?>">
                                                <i class="tio-poi"></i> <?php echo e($address['address']); ?>

                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>                    </div>
                </div>

                <?php endif; ?>
                <?php if($order->offline_payment): ?>
                    <?php ($payment = json_decode($order->offline_payment?->payment_info, true)); ?>

                    <div class="card mt-2">
                        <div class="card-body">
                            <h5 class="form-label mb-3">
                                <span class="card-header-icon"><i class="tio-shopping-basket"></i></span>
                                <span><?php echo e(translate('Offline payment information')); ?></span>
                            </h5>
                            <div class="offline-payment--information-single flex-column mt-3">
                                <div class="d-flex">
                                    <span class="name"><?php echo e(translate('payment_note')); ?></span>
                                    <span class="info"><?php echo e($payment['payment_note']); ?></span>
                                </div>
                                <?php $__currentLoopData = $payment['method_information']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $infos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $infoKey => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="d-flex">
                                            <span class="name"><?php echo e($infoKey); ?></span>
                                            <span class="info"><?php echo e($info); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                    <div class="card mt-2">
                        <div class="card-body">
                            <h5 class="form-label mb-3">
                            <span class="card-header-icon">
                            <i class="tio-user"></i>
                            </span>
                                <span><?php echo e(translate('Customer information')); ?></span>
                            </h5>
                            <?php if($order->is_guest == 1): ?>
                                <div class="media align-items-center deco-none customer--information-single">
                                    <div class="avatar avatar-circle">
                                        <img class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/admin.jpg')); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                                    </div>
                                    <div class="media-body">
                                    <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                        <?php echo e(translate('Guest Customer')); ?>

                                    </span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php if($order->user_id == null): ?>
                                    <div class="media align-items-center deco-none customer--information-single">
                                        <div class="avatar avatar-circle">
                                            <img class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/admin.jpg')); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                                        </div>
                                        <div class="media-body">
                                    <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                        <?php echo e(translate('Walking Customer')); ?>

                                    </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($order->user_id != null && !isset($order->customer) ): ?>
                                    <div class="media align-items-center deco-none customer--information-single">
                                        <div class="avatar avatar-circle">
                                            <img class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/admin.jpg')); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                                        </div>
                                        <div class="media-body">
                                            <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                                <?php echo e(translate('Customer_not_available')); ?>

                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($order->customer) ): ?>
                                    <div class="media align-items-center deco-none customer--information-single">
                                        <div class="avatar avatar-circle">
                                            <img class="avatar-img" src="<?php echo e($order->customer->imageFullPath); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                                        </div>
                                        <div class="media-body">
                                    <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                        <a href="<?php echo e(route('admin.customer.view',[$order['user_id']])); ?>"><?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></a>
                                    </span>
                                            <span><?php echo e(\App\Model\Order::where('user_id',$order['user_id'])->count()); ?> <?php echo e(translate("orders")); ?></span>
                                            <span class="text--title font-semibold d-block">
                                <i class="tio-call-talking-quiet mr-2"></i>
                                <a href="Tel:<?php echo e($order->customer['phone']); ?>"><?php echo e($order->customer['phone']); ?></a>
                                    </span>
                                            <span class="text--title">
                                <i class="tio-email mr-2"></i>
                                <a href="mailto:<?php echo e($order->customer['email']); ?>"><?php echo e($order->customer['email']); ?></a>
                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($order->order_image && $order->order_image->isNotEmpty()): ?>
                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="form-label mb-3">
                                    <span class="card-header-icon">
                                    <i class="tio-image"></i>
                                    </span>
                                    <span><?php echo e(translate('Order Image')); ?></span>
                                </h5>
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <?php $__currentLoopData = $order->order_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="avatar m-1 w-75px h-auto" href="<?php echo e(asset('storage/app/public/order/' . $orderImage->image)); ?>" data-lightbox>
                                            <img class="aspect-1 avatar-img object-cover" src="<?php echo e(asset('storage/app/public/order/' . $orderImage->image)); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                <div class="card mt-2">
                        <div class="card-body">
                            <h5 class="form-label mb-3">
                        <span class="card-header-icon">
                        <i class="tio-shop-outlined"></i>
                        </span>
                                <span><?php echo e(translate('Branch information')); ?></span>
                            </h5>
                            <div class="media align-items-center deco-none resturant--information-single">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img w-75px" src="<?php echo e($order->branch?->imageFullPath); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                                </div>
                                <div class="media-body">
                                    <?php if(isset($order->branch)): ?>
                                        <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                <?php echo e($order->branch?->name); ?>

                            </span>
                                        <span><?php echo e(\App\Model\Order::where('branch_id',$order['branch_id'])->count()); ?> <?php echo e(translate('Orders')); ?></span>
                                        <span class="text--title font-semibold d-block">
                                <i class="tio-call-talking-quiet mr-2"></i>
                                <a href="Tel:<?php echo e($order->branch?->phone); ?>"><?php echo e($order->branch?->phone); ?></a>
                            </span>
                                        <span class="text--title" >
                                <i class="tio-email mr-2"></i>
                                <a href="mailto:<?php echo e($order->branch?->email); ?>"><?php echo e($order->branch?->email); ?></a>
                            </span>
                                    <?php else: ?>
                                        <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                    <?php echo e(translate('Branch Deleted')); ?>

                                </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(isset($order->branch)): ?>
                                <hr>
                                <span class="d-block">
                            <a target="_blank"
                               href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo e($order->branch?->latitude); ?>+<?php echo e($order->branch?->longitude); ?>">
                            <i class="tio-poi"></i> <?php echo e($order->branch?->address); ?>

                            </a>
                        </span>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4"
                        id="mySmallModalLabel"><?php echo e(translate('reference')); ?> <?php echo e(translate('code')); ?> <?php echo e(translate('add')); ?></h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                            aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>

                <form action="<?php echo e(route('admin.orders.add-payment-ref-code',[$order['id']])); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="transaction_reference" class="form-control"
                                   placeholder="<?php echo e(translate('EX : Code123')); ?>" required>
                        </div>
                        <div class="btn--container justify-content-end">
                            <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo e(translate('close')); ?></button>
                            <button class="btn btn--primary" type="submit"><?php echo e(translate('submit')); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="shipping-address-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-top-cover bg-dark text-center">
                    <figure class="position-absolute right-0 bottom-0 left-0">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             viewBox="0 0 1920 100.1">
                            <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"/>
                        </svg>
                    </figure>

                    <div class="modal-close">
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal"
                                aria-label="Close">
                            <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                      d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="modal-top-cover-icon">
                    <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">
                      <i class="tio-location-search"></i>
                    </span>
                </div>

                <?php ($address=\App\Model\CustomerAddress::find($order['delivery_address_id'])); ?>
                <?php if(isset($address)): ?>
                    <form action="<?php echo e(route('admin.order.update-shipping',[$order['delivery_address_id']])); ?>"
                          method="post">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('type')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="address_type"
                                           value="<?php echo e($address['address_type']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('contact')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="contact_person_number"
                                           value="<?php echo e($address['contact_person_number']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('name')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="contact_person_name"
                                           value="<?php echo e($address['contact_person_name']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('address')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="address" value="<?php echo e($address['address']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('road')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="road" value="<?php echo e($address['road']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('house')); ?>

                                </label>
                                <div class="col-md-4 js-form-message">
                                    <input type="text" class="form-control" name="house" value="<?php echo e($address['house']); ?>">
                                </div>
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('floor')); ?>

                                </label>
                                <div class="col-md-4 js-form-message">
                                    <input type="text" class="form-control" name="floor" value="<?php echo e($address['floor']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('latitude')); ?>

                                </label>
                                <div class="col-md-4 js-form-message">
                                    <input type="text" class="form-control" name="latitude"
                                           value="<?php echo e($address['latitude']); ?>"
                                           required>
                                </div>
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('longitude')); ?>

                                </label>
                                <div class="col-md-4 js-form-message">
                                    <input type="text" class="form-control" name="longitude"
                                           value="<?php echo e($address['longitude']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white"
                                    data-dismiss="modal"><?php echo e(translate('close')); ?></button>
                            <button type="submit"
                                    class="btn btn-primary"><?php echo e(translate('save')); ?> <?php echo e(translate('changes')); ?></button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="modal fade" id="assign_delivey_man_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(translate('Assign Delivery Man')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <ul class="list-group overflow-auto initial--23">
                                <?php $__currentLoopData = $deliverymanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliveryman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item">
                                        <span class="dm_list" role='button' data-id="<?php echo e($deliveryman['id']); ?>">
                                            <img class="avatar avatar-sm avatar-circle mr-1"
                                                 src="<?php echo e($deliveryman->imageFullPath); ?>"
                                                 alt="<?php echo e($deliveryman['f_name']); ?>">
                                            <?php echo e($deliveryman['f_name']); ?> <?php echo e($deliveryman['l_name']); ?>

                                        </span>

                                        <a class="btn btn-primary btn-xs float-right assign-deliveryman" data-deliveryman-id="<?php echo e($deliveryman['id']); ?>"><?php echo e(translate('assign')); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($order->offline_payment): ?>
        <div class="modal fade" id="payment_verify_modal">
            <div class="modal-dialog modal-lg offline-details">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title pb-2"><?php echo e(translate('Payment_Verification')); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="card">
                        <div class="modal-body mx-2">
                            <p class="text-danger"><?php echo e(translate('Please Check & Verify the payment information whether it is correct or not before confirm the order.')); ?></p>
                            <h5><?php echo e(translate('customer_Information')); ?></h5>

                            <div class="card-body">
                                <?php if($order->is_guest == 0): ?>
                                    <p><?php echo e(translate('name')); ?> : <?php echo e($order->customer ? $order->customer->f_name.' '. $order->customer->l_name: ''); ?> </p>
                                    <p><?php echo e(translate('contact')); ?> : <?php echo e($order->customer ? $order->customer->phone: ''); ?></p>
                                <?php else: ?>
                                    <p><?php echo e(translate('guest_customer')); ?> </p>
                                <?php endif; ?>
                            </div>

                            <h5><?php echo e(translate('Payment_Information')); ?></h5>
                            <?php ($payment = json_decode($order->offline_payment?->payment_info, true)); ?>
                            <div class="row card-body">
                                <div class="col-md-6">
                                    <p><?php echo e(translate('Payment_Method')); ?> : <?php echo e($payment['payment_name']); ?></p>
                                    <?php $__currentLoopData = $payment['method_fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p><?php echo e($fieldKey); ?> : <?php echo e($field); ?></p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo e(translate('payment_note')); ?> : <?php echo e($payment['payment_note']); ?></p>
                                    <?php $__currentLoopData = $payment['method_information']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $infos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $infoKey => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p><?php echo e($infoKey); ?> : <?php echo e($info); ?></p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end my-2 mx-3">
                        <a type="reset" class="btn btn--reset verify-offline-payment" data-status="2"><?php echo e(translate('Payment_Did_Not_Received')); ?></a>
                        <a type="submit" class="btn btn--primary verify-offline-payment" data-status="1"><?php echo e(translate('Yes,_Payment_Received')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/flatpicker.js')); ?>"></script>

    <script>
        "use strict";

        $('.last-location-view').on('click', function () {
            last_location_view();
        })

        $('#verifyPaymentButton').on('click', function() {
            var orderId = $(this).data('id');
            get_offline_payment_data(orderId);
        });

        $('.manage-status').on('click', function(event) {
            event.preventDefault();
            var status = $(this).data('status');
            var order_status = $(this).data('order_status');
            if (status === 'pending' || status === 'confirmed' || status === 'packaging' || status === 'out_for_delivery' || status === 'delivered' || status === 'returned') {
                var message = '<?php echo e(translate("You can not change order status to this status. Please Check & Verify the payment information whether it is correct or not. You can only change order status to failed or cancel if payment is not verified.")); ?>';
                offline_payment_order_alert(message);
            } else {
                var route = $(this).attr('href');
                var confirmMessage = '<?php echo e(translate("Change status to ")); ?>' + order_status + ' ?';
                if(order_status == 'out_for_delivery'){
                    var confirmMessage = '<?php echo e(translate("Change status to out for delivery")); ?>' + ' ?';
                }
                route_alert(route, confirmMessage);
            }
        });

        $('.change-payment-status').on('click', function(event) {
            event.preventDefault();
            var status = $(this).data('status');
            var message = '<?php echo e(translate("Change status to")); ?> ' + status + ' ?';
            var route = $(this).data('route');
            console.log(status);
            console.log(message);
            console.log(route);
            route_alert(route, message);
        });

        $('.offline-payment').on('click', function(event) {
            event.preventDefault();
            var message = $(this).data('message');
            offline_payment_status_alert(message);
        });

        $('.assign-deliveryman').on('click', function(event) {
            event.preventDefault();
            var deliverymanId = $(this).data('deliveryman-id');
            addDeliveryMan(deliverymanId);
        });

        $('.verify-offline-payment').on('click', function(event) {
            event.preventDefault();
            var status = $(this).data('status');
            verify_offline_payment(status);
        });

        function offline_payment_order_alert(message) {
            Swal.fire({
                title: '<?php echo e(translate("Payment_is_Not_Verified")); ?>',
                text: message,
                type: 'question',
                showCancelButton: true,
                showConfirmButton: false,
                cancelButtonColor: 'default',
                confirmButtonColor: '#01684b',
                cancelButtonText: '<?php echo e(translate("Close")); ?>',
                confirmButtonText: '<?php echo e(translate("Proceed")); ?>',
                reverseButtons: true
            }).then((result) => {

            })
        }

        function offline_payment_status_alert(message) {
            Swal.fire({
                title: '<?php echo e(translate("Payment_is_Not_Verified")); ?>',
                text: message,
                type: 'question',
                showCancelButton: true,
                showConfirmButton: false,
                cancelButtonColor: 'default',
                confirmButtonColor: '#01684b',
                cancelButtonText: '<?php echo e(translate("Close")); ?>',
                confirmButtonText: '',
                reverseButtons: true
            }).then((result) => {

            })
        }

        function addDeliveryMan(id) {
            $.ajax({
                type: "GET",
                url: '<?php echo e(url('/')); ?>/admin/orders/add-delivery-man/<?php echo e($order['id']); ?>/' + id,
                data: $('#product_form').serialize(),
                success: function (data) {
                    //console.log(data);
                    location.reload();
                    if(data.status == true) {
                        toastr.success('<?php echo e(translate("Deliveryman successfully assigned/changed")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else{
                        toastr.error('<?php echo e(translate("Deliveryman man can not assign/change in that status")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }

                },
                error: function () {
                    toastr.error('Add valid data', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        }

        function verify_offline_payment(status) {
            $.ajax({
                type: "GET",
                url: '<?php echo e(url('/')); ?>/admin/orders/verify-offline-payment/<?php echo e($order['id']); ?>/' + status,
                success: function (data) {
                    //console.log(data);
                    location.reload();
                    if(data.status == true) {
                        toastr.success('<?php echo e(translate("offline payment verify status changed")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else{
                        toastr.error('<?php echo e(translate("offline payment verify status not changed")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }

                },
                error: function () {
                }
            });
        }

        function last_location_view() {
            toastr.warning('<?php echo e(translate("Only available when order is out for delivery!")); ?>', {
                CloseButton: true,
                ProgressBar: true
            });
        }

        $(document).on('change', '#from_date', function () {
            var id = $(this).attr("data-id");
            console.log(id);
            var value = $(this).val();
            console.log(value);
            Swal.fire({
                title: '<?php echo e(translate("Are you sure Change this Delivery date?")); ?>',
                text: "<?php echo e(translate("You won't be able to revert this!")); ?>",
                showCancelButton: true,
                confirmButtonColor: '#01684b',
                cancelButtonColor: 'secondary',
                confirmButtonText: '<?php echo e(translate("Yes, Change it!")); ?>'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.post({
                        url: "<?php echo e(route('admin.order.update-deliveryDate')); ?>",

                        data: {
                            "id": id,
                            "deliveryDate": value
                        },

                        success: function (data) {
                            console.log(data);
                            toastr.success('Delivery Date Change successfully');
                            location.reload();
                        }
                    });
                }
            })
        });

        $(document).on('change', '.time_slote', function () {
            var id = $(this).attr("data-id");
            var value = $(this).val();
            Swal.fire({
                title: '<?php echo e(translate("Are you sure Change this?")); ?>',
                text: "<?php echo e(translate("You won't be able to revert this!")); ?>",
                showCancelButton: true,
                confirmButtonColor: '#01684b',
                cancelButtonColor: 'secondary',
                confirmButtonText: 'Yes, Change it!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.post({
                        url: "<?php echo e(route('admin.order.update-timeSlot')); ?>",

                        data: {
                            "id": id,
                            "timeSlot": value
                        },

                        success: function (data) {
                            toastr.success('<?php echo e(translate("Time Slot Change successfully")); ?>');
                            location.reload();
                        }
                    });
                }
            })
        });

        $(document).on('ready', function () {
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script>
        var lightbox = function (o) {
            var s = void 0,
                c = void 0,
                u = void 0,
                d = void 0,
                i = void 0,
                p = void 0,
                m = document,
                e = m.body,
                l = "fadeIn .3s",
                v = "fadeOut .3s",
                t = "scaleIn .3s",
                f = "scaleOut .3s",
                a = "lightbox-btn",
                n = "lightbox-gallery",
                b = "lightbox-trigger",
                g = "lightbox-active-item",
                y = function () {
                    return e.classList.toggle("remove-scroll");
                },
                r = function (e) {
                    if (
                        ("A" === o.tagName && (e = e.getAttribute("href")),
                            e.match(/\.(jpeg|jpg|gif|png)/))
                    ) {
                        var t = m.createElement("img");
                        return (
                            (t.className = "lightbox-image"),
                                (t.src = e),
                            "A" === o.tagName &&
                            (t.alt = o.getAttribute("data-image-alt")),
                                t
                        );
                    }
                    if (e.match(/(youtube|vimeo)/)) {
                        var a = [];
                        return (
                            e.match("youtube") &&
                            ((a.id = e
                                .split(/v\/|v=|youtu\.be\//)[1]
                                .split(/[?&]/)[0]),
                                (a.url = "youtube.com/embed/"),
                                (a.options = "?autoplay=1&rel=0")),
                            e.match("vimeo") &&
                            ((a.id = e
                                .split(/video\/|https:\/\/vimeo\.com\//)[1]
                                .split(/[?&]/)[0]),
                                (a.url = "player.vimeo.com/video/"),
                                (a.options = "?autoplay=1title=0&byline=0&portrait=0")),
                                (a.player = m.createElement("iframe")),
                                a.player.setAttribute("allowfullscreen", ""),
                                (a.player.className = "lightbox-video-player"),
                                (a.player.src = "https://" + a.url + a.id + a.options),
                                (a.wrapper = m.createElement("div")),
                                (a.wrapper.className = "lightbox-video-wrapper"),
                                a.wrapper.appendChild(a.player),
                                a.wrapper
                        );
                    }
                    return m.querySelector(e).children[0].cloneNode(!0);
                },
                h = function (e) {
                    var t = {
                        next: e.parentElement.nextElementSibling,
                        previous: e.parentElement.previousElementSibling,
                    };
                    for (var a in t)
                        null !== t[a] && (t[a] = t[a].querySelector("[data-lightbox]"));
                    return t;
                },
                x = function (e) {
                    p.removeAttribute("style");
                    var t = h(u)[e];
                    if (null !== t)
                        for (var a in ((i.style.animation = v),
                            setTimeout(function () {
                                i.replaceChild(r(t), i.children[0]),
                                    (i.style.animation = l);
                            }, 200),
                            u.classList.remove(g),
                            t.classList.add(g),
                            (u = t),
                            c))
                            c.hasOwnProperty(a) && (c[a].disabled = !h(t)[a]);
                },
                E = function (e) {
                    var t = e.target,
                        a = e.keyCode,
                        i = e.type;
                    ((("click" == i && -1 !== [d, s].indexOf(t)) ||
                        ("keyup" == i && 27 == a)) &&
                    d.parentElement === o.parentElement &&
                    (N("remove"),
                        (d.style.animation = v),
                        (p.style.animation = [f, v]),
                        setTimeout(function () {
                            if ((y(), o.parentNode.removeChild(d), "A" === o.tagName)) {
                                u.classList.remove(g);
                                var e = m.querySelector("." + b);
                                e.classList.remove(b), e.focus();
                            }
                        }, 200)),
                        c) &&
                    ((("click" == i && t == c.next) || ("keyup" == i && 39 == a)) &&
                    x("next"),
                    (("click" == i && t == c.previous) ||
                        ("keyup" == i && 37 == a)) &&
                    x("previous"));
                    if ("keydown" == i && 9 == a) {
                        var l = ["[href]", "button", "input", "select", "textarea"];
                        l = l.map(function (e) {
                            return e + ":not([disabled])";
                        });
                        var n = (l = d.querySelectorAll(l.toString()))[0],
                            r = l[l.length - 1];
                        e.shiftKey
                            ? m.activeElement == n && (r.focus(), e.preventDefault())
                            : (m.activeElement == r && (n.focus(), e.preventDefault()),
                                r.addEventListener("blur", function () {
                                    r.disabled && (n.focus(), e.preventDefault());
                                }));
                    }
                },
                N = function (t) {
                    ["click", "keyup", "keydown"].forEach(function (e) {
                        "remove" !== t
                            ? m.addEventListener(e, function (e) {
                                return E(e);
                            })
                            : m.removeEventListener(e, function (e) {
                                return E(e);
                            });
                    });
                };
            !(function () {
                if (
                    ((s = m.createElement("button")).setAttribute(
                        "aria-label",
                        "Close"
                    ),
                        (s.className = a + " " + a + "-close"),
                        ((i = m.createElement("div")).className = "lightbox-content"),
                        i.appendChild(r(o)),
                        ((p = i.cloneNode(!1)).className = "lightbox-wrapper"),
                        (p.style.animation = [t, l]),
                        p.appendChild(s),
                        p.appendChild(i),
                        ((d = i.cloneNode(!1)).className = "lightbox-container"),
                        (d.style.animation = l),
                        (d.onclick = function () {}),
                        d.appendChild(p),
                    "A" === o.tagName && "gallery" === o.getAttribute("data-lightbox"))
                )
                    for (var e in (d.classList.add(n),
                        (c = { previous: "", next: "" })))
                        c.hasOwnProperty(e) &&
                        ((c[e] = s.cloneNode(!1)),
                            c[e].setAttribute("aria-label", e),
                            (c[e].className = a + " " + a + "-" + e),
                            (c[e].disabled = !h(o)[e]),
                            p.appendChild(c[e]));
                "A" === o.tagName &&
                (o.blur(), (u = o).classList.add(g), o.classList.add(b)),
                    o.parentNode.insertBefore(d, o.nextSibling),
                    y();
            })(),
                N();
        };

        Array.prototype.forEach.call(
            document.querySelectorAll("[data-lightbox]"),
            function (t) {
                t.addEventListener("click", function (e) {
                    e.preventDefault(), new lightbox(t);
                });
            }
        );

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/order/order-view.blade.php ENDPATH**/ ?>