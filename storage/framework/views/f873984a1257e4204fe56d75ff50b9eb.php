<?php $__env->startSection('title',translate('customer_loyalty_point').' '.translate('report')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(asset('/public/assets/admin/img/point.png')); ?>" alt="<?php echo e(translate('loyalty_point')); ?>" class="width-24">
                </div>
                <span>
                    <?php echo e(translate('customer_loyalty_point')); ?> <?php echo e(translate('report')); ?>

                </span>
            </h1>
        </div>

        <div class="card mb-3">
            <div class="card-header text-capitalize">
                <h5 class="card-title">
                    <span class="card-header-icon">
                        <i class="tio-filter-outlined"></i>
                    </span>
                    <span><?php echo e(translate('filter')); ?> <?php echo e(translate('options')); ?></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 pt-3">
                        <form action="<?php echo e(route('admin.customer.loyalty-point.report')); ?>" method="get">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <input type="date" name="from" id="from_date" value="<?php echo e(request()->get('from')); ?>" class="form-control h--45px" title="<?php echo e(translate('from')); ?> <?php echo e(translate('date')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <input type="date" name="to" id="to_date" value="<?php echo e(request()->get('to')); ?>" class="form-control h--45px" title="<?php echo e(ucfirst(translate('to'))); ?> <?php echo e(translate('date')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <?php
                                            $transactionStatus=request()->get('transaction_type');
                                        ?>
                                        <select name="transaction_type" id="" class="form-control h--45px" title="<?php echo e(translate('select')); ?> <?php echo e(translate('transaction_type')); ?>">
                                            <option value=""><?php echo e(translate('all')); ?></option>
                                            <option value="loyalty_point_to_wallet" <?php echo e(isset($transactionStatus) && $transactionStatus=='loyalty_point_to_wallet'?'selected':''); ?>><?php echo e(translate('loyalty_point_to_wallet')); ?></option>
                                            <option value="order_place" <?php echo e(isset($transactionStatus) && $transactionStatus=='order_place'?'selected':''); ?>><?php echo e(translate('order_place')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <select id='customer' name="customer_id" data-placeholder="<?php echo e(translate('select_customer')); ?>" class="js-data-example-ajax form-control h--45px" title="<?php echo e(translate('select_customer')); ?>">
                                            <?php if(request()->get('customer_id') && $customerInfo = \App\User::find(request()->get('customer_id'))): ?>
                                                <option value="<?php echo e($customerInfo->id); ?>" selected><?php echo e($customerInfo->f_name.' '.$customerInfo->l_name); ?>(<?php echo e($customerInfo->phone); ?>)</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="reset" id="reset_btn" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                                <button type="submit" class="btn btn-primary"><i class="tio-filter-list mr-1"></i><?php echo e(translate('filter')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="row g-3">
            <?php
                $credit = $data[0]->total_credit??0;
                $debit = $data[0]->total_debit??0;
                $balance = $credit - $debit;
            ?>
            <div class="col-sm-4">
                <div class="resturant-card dashboard--card bg--2">
                    <h4 class="title"><?php echo e(translate('debit')); ?></h4>
                    <span class="subtitle">
                        <?php echo e(number_format($debit, 2)); ?>

                    </span>
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/dashboard/3.png')); ?>" alt=" <?php echo e(translate('image')); ?>">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="resturant-card dashboard--card bg--3">
                    <h4 class="title"><?php echo e(translate('credit')); ?></h4>
                    <span class="subtitle">
                        <?php echo e(number_format($credit, 2)); ?>

                    </span>
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/dashboard/4.png')); ?>" alt=" <?php echo e(translate('image')); ?>">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="resturant-card dashboard--card bg--1">
                    <h4 class="title"><?php echo e(translate('balance')); ?></h4>
                    <span class="subtitle">
                        <?php echo e(number_format($balance, 2)); ?>

                    </span>
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/dashboard/1.png')); ?>" alt=" <?php echo e(translate('image')); ?>">
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header text-capitalize border-0">
                <h4 class="card-title">
                    <span class="card-header-icon"><i class="tio-money"></i></span>
                    <span><?php echo e(translate('transactions')); ?></span>
                </h4>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                           class="table table-thead-bordered table-align-middle card-table table-nowrap">
                        <thead class="thead-light">
                        <tr>
                            <th><?php echo e(translate('sl')); ?></th>
                            <th><?php echo e(translate('transaction')); ?> <?php echo e(translate('id')); ?></th>
                            <th><?php echo e(translate('Customer')); ?></th>
                            <th><?php echo e(translate('credit')); ?></th>
                            <th><?php echo e(translate('debit')); ?></th>
                            <th><?php echo e(translate('balance')); ?></th>
                            <th><?php echo e(translate('transaction_type')); ?></th>
                            <th><?php echo e(translate('created_at')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$loyaltyTransaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr scope="row">
                                <td ><?php echo e($k+$transactions->firstItem()); ?></td>
                                <td><?php echo e($loyaltyTransaction->transaction_id); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.customer.view',['user_id'=>$loyaltyTransaction->user_id])); ?>">
                                        <?php echo e(Str::limit($loyaltyTransaction->customer?$loyaltyTransaction->customer->f_name.' '.$loyaltyTransaction->customer->l_name:translate('not_found'),20,'...')); ?>

                                    </a>
                                </td>
                                <td><?php echo e($loyaltyTransaction->credit); ?></td>
                                <td><?php echo e($loyaltyTransaction->debit); ?></td>
                                <td><?php echo e($loyaltyTransaction->balance); ?></td>
                                <td>
                                    <span class="badge badge-soft-<?php echo e($loyaltyTransaction->transaction_type=='point_to_wallet'?'success':'dark'); ?>">
                                        <?php echo e(translate($loyaltyTransaction->transaction_type)); ?>

                                    </span>
                                </td>
                                <td><?php echo e(date('Y/m/d '.config('timeformat'), strtotime($loyaltyTransaction->created_at))); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if(!$transactions): ?>
                        <div class="empty--data">
                            <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                            <h5>
                                <?php echo e(translate('no_data_found')); ?>

                            </h5>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="page-area px-4 py-4">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            <?php echo $transactions->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";

        $(document).on('ready', function () {
            $('.js-data-example-ajax').select2({
                ajax: {
                    url: '<?php echo e(route('admin.customer.select-list')); ?>',
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            all: true,
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    __port: function (params, success, failure) {
                        var $request = $.ajax(params);

                        $request.then(success);
                        $request.fail(failure);

                        return $request;
                    }
                }
            });
        });
    </script>

    <script>
        $('#from_date,#to_date').change(function () {
            let fr = $('#from_date').val();
            let to = $('#to_date').val();
            if (fr != '' && to != '') {
                if (fr > to) {
                    $('#from_date').val('');
                    $('#to_date').val('');
                    toastr.error('Invalid date range!', Error, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            }

        });

        $('#reset_btn').click(function(){
            $('#customer').val(null).trigger('change');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/customer/loyalty-point/report.blade.php ENDPATH**/ ?>