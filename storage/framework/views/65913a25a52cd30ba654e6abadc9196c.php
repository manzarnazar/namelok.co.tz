<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e(translate('Admin')); ?> | <?php echo e(translate('Login')); ?></title>

    <?php ($icon = Helpers::get_business_settings('fav_icon')); ?>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('storage/app/public/restaurant/' . $icon ?? '')); ?>">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/vendor.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/vendor/icon-set/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/theme.minc619.css?v=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/toastr.css')); ?>">
</head>

<body>
<main id="content" role="main" class="main">
    <div class="auth-wrapper">
        <div class="auth-wrapper-left">
            <div class="auth-left-cont">
                <img src="<?php echo e($logo); ?>" alt="<?php echo e(translate('logo')); ?>">
<!--                <h2 class="title"><?php echo e(translate('Your')); ?> <span class="d-block"><?php echo e(translate('All Fresh Food')); ?></span> <strong class="text--039D55"><?php echo e(translate('in one Place')); ?>....</strong></h2>
-->
            </div>
        </div>
        <div class="auth-wrapper-right">
            <div class="auth-wrapper-form">
                <form id="form-id" action="<?php echo e(route('admin.auth.login')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="auth-header">
                        <div class="mb-5">
                            <div class="auth-wrapper-right-logo">
                                <img src="<?php echo e($logo); ?>" alt="<?php echo e(translate('logo')); ?>">
                            </div>
                            <h2 class="title"><?php echo e(translate('sign in')); ?></h2>
                            <div><?php echo e(translate('welcome_back')); ?></div>
<!--                            <p class="mb-0"><?php echo e(translate('Want to login your branches')); ?>?
                                <a href="<?php echo e(route('branch.auth.login')); ?>">
                                    <?php echo e(translate('branch')); ?> <?php echo e(translate('login')); ?>

                                </a>
                            </p>
                            <span class="badge badge-soft-info mt-2">( <?php echo e(translate('admin_or_employee_signin')); ?> )</span>
-->
                        </div>
                    </div>

                    <div class="js-form-message form-group">
                        <label class="input-label text-capitalize"
                            for="signinSrEmail"><?php echo e(translate('your email')); ?></label>

                        <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail"
                            tabindex="1" placeholder="<?php echo e(translate('email@address.com')); ?>" aria-label="email@address.com"
                            required data-msg="Please enter a valid email address.">
                    </div>

                    <div class="js-form-message form-group">
                        <label class="input-label" for="signupSrPassword" tabindex="0">
                            <span class="d-flex justify-content-between align-items-center">
                            <?php echo e(translate('password')); ?>

                            </span>
                        </label>

                        <div class="input-group input-group-merge">
                            <input type="password" class="js-toggle-password form-control form-control-lg"
                                name="password" id="signupSrPassword" placeholder="<?php echo e(translate('8+ characters required')); ?>"
                                aria-label="8+ characters required" required
                                data-msg="Your password is invalid. Please try again."
                                data-hs-toggle-password-options='{
                                            "target": "#changePassTarget",
                                    "defaultClass": "tio-hidden-outlined",
                                    "showClass": "tio-visible-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                    }'>
                            <div id="changePassTarget" class="input-group-append">
                                <a class="input-group-text" href="javascript:">
                                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox d-flex align-items-center">
                            <input type="checkbox" class="custom-control-input" id="termsCheckbox"
                                name="remember">
                            <label class="custom-control-label text-muted m-0" for="termsCheckbox">
                                <?php echo e(translate('remember')); ?> <?php echo e(translate('me')); ?>

                            </label>
                        </div>
                    </div>

                    <?php ($recaptcha = Helpers::get_business_settings('recaptcha')); ?>
                    <?php if(isset($recaptcha) && $recaptcha['status'] == 1): ?>
                        <div id="recaptcha_element" class="w-100" data-type="image"></div>
                        <br/>
                    <?php else: ?>
                        <div class="row pt-2 pb-2 align-items-center">
                            <div class="col-6 pr-0">
                                <input type="text" class="form-control form-control-lg" name="default_captcha_value" value=""
                                    placeholder="<?php echo e(translate('Enter captcha value')); ?>" autocomplete="off">
                            </div>
                            <div class="col-6 input-icons bg-white rounded">
                                <div class="d-flex align-items-center refresh-recaptcha">
                                    <img src="<?php echo e(URL('/admin/auth/code/captcha/1')); ?>" class="rounded" id="default_recaptcha_id">
                                    <i class="tio-refresh icon"></i>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-block btn--primary"><?php echo e(translate('login')); ?></button>
                </form>
                <?php if(env('APP_MODE')=='demo'): ?>
                <div class="auto-fill-data-copy">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <span class="d-block"><strong>Email</strong> : admin@admin.com</span>
                            <span class="d-block"><strong>Password</strong> : 12345678</span>
                        </div>
                        <div>
                            <button class="btn action-btn btn--primary m-0" id="copyButton"><i class="tio-copy"></i></button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<script src="<?php echo e(asset('public/assets/admin')); ?>/js/vendor.min.js"></script>

<script src="<?php echo e(asset('public/assets/admin')); ?>/js/theme.min.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/toastr.js"></script>
<?php echo Toastr::message(); ?>


<?php if($errors->any()): ?>
    <script>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.error('<?php echo e($error); ?>', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>


<script>
    $(document).on('ready', function () {
        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });

        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });

    $.getJSON('https://api.ipify.org?format=json', function(data) {
        var ipAddress = data.ip;
        console.log('User IP address: ' + ipAddress);
        console.log(data);
    });
</script>

<?php if(isset($recaptcha) && $recaptcha['status'] == 1): ?>
    <script type="text/javascript">
        var onloadCallback = function () {
            grecaptcha.render('recaptcha_element', {
                'sitekey': '<?php echo e(Helpers::get_business_settings('recaptcha')['site_key']); ?>'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        $("#form-id").on('submit',function(e) {
            var response = grecaptcha.getResponse();

            if (response.length === 0) {
                e.preventDefault();
                toastr.error("<?php echo e(translate('Please check the recaptcha')); ?>");
            }
        });
    </script>
<?php else: ?>
    <script type="text/javascript">
        $('.refresh-recaptcha').on('click', function() {
            reCaptcha();
        });
        function reCaptcha() {
            var $url = "<?php echo e(URL('/admin/auth/code/captcha')); ?>";
            var $url = $url + "/" + Math.random();
            document.getElementById('default_recaptcha_id').src = $url;
        }
    </script>
<?php endif; ?>

<?php if(env('APP_MODE')=='demo'): ?>
    <script>
        $('#copyButton').on('click', function() {
            copyCredentials();
        });

        function copyCredentials() {
            $('#signinSrEmail').val('admin@admin.com');
            $('#signupSrPassword').val('12345678');
            toastr.success('Copied successfully!', 'Success!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
<?php endif; ?>
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/auth/login.blade.php ENDPATH**/ ?>