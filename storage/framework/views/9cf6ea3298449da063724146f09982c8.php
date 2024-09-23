<?php $__env->startSection('title', translate('Order List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/empty-cart.png')); ?>" class="w--20" alt="">
                </span>
                <span>
                    <?php echo e(translate('pos')); ?> <?php echo e(translate('orders')); ?> <span class="badge badge-pill badge-soft-secondary ml-2"><?php echo e($orders->total()); ?></span>
                </span>
            </h1>
        </div>

        <div class="card">
            <div class="card-header shadow flex-wrap p-20px border-0">
                <h5 class="form-bold w-100 mb-3"><?php echo e(translate('Select Date Range')); ?></h5>
                <form class="w-100">
                    <div class="row g-3 g-sm-4 g-md-3 g-lg-4">
                        <div class="col-sm-6 col-md-4 col-lg-2">
                            <select class="custom-select custom-select-sm text-capitalize min-h-45px" name="branch_id">
                                <option disabled>--- <?php echo e(translate('select')); ?> <?php echo e(translate('branch')); ?> ---</option>
                                <option value="all" <?php echo e($branchId == 'all' ? 'selected': ''); ?>><?php echo e(translate('all')); ?> <?php echo e(translate('branch')); ?></option>
                                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($branch['id']); ?>" <?php echo e($branch['id'] == $branchId ? 'selected' : ''); ?>><?php echo e($branch['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="input-date-group">
                                <label class="input-label" for="start_date"><?php echo e(translate('Start Date')); ?></label>
                                <label class="input-date">
                                    <input type="text" id="start_date" name="start_date" value="<?php echo e($startDate); ?>" class="js-flatpickr form-control flatpickr-custom min-h-45px" placeholder="yy-mm-dd" data-hs-flatpickr-options='{ "dateFormat": "Y-m-d"}'>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="input-date-group">
                                <label class="input-label" for="end_date"><?php echo e(translate('End Date')); ?></label>
                                <label class="input-date">
                                    <input type="text" id="end_date" name="end_date" value="<?php echo e($endDate); ?>" class="js-flatpickr form-control flatpickr-custom min-h-45px" placeholder="yy-mm-dd" data-hs-flatpickr-options='{ "dateFormat": "Y-m-d"}'>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-4 __btn-row">
                            <a href="<?php echo e(route('admin.pos.orders')); ?>" id="" class="btn w-100 btn--reset min-h-45px"><?php echo e(translate('clear')); ?></a>
                            <button type="submit" id="show_filter_data" class="btn w-100 btn--primary min-h-45px"><?php echo e(translate('show data')); ?></button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="card-body p-20px">
                <div class="order-top">
                    <div class="card--header">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search"
                                        class="form-control"
                                        placeholder="<?php echo e(translate('Search by ID, order or payment status')); ?>" aria-label="Search"
                                        value="<?php echo e($search); ?>" required autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">
                                        <?php echo e(translate('Search')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-outline-primary-2 dropdown-toggle min-height-40" href="javascript:;"
                                data-hs-unfold-options='{
                                        "target": "#usersExportDropdown",
                                        "type": "css-animation"
                                    }'>
                                <i class="tio-download-to mr-1"></i> <?php echo e(translate('export')); ?>

                            </a>

                            <div id="usersExportDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                <span class="dropdown-header"><?php echo e(translate('download')); ?>

                                    <?php echo e(translate('options')); ?></span>
                                <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.pos.orders.export', ['branch_id'=>Request::get('branch_id'), 'start_date'=>Request::get('start_date'), 'end_date'=>Request::get('end_date'), 'search'=>Request::get('search')])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                        alt="Image Description">
                                    <?php echo e(translate('excel')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive datatable-custom">
                    <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                        <tr>
                            <th>
                                <?php echo e(translate('#')); ?>

                            </th>
                            <th><?php echo e(translate('order id')); ?></th>
                            <th><?php echo e(translate('order date')); ?></th>
                            <th><?php echo e(translate('customer info')); ?></th>
                            <th><?php echo e(translate('Branch')); ?></th>
                            <th><?php echo e(translate('total amount')); ?></th>
                            <th class="text-center"><?php echo e(translate('order')); ?> <?php echo e(translate('status')); ?></th>
                            <th class="text-center"><?php echo e(translate('order')); ?> <?php echo e(translate('type')); ?></th>
                            <th class="text-center"><?php echo e(translate('actions')); ?></th>
                        </tr>
                        </thead>

                        <tbody id="set-rows">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                                <td class="">
                                    <?php echo e($key+$orders->firstItem()); ?>

                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.pos.order-details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                                </td>
                                <td><?php echo e(date('d M Y',strtotime($order['created_at']))); ?></td>

                                <td>
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
                                </td>
                                <td>
                                    <label class="badge badge-soft-primary"><?php echo e($order->branch?$order->branch->name: translate('Branch deleted!')); ?></label>
                                </td>
                                <td>
                                    <div class="mw-85">
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
                                        <?php if($order->payment_status=='paid'): ?>
                                            <span class="text-success">
                                                <?php echo e(translate('paid')); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-danger">
                                                <?php echo e(translate('unpaid')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="text-capitalize text-center">
                                    <?php if($order['order_status']=='pending'): ?>
                                        <span class="badge badge-soft-info">
                                            <?php echo e(translate('pending')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='confirmed'): ?>
                                        <span class="badge badge-soft-info">
                                        <?php echo e(translate('confirmed')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='processing'): ?>
                                        <span class="badge badge-soft-warning">
                                        <?php echo e(translate('packaging')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='picked_up'): ?>
                                        <span class="badge badge-soft-warning">
                                        <?php echo e(translate('out_for_delivery')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='delivered'): ?>
                                        <span class="badge badge-soft-success">
                                        <?php echo e(translate('delivered')); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger">
                                        <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-capitalize text-center">
                                    <?php if($order['order_type']=='take_away'): ?>
                                        <span class="badge badge-soft-info">
                                            <?php echo e(translate('take_away')); ?>

                                        </span>
                                    <?php elseif($order['order_type']=='pos'): ?>
                                        <span class="badge badge-soft-info">
                                        <?php echo e(translate('POS')); ?>

                                    </span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-success">
                                        <?php echo e(translate('delivery')); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="action-btn btn--primary btn-outline-primary"
                                           href="<?php echo e(route('admin.pos.order-details',['id'=>$order['id']])); ?>"><i
                                                class="tio-visible-outlined"></i></a>
                                        <button class="action-btn btn-outline-primary-2 print-invoice-btn" data-order-id="<?php echo e($order->id); ?>" target="_blank" type="button"><i
                                                class="tio-print"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if(count($orders) == 0): ?>
                <div class="text-center p-4">
                    <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                    <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                </div>
                <?php endif; ?>
                <div class="card-footer px-0">
                    <?php echo $orders->links(); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="print-invoice" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(translate('print')); ?> <?php echo e(translate('invoice')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <input type="button" class="btn btn-primary non-printable print-button"
                            value="<?php echo e(translate('Proceed, If thermal printer is ready.')); ?>"/>
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger non-printable">Back</a>
                    </div>
                    <hr class="non-printable">
                    <div class="row m-auto" id="printableArea">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/flatpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/admin/js/order.js')); ?>"></script>
    <script>
        "use strict";

        $('.print-invoice-btn').on('click', function() {
            var orderId = $(this).data('order-id');
            print_invoice(orderId);
        });

        function print_invoice(order_id) {
            $.get({
                url: '<?php echo e(url('/')); ?>/admin/pos/invoice/'+order_id,
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#print-invoice').modal('show');
                    $('#printableArea').empty().html(data.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/pos/order/list.blade.php ENDPATH**/ ?>