<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Error 404 | GroFresh</title>

    <link rel="shortcut icon" href="favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/vendor.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/vendor/icon-set/style.css">

    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/theme.minc619.css?v=1.0">
</head>

<body>

<div class="container">
    <div class="footer-height-offset d-flex justify-content-center align-items-center flex-column">
        <div class="row align-items-sm-center w-100">
            <div class="col-sm-6">
                <div class="text-center text-sm-right mr-sm-4 mb-5 mb-sm-0">
                    <img class="w-60 w-sm-100 mx-auto"
                         src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/think.svg" alt="Image Description"
                         style="max-width: 15rem;">
                </div>
            </div>

            <div class="col-sm-6 col-md-4 text-center text-sm-left">
                <h1 class="display-1 mb-0">404</h1>
                <p class="lead">Sorry, the page you're looking for cannot be found.</p>
                <?php if(auth('branch')->check()): ?>
                    <a class="btn btn-primary" href="<?php echo e(route('branch.dashboard')); ?>">Dashboard</a>
                <?php else: ?>
                    <a class="btn btn-primary" href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="footer text-center">
    <ul class="list-inline list-separator">
        <li class="list-inline-item">
            <a class="list-separator-link" target="_blank" href="https://6amtech.com/">groFresh Support</a>
        </li>
    </ul>
</div>


<script src="<?php echo e(asset('public/assets/admin')); ?>/js/theme.min.js"></script>
</body>

</html>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/errors/404.blade.php ENDPATH**/ ?>