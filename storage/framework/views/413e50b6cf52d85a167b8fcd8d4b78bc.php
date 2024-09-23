<?php $__env->startSection('title', translate('Customer Details')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-print-none pb-2">
            <div class="page-header border-bottom">
                <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/employee.png')); ?>" class="w--20" alt="<?php echo e(translate('customer')); ?>">
                </span>
                    <span class="page-header-title pt-2">
                        <?php echo e(translate('customer_Details')); ?>

                    </span>
                </h1>
            </div>
        </div>

        <div class="d-print-none pb-2">
            <div class="row align-items-center">
                <div class="col-auto mb-2 mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(translate('customer')); ?> <?php echo e(translate('id')); ?> #<?php echo e($customer['id']); ?></h1>
                    <span class="d-block">
                        <i class="tio-date-range"></i> <?php echo e(translate('joined_at')); ?> : <?php echo e(date('d M Y '.config('timeformat'),strtotime($customer['created_at']))); ?>

                    </span>
                </div>

                <div class="col-auto ml-auto">
                    <a class="btn btn-icon btn-sm btn-soft-secondary rounded-circle mr-1"
                       href="<?php echo e(route('admin.customer.view',[$customer['id']-1])); ?>"
                       data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Previous customer')); ?>">
                        <i class="tio-arrow-backward"></i>
                    </a>
                    <a class="btn btn-icon btn-sm btn-soft-secondary rounded-circle"
                       href="<?php echo e(route('admin.customer.view',[$customer['id']+1])); ?>" data-toggle="tooltip"
                       data-placement="top" title="<?php echo e(translate('Next customer')); ?>">
                        <i class="tio-arrow-forward"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mb-2 g-2">


            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="resturant-card bg--2">
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/dashboard/1.png')); ?>" alt="<?php echo e(translate('image')); ?>">
                    <div class="for-card-text font-weight-bold  text-uppercase mb-1"><?php echo e(translate('wallet')); ?> <?php echo e(translate('balance')); ?></div>
                    <div class="for-card-count"><?php echo e(Helpers::set_symbol($customer->wallet_balance??0)); ?></div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="resturant-card bg--3">
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/dashboard/3.png')); ?>" alt="<?php echo e(translate('image')); ?>">
                    <div class="for-card-text font-weight-bold  text-uppercase mb-1"><?php echo e(translate('loyalty_point')); ?> <?php echo e(translate('balance')); ?></div>
                    <div class="for-card-count"><?php echo e($customer->loyalty_point??0); ?></div>
                </div>
            </div>
        </div>


        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card">
                    <div class="card-header">
                        <div class="card--header">
                        <h5 class="card-title"><?php echo e(translate('Order List')); ?> <span class="badge badge-soft-secondary"><?php echo e(count($orders)); ?></span></h5>
                            <form action="<?php echo e(url()->current()); ?>" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search"
                                           class="form-control"
                                           placeholder="<?php echo e(translate('Search by Order Id or Order Amount')); ?>" aria-label="Search"
                                           value="<?php echo e($search); ?>" required autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text">
                                            <?php echo e(__('Search')); ?>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <h5 class="card-header-title">
                        </h5>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('#')); ?></th>
                                <th class="text-center"><?php echo e(translate('order')); ?> <?php echo e(translate('id')); ?></th>
                                <th class="text-center"><?php echo e(translate('total amount')); ?></th>
                                <th class="text-center"><?php echo e(translate('action')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($orders->firstItem()+$key); ?></td>
                                    <td class=" text-center">
                                        <a href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                                    </td>
                                    <td class="text-center"><?php echo e(Helpers::set_symbol($order['order_amount'])); ?></td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="action-btn"
                                                href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><i
                                                    class="tio-invisible"></i></a>
                                            <a class="action-btn btn--primary btn-outline-primary" target="_blank"
                                                href="<?php echo e(route('admin.orders.generate-invoice',[$order['id']])); ?>">
                                                <i class="tio-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="card-footer">
                        <?php echo $orders->links(); ?>

                        </div>
                        <?php if(count($orders)==0): ?>
                            <div class="text-center p-4">
                                <img class="w-120px mb-3" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/sorry.svg" alt="<?php echo e(translate('image')); ?>">
                                <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>



            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">
                            <span class="card-header-icon">
                                <i class="tio-user"></i>
                            </span>
                            <span>
                                <?php if($customer): ?>
                                    <?php echo e($customer['f_name'].' '.$customer['l_name']); ?>

                                    <?php else: ?>
                                    <?php echo e(translate('customer')); ?>

                                <?php endif; ?>
                            </span>
                        </h4>
                    </div>

                    <?php if($customer): ?>
                        <div class="card-body">
                            <div class="media align-items-center customer--information-single" href="javascript:">
                                <div class="avatar avatar-circle">
                                    <img
                                        class="avatar-img"
                                        src="<?php echo e($customer->imageFullPath); ?>"
                                        alt="<?php echo e(translate('customer')); ?>">
                                </div>
                                <div class="media-body">
                                    <ul class="list-unstyled m-0">
                                        <li class="pb-1">
                                            <i class="tio-email mr-2"></i>
                                            <a href="mailto:<?php echo e($customer['email']); ?>"><?php echo e($customer['email']); ?></a>
                                        </li>
                                        <li class="pb-1">
                                            <i class="tio-call-talking-quiet mr-2"></i>
                                            <a href="Tel:<?php echo e($customer['phone']); ?>"><?php echo e($customer['phone']); ?></a>
                                        </li>
                                        <li class="pb-1">
                                            <i class="tio-shopping-basket-outlined mr-2"></i>
                                            <?php echo e($customer->orders->count()); ?> <?php echo e(translate('orders')); ?>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5><?php echo e(translate('contact')); ?> <?php echo e(translate('info')); ?></h5>
                            </div>
                            <?php $__currentLoopData = $customer->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <ul class="list-unstyled list-unstyled-py-2">
                                    <?php if($address['contact_person_number']): ?>
                                        <li>
                                            <i class="tio-call-talking-quiet mr-2"></i>
                                            <?php echo e($address['contact_person_number']); ?>

                                        </li>
                                    <?php endif; ?>
                                    <li class="quick--address-bar">
                                        <div class="quick-icon badge-soft-secondary">
                                            <i class="tio-home"></i>
                                        </div>
                                        <div class="info">
                                            <h6><?php echo e(translate($address['address_type'])); ?></h6>
                                            <a target="_blank" href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo e($address['latitude']); ?>+<?php echo e($address['longitude']); ?>" class="text--title">
                                                <?php echo e($address['address']); ?>

                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/customer/customer-view.blade.php ENDPATH**/ ?>