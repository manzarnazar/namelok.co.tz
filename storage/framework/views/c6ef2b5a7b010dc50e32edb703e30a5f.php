
<h1 class="page-header-title">
    <span class="page-header-icon">
        <img src="<?php echo e(asset('/public/assets/admin/img/third-party.png')); ?>" class="w--20" alt="">
    </span>
    <span>
        <?php echo e(translate('Third Party')); ?>

    </span>
</h1>
<ul class="nav nav-tabs border-0 mb-3">
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-app/payment-method')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.web-app.payment-method')); ?>">
            <?php echo e(translate('Payment Methods')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-app/third-party/social-media-login')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.web-app.third-party.social-media-login')); ?>">
            <?php echo e(translate('Social Media Login')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-app/mail-config')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.web-app.mail-config')); ?>">
            <?php echo e(translate('Mail Config')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-app/sms-module')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.web-app.sms-module')); ?>">
            <?php echo e(translate('SMS Config')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-app/third-party/map-api-settings')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.web-app.third-party.map-api-settings')); ?>">
            <?php echo e(translate('Google Map APIs')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-app/third-party/recaptcha*')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.web-app.third-party.recaptcha_index')); ?>">
            <?php echo e(translate('Recaptcha')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-app/third-party/chat-index*')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.web-app.third-party.chat-index')); ?>">
            <?php echo e(translate('Social Media Chat')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-app/third-party/firebase-otp-verification*')?'active':''); ?>" href="<?php echo e(route('admin.business-settings.web-app.third-party.firebase-otp-verification')); ?>">
            <?php echo e(translate('Firebase OTP Verification')); ?>

        </a>
    </li>
</ul>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/business-settings/partial/third-party-api-navmenu.blade.php ENDPATH**/ ?>