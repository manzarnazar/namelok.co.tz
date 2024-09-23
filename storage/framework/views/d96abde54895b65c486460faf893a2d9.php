<?php $__env->startSection('title', translate('Deliveryman List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/employee.png')); ?>" class="w--24" alt="<?php echo e(translate('deliveryman')); ?>">
                </span>
                <span>
                    <?php echo e(translate('deliveryman')); ?> <?php echo e(translate('list')); ?>

                </span>
                <span class="badge badge-soft-info badge-pill"><?php echo e($deliverymen->total()); ?></span>
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
                                    <?php echo e(translate('Search')); ?>

                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="hs-unfold ml-sm-auto">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary-2 btn--primary font--sm" href="javascript:;"
                           data-hs-unfold-options='{
                            "target": "#usersExportDropdown",
                            "type": "css-animation"
                            }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(translate('export')); ?>

                        </a>

                        <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                            <span class="dropdown-header"><?php echo e(translate('download')); ?> <?php echo e(translate('options')); ?></span>
                            <a id="export-excel" class="dropdown-item"
                               href="<?php echo e(route('admin.delivery-man.export', ['search'=>Request::get('search')])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2" src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg" alt="<?php echo e(translate('excel')); ?>">
                                <?php echo e(translate('excel')); ?>

                            </a>
                        </div>
                    </div>
                    <a href="<?php echo e(route('admin.delivery-man.add')); ?>" class="btn btn--primary py-2"><i class="tio-add-circle"></i> <?php echo e(translate('add deliveryman')); ?></a>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                    <tr>
                        <th><?php echo e(translate('#')); ?></th>
                        <th><?php echo e(translate('name')); ?></th>
                        <th><?php echo e(translate('Contact Info')); ?></th>
                        <th><?php echo e(translate('Total Orders')); ?></th>
                        <th class="text-center"><?php echo e(translate('Status')); ?></th>
                        <th class="text-center"><?php echo e(translate('action')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    <?php $__currentLoopData = $deliverymen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$deliveryman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($deliverymen->firstItem()+$key); ?></td>
                            <td>
                                <div class="table--media">
                                    <img class="rounded-full"
                                         src="<?php echo e($deliveryman->imageFullPath); ?>" alt="<?php echo e(translate('deliveryman')); ?>">
                                    <div class="table--media-body">
                                        <h5 class="title">
                                            <?php echo e($deliveryman['f_name']); ?> <?php echo e($deliveryman['l_name']); ?>

                                        </h5>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5 class="m-0">
                                    <a href="mailto:<?php echo e($deliveryman['email']); ?>" class="text-hover"><?php echo e($deliveryman['email']); ?></a>
                                </h5>
                                <div>
                                    <a href="tel:<?php echo e($deliveryman['phone']); ?>" class="text-hover"><?php echo e($deliveryman['phone']); ?></a>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-soft-info py-2 px-3 font-bold">
                                    <?php echo e($deliveryman->orders->count()); ?>

                                </span>
                            </td>
                            <td>
                                <label class="toggle-switch my-0">
                                    <input type="checkbox"
                                           data-route="<?php echo e(route('admin.delivery-man.status', [$deliveryman->id, $deliveryman->is_active ? 0 : 1])); ?>"
                                           data-message="<?php echo e($deliveryman->is_active? translate('you_want_to_disable_this_deliveryman'): translate('you_want_to_active_this_deliveryman')); ?>"
                                           class="toggle-switch-input status-change-alert" id="stocksCheckbox<?php echo e($deliveryman->id); ?>"
                                        <?php echo e($deliveryman->is_active ? 'checked' : ''); ?>>
                                    <span class="toggle-switch-label mx-auto text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="action-btn"
                                        href="<?php echo e(route('admin.delivery-man.edit',[$deliveryman['id']])); ?>">
                                    <i class="tio-edit"></i>
                                </a>
                                    <a class="action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                       data-id="delivery-man-<?php echo e($deliveryman['id']); ?>"
                                       data-message="<?php echo e(translate('Want to remove this deliveryman')); ?>?">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.delivery-man.delete',[$deliveryman['id']])); ?>"
                                            method="post" id="delivery-man-<?php echo e($deliveryman['id']); ?>">
                                        <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="page-area">
                    <table>
                        <tfoot>
                        <?php echo $deliverymen->links(); ?>

                        </tfoot>
                    </table>
                </div>
                <?php if(count($deliverymen)==0): ?>
                    <div class="text-center p-4">
                        <img class="w-120px mb-3" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/sorry.svg" alt="<?php echo e(translate('image')); ?>">
                        <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/delivery-man/list.blade.php ENDPATH**/ ?>