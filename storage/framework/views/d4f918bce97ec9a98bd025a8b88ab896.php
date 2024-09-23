
<div class="col-sm-6 col-lg-3">
    <a class="dashboard--card h-100" href="<?php echo e(route('admin.orders.list',['pending'])); ?>">
        <h6 class="subtitle"><?php echo e(translate('pending')); ?></h6>
        <h2 class="title">
            <?php echo e($data['pending']); ?>

        </h2>
        <img src="<?php echo e(asset('/public/assets/admin/img/dashboard/pending.png')); ?>" alt="" class="dashboard-icon">
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <a class="dashboard--card h-100" href="<?php echo e(route('admin.orders.list',['confirmed'])); ?>">
        <h6 class="subtitle"><?php echo e(translate('confirmed')); ?></h6>
        <h2 class="title">
            <?php echo e($data['confirmed']); ?>

        </h2>
        <img src="<?php echo e(asset('/public/assets/admin/img/dashboard/confirmed.png')); ?>" alt="" class="dashboard-icon">
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <a class="dashboard--card h-100" href="<?php echo e(route('admin.orders.list',['processing'])); ?>">
        <h6 class="subtitle"><?php echo e(translate('packaging')); ?></h6>
        <h2 class="title">
            <?php echo e($data['processing']); ?>

        </h2>
        <img src="<?php echo e(asset('/public/assets/admin/img/dashboard/packaging.png')); ?>" alt="" class="dashboard-icon">
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <a class="dashboard--card h-100" href="<?php echo e(route('admin.orders.list',['out_for_delivery'])); ?>">
        <h6 class="subtitle"><?php echo e(translate('out_for_delivery')); ?></h6>
        <h2 class="title">
            <?php echo e($data['out_for_delivery']); ?>

        </h2>
        <img src="<?php echo e(asset('/public/assets/admin/img/dashboard/out-for-delivery.png')); ?>" alt="" class="dashboard-icon">
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <a class="order--card h-100" href="<?php echo e(route('admin.orders.list',['delivered'])); ?>">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                <img src="<?php echo e(asset('public/assets/admin/img/delivery/1.png')); ?>" alt="dashboard" class="oder--card-icon">
                <span><?php echo e(translate('delivered')); ?></span>
            </h6>
            <span class="card-title text-success">
                <?php echo e($data['delivered']); ?>

            </span>
        </div>
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <a class="order--card h-100" href="<?php echo e(route('admin.orders.list',['canceled'])); ?>">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                <img src="<?php echo e(asset('public/assets/admin/img/delivery/2.png')); ?>" alt="<?php echo e(translate('dashboard')); ?>" class="oder--card-icon">
                <span><?php echo e(translate('Canceled')); ?></span>
            </h6>
            <span class="card-title text-danger">
                <?php echo e($data['canceled']); ?>

            </span>
        </div>
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <a class="order--card h-100" href="<?php echo e(route('admin.orders.list',['returned'])); ?>">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                <img src="<?php echo e(asset('public/assets/admin/img/delivery/3.png')); ?>" alt="<?php echo e(translate('dashboard')); ?>" class="oder--card-icon">
                <span><?php echo e(translate('returned')); ?></span>
            </h6>
            <span class="card-title text-warning">
                <?php echo e($data['returned']); ?>

            </span>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-3">
    <a class="order--card h-100" href="<?php echo e(route('admin.orders.list',['failed'])); ?>">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                <img src="<?php echo e(asset('public/assets/admin/img/delivery/4.png')); ?>" alt="<?php echo e(translate('dashboard')); ?>" class="oder--card-icon">
                <span><?php echo e(translate('Failed to Delivered')); ?></span>
            </h6>
            <span class="card-title text-danger">
                <?php echo e($data['failed']); ?>

            </span>
        </div>
    </a>
</div>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/partials/_dashboard-order-stats.blade.php ENDPATH**/ ?>