<?php $__env->startSection('title', translate('Customer List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/employee.png')); ?>" class="w--20" alt="<?php echo e(translate('customer')); ?>">
                </span>
                <span>
                    <?php echo e(translate('customers list')); ?> <span class="badge badge-soft-primary ml-2 badge-pill"><?php echo e($customers->total()); ?></span>
                </span>
            </h1>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card--header">
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group">
                            <input id="datatableSearch_" type="search" name="search"
                                class="form-control"
                                placeholder="<?php echo e(translate('Search by Name or Phone or Email')); ?>" aria-label="Search"
                                value="<?php echo e($search); ?>" required autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text">
                                    <?php echo e(translate('search')); ?>

                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="hs-unfold ml-auto">
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
                            <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.customer.export', ['search'=>Request::get('search')])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="<?php echo e(translate('excel')); ?>">
                                <?php echo e(translate('excel')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-hover table-align-middle m-0 text-14px">
                    <thead class="thead-light">
                    <tr class="word-nobreak">
                        <th>
                            <?php echo e(translate('#')); ?>

                        </th>
                        <th class="table-column-pl-0"><?php echo e(translate('customer name')); ?></th>
                        <th><?php echo e(translate('contact info')); ?></th>
                        <th class="text-center"><?php echo e(translate('Total Orders')); ?></th>
                        <th class="text-center"><?php echo e(translate('Total Order Amount')); ?></th>
                        <th class="text-center"><?php echo e(translate('status')); ?></th>
                        <th class="text-center"><?php echo e(translate('action')); ?></th>
                    </tr>
                    </thead>
                    <tbody id="set-rows">
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($customers->firstItem()+$key); ?>

                            </td>
                            <td class="table-column-pl-0">
                                <a href="<?php echo e(route('admin.customer.view',[$customer['id']])); ?>" class="product-list-media">
                                    <img class="rounded-full"
                                         src="<?php echo e($customer->imageFullPath); ?>"
                                        alt="<?php echo e(translate('customer')); ?>">
                                    <div class="table--media-body">
                                        <h5 class="title m-0">
                                            <?php echo e($customer['f_name']." ".$customer['l_name']); ?>

                                        </h5>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <h5 class="m-0">
                                    <a href="mailto:<?php echo e($customer['email']); ?>"><?php echo e($customer['email']); ?></a>
                                </h5>
                                <div>
                                    <a href="Tel:<?php echo e($customer['phone']); ?>"><?php echo e($customer['phone']); ?></a>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <a href="<?php echo e(route('admin.customer.view',[$customer['id']])); ?>">
                                        <span class="badge badge-soft-info py-2 px-3 font-medium">
                                            <?php echo e($customer->orders->count()); ?>

                                        </span>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php echo e(Helpers::set_symbol(\App\User::total_order_amount($customer->id))); ?>

                                </div>
                            </td>
                            <td>
                                <label class="toggle-switch my-0">
                                    <input type="checkbox"
                                           class="toggle-switch-input status-change-alert" id="stocksCheckbox<?php echo e($customer->id); ?>"
                                           data-route="<?php echo e(route('admin.customer.status', [$customer->id, $customer->is_block ? 0 : 1])); ?>"
                                           data-message="<?php echo e($customer->is_block? translate('you_want_to_change_the_status_for_this_customer'): translate('you_want_to_change_the_status_for_this_customer')); ?>"
                                        <?php echo e($customer->is_block ? '' : 'checked'); ?>>
                                    <span class="toggle-switch-label mx-auto text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="action-btn" href="<?php echo e(route('admin.customer.view',[$customer['id']])); ?>">
                                        <i class="tio-invisible"></i>
                                    </a>
                                    <a class="action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                       data-id="customer-<?php echo e($customer['id']); ?>"
                                       data-message="<?php echo e(translate('Want to remove this customer')); ?>?">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.customer.delete',[$customer['id']])); ?>"
                                          method="post" id="customer-<?php echo e($customer['id']); ?>">
                                        <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if(count($customers) == 0): ?>
            <div class="text-center p-4">
                <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('image')); ?>">
                <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
            </div>
            <?php endif; ?>

            <div class="card-footer">
                <?php echo $customers->links(); ?>

            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/customer/list.blade.php ENDPATH**/ ?>