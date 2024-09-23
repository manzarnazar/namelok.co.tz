<?php $__env->startSection('title', translate('employee role')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="<?php echo e(asset('public/assets/admin/img/employee.png')); ?>" class="w--24" alt="<?php echo e(translate('employee')); ?>">
            </span>
            <span>
                <?php echo e(translate('Employee Role Setup')); ?>

            </span>
        </h1>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form id="submit-create-role" method="post" action="<?php echo e(route('admin.custom-role.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="max-w-500px">
                    <div class="form-group">
                        <label class="form-label"><?php echo e(translate('role_name')); ?></label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="<?php echo e(translate('Ex')); ?> : <?php echo e(translate('Store')); ?>" required>
                    </div>
                </div>

                <div class="d-flex">
                    <h5 class="input-label m-0 text-capitalize"><?php echo e(translate('module_permission')); ?> : </h5>
                    <div class="check-item pb-0 w-auto">
                        <input type="checkbox" id="select_all">
                        <label class="title-color mb-0 pl-2" for="select_all"><?php echo e(translate('select_all')); ?></label>
                    </div>
                </div>

                <div class="check--item-wrapper">
                    <?php $__currentLoopData = MANAGEMENT_SECTION; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="check-item">
                            <div class="form-group form-check form--check">
                                <input type="checkbox" name="modules[]" value="<?php echo e($section); ?>" class="form-check-input module-permission" id="<?php echo e($section); ?>">
                                <label class="form-check-label" for="<?php echo e($section); ?>"><?php echo e(translate($section)); ?></label>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="btn--container justify-content-end mt-4">
                    <button type="reset" class="btn btn--reset"><?php echo e(translate('reset')); ?></button>
                    <button type="submit" class="btn btn--primary"><?php echo e(translate('Submit')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            <div class="card--header">
                <h5 class="card-title"><?php echo e(translate('employee_roles_table')); ?> <span class="badge badge-soft-primary"><?php echo e(count($adminRoles)); ?></span></h5>
                <form action="<?php echo e(url()->current()); ?>" method="GET">
                    <div class="input-group">
                        <input id="datatableSearch_" type="search" name="search"
                            class="form-control"
                            placeholder="<?php echo e(translate('Search by Role Name')); ?>" aria-label="Search" required autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text">
                                <?php echo e(translate('Search')); ?>

                            </button>
                        </div>
                    </div>
                </form>

                <div class="hs-unfold ml-sm-3">
                    <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary-2 btn--primary font--sm" href="javascript:;"
                        data-hs-unfold-options='{
                            "target": "#usersExportDropdown",
                            "type": "css-animation"
                        }'>
                        <i class="tio-download-to mr-1"></i> <?php echo e(translate('export')); ?>

                    </a>

                    <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                        <span class="dropdown-header"><?php echo e(translate('download')); ?> <?php echo e(translate('options')); ?></span>
                        <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.custom-role.export')); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2" src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg" alt="<?php echo e(translate('excel')); ?>">
                            <?php echo e(translate('excel')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-borderless mb-0" id="dataTable" cellspacing="0">
                    <thead class="thead-light">
                    <tr>
                        <th><?php echo e(translate('SL')); ?></th>
                        <th><?php echo e(translate('role_name')); ?></th>
                        <th><?php echo e(translate('modules')); ?></th>
                        <th class="text-center"><?php echo e(translate('status')); ?></th>
                        <th class="text-center"><?php echo e(translate('action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $adminRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($k+1); ?></td>
                            <td><?php echo e($role['name']); ?></td>
                            <td class="text-capitalize">
                                <div class="max-w-300px">
                                    <?php if($role['module_access']!=null): ?>
                                        <?php ($comma = ''); ?>
                                        <?php $__currentLoopData = (array)json_decode($role['module_access']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($comma); ?><?php echo e(translate(str_replace('_',' ',$module))); ?>

                                            <?php ($comma = ', '); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <label class="toggle-switch my-0">
                                    <input type="checkbox"
                                           data-route="<?php echo e(route('admin.custom-role.status', [$role->id, $role->status ? 0 : 1])); ?>"
                                           data-message="<?php echo e($role->status? translate('you_want_to_disable_this_role'): translate('you_want_to_active_this_role')); ?>"
                                           class="toggle-switch-input status-change-alert" id="stocksCheckbox<?php echo e($role->id); ?>"
                                        <?php echo e($role->status ? 'checked' : ''); ?>>
                                    <span class="toggle-switch-label mx-auto text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a href="<?php echo e(route('admin.custom-role.update',[$role['id']])); ?>"
                                        class="action-btn"
                                        title="<?php echo e(translate('Edit')); ?>">
                                        <i class="tio-edit"></i>
                                    </a>
                                    <a class="action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                       data-id="role-<?php echo e($role['id']); ?>"
                                       data-message="<?php echo e(translate('Want to delete this role')); ?>?">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.custom-role.delete',[$role['id']])); ?>"
                                          method="post" id="role-<?php echo e($role['id']); ?>">
                                        <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($adminRoles) === 0): ?>
                    <div class="text-center p-4">
                        <img class="mb-3 width-7rem" src="<?php echo e(asset('public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('image')); ?>">
                        <p class="mb-0"><?php echo e(translate('No data to show')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <?php echo e($adminRoles->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/custom-role.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/custom-role/create.blade.php ENDPATH**/ ?>