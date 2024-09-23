
<div class="page-header">
    <h1 class="page-header-title">
        <span class="page-header-icon">
            <img src="<?php echo e(asset('public/assets/admin/img/business-setup.png')); ?>" class="w--22" alt="">
        </span>
        <span><?php echo e(translate('Business  Setup')); ?></span>
    </h1>
    <ul class="nav nav-tabs border-0 mb-3">
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/ecom-setup')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.ecom-setup')); ?>">
                <?php echo e(translate('Business Settings')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/main-branch-setup')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.main-branch-setup')); ?>">
                <?php echo e(translate('Main Branch Setup')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/timeSlot*')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.timeSlot.add-new')); ?>">
                <?php echo e(translate('Delivery Time Slot')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/delivery-setup')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.delivery-setup')); ?>">
                <?php echo e(translate('Delivery Fee Setup')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/product-setup')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.product-setup')); ?>">
                <?php echo e(translate('Product Setup')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/cookies-setup')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.cookies-setup')); ?>">
                <?php echo e(translate('Cookies Setup')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/otp-setup')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.otp-setup')); ?>">
                <?php echo e(translate('OTP and Login Setup')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/customer-setup')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.customer-setup')); ?>">
                <?php echo e(translate('customers')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/store/order-setup')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.store.order-setup')); ?>">
                <?php echo e(translate('orders')); ?>

            </a>
        </li>
    </ul>
</div>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/business-settings/partial/business-settings-navmenu.blade.php ENDPATH**/ ?>