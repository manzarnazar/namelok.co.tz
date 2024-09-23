<?php $__env->startSection('title', translate('verify_offline_payments')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <style>
        table{
            width: 100%
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="mb-0 page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/all_orders.png')); ?>" class="w--20" alt="">
                </span>
                <span class="">
                    <?php echo e(translate('verify_offline_payments')); ?>

                    <span class="badge badge-pill badge-soft-secondary ml-2"><?php echo e($orders->total()); ?></span>
                </span>
            </h1>
            <ul class="nav nav-tabs border-0 my-2">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('admin/verify-offline-payment/pending')?'active':''); ?>"  href="<?php echo e(route('admin.verify-offline-payment', ['pending'])); ?>"><?php echo e(translate('Pending Orders')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('admin/verify-offline-payment/denied')?'active':''); ?>"  href="<?php echo e(route('admin.verify-offline-payment', ['denied'])); ?>"><?php echo e(translate('Denied Orders')); ?></a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body p-20px">
                <div class="order-top">
                    <div class="card--header">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search"
                                       class="form-control"
                                       placeholder="<?php echo e(translate('Search by order ID')); ?>" aria-label="Search"
                                       value="<?php echo e($search); ?>" required autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">
                                        <?php echo e(translate('Search')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive datatable-custom">
                    <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                        <tr>
                            <th class="">
                                <?php echo e(translate('#')); ?>

                            </th>
                            <th class="table-column-pl-0"><?php echo e(translate('order ID')); ?></th>
                            <th><?php echo e(translate('Delivery')); ?> <?php echo e(translate('date')); ?></th>
                            <th><?php echo e(translate('customer')); ?></th>
                            <th><?php echo e(translate('total amount')); ?></th>
                            <th><?php echo e(translate('Payment_Method')); ?></th>
                            <th><?php echo e(translate('Verification_Status')); ?></th>
                            <th>
                                <div class="text-center">
                                    <?php echo e(translate('action')); ?>

                                </div>
                            </th>
                        </tr>
                        </thead>

                        <tbody id="set-rows">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                                <td class="">
                                    <?php echo e($orders->firstItem()+$key); ?>

                                </td>
                                <td class="table-column-pl-0">
                                    <a href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                                </td>
                                <td>
                                    <div>
                                        <?php echo e(date('d M Y',strtotime($order['delivery_date']))); ?>

                                        <span><?php echo e($order->time_slot?date(config('time_format'), strtotime($order->time_slot['start_time'])).' - ' .date(config('time_format'), strtotime($order->time_slot['end_time'])) :'No Time Slot'); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php if($order->is_guest == 0): ?>
                                        <?php if(isset($order->customer)): ?>
                                            <div>
                                                <a class="text-body text-capitalize font-medium"
                                                   href="<?php echo e(route('admin.customer.view',[$order['user_id']])); ?>"><?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></a>
                                            </div>
                                            <div class="text-sm">
                                                <a href="Tel:<?php echo e($order->customer['phone']); ?>"><?php echo e($order->customer['phone']); ?></a>
                                            </div>
                                        <?php elseif($order->user_id != null && !isset($order->customer)): ?>
                                            <label
                                                class="text-danger"><?php echo e(translate('Customer_not_available')); ?>

                                            </label>
                                        <?php else: ?>
                                            <label
                                                class="text-success"><?php echo e(translate('Walking Customer')); ?>

                                            </label>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <label
                                            class="text-success"><?php echo e(translate('Guest Customer')); ?>

                                        </label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="mw-90">
                                        <div>
                                                <?php
                                                $vatStatus = $order->details[0] ? $order->details[0]->vat_status : '';
                                                if($vatStatus == 'included'){
                                                    $orderAmount = $order['order_amount'] - $order['total_tax_amount'];
                                                }else{
                                                    $orderAmount = $order['order_amount'];
                                                }
                                                ?>
                                            <?php echo e(Helpers::set_symbol($orderAmount)); ?>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        $paymentInfo = json_decode($order->offline_payment?->payment_info, true);
                                    ?>
                                    <?php echo e($paymentInfo['payment_name']); ?>

                                </td>
                                <td class="text-capitalize">
                                    <?php if($order->offline_payment?->status == 0): ?>
                                        <span class="badge badge-soft-info">
                                            <?php echo e(translate('pending')); ?>

                                        </span>
                                    <?php elseif($order->offline_payment?->status == 2): ?>
                                        <span class="badge badge-soft-danger">
                                            <?php echo e(translate('denied')); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <button class="btn btn--primary offline_details" type="button" id="offline_details"
                                                data-id="<?php echo e($order['id']); ?>"
                                                data-target="" data-toggle="modal">
                                            <?php echo e(translate('Verify_Payment')); ?>

                                        </button>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if(count($orders)==0): ?>
                    <div class="text-center p-4">
                        <img class="w-120px mb-3" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/sorry.svg" alt="Image Description">
                        <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="card-footer border-0">
                <div class="d-flex justify-content-center justify-content-sm-end">
                    <?php echo $orders->links(); ?>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="quick-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered coupon-details modal-lg" role="document">
            <div class="modal-content" id="quick-view-modal">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

    <script>
        "use strict";

        $('.offline_details').on('click', function() {
            var orderId = $(this).data('id');
            get_offline_payment(orderId);
        });

        function get_offline_payment(id){

            $.ajax({
                type: 'GET',
                url: '<?php echo e(route('admin.offline-modal-view')); ?>',
                data: {
                    id: id
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#loading').hide();
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                }
            });
        }

        function verify_offline_payment(order_id, status) {
            $.ajax({
                type: "GET",
                url: '<?php echo e(url('/')); ?>/admin/orders/verify-offline-payment/'+ order_id+ '/' + status,
                success: function (data) {
                    location.reload();
                    if(data.status == true) {
                        toastr.success(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else{
                        toastr.error(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }

                },
                error: function () {
                }
            });
        }

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/order/offline-payment/list.blade.php ENDPATH**/ ?>