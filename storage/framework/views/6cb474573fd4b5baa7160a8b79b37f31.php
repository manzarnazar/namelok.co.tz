<?php $__env->startSection('title', translate('Subscribed List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/employee.png')); ?>" class="w--20" alt="<?php echo e(translate('employee')); ?>">
                </span>
                <span>
                    <?php echo e(translate('Subscribed Customers')); ?> <span class="badge badge-soft-primary ml-2 badge-pill"><?php echo e($newsletters->total()); ?></span>
                </span>
            </h1>
        </div>

        <div class="card">
            <div class="card-header flex-end">
                <div class="card--header">
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group">
                            <input id="datatableSearch_" type="search" name="search"
                                   class="form-control"
                                   placeholder="<?php echo e(translate('Ex : Search Emails Address')); ?>" aria-label="Search"
                                   value="<?php echo e($search); ?>" required autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text">
                                    <?php echo e(translate('search')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                    <thead class="thead-light">
                    <tr>
                        <th><?php echo e(translate('#')); ?></th>
                        <th><?php echo e(translate('email')); ?></th>
                        <th><?php echo e(translate('subscribed_at')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    <?php $__currentLoopData = $newsletters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$newsletter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr >
                            <td>
                                <?php echo e($newsletters->firstitem()+$key); ?>

                            </td>
                            <td>
                                <a href="mailto:<?php echo e($newsletter['email']); ?>?subject=<?php echo e(translate('Mail from '). Helpers::get_business_settings('restaurant_name')); ?>"><?php echo e($newsletter['email']); ?></a>
                            </td>
                            <td><?php echo e(date('Y/m/d '.config('timeformat'), strtotime($newsletter->created_at))); ?></td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <?php echo $newsletters->links(); ?>

                    </div>
                </div>
            </div>
            <?php if(count($newsletters) == 0): ?>
                <div class="text-center p-4">
                    <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('image')); ?>">
                    <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/customer/subscribed-list.blade.php ENDPATH**/ ?>