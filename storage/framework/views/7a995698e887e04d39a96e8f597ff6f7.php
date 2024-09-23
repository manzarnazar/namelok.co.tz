<div class="card-header border-0 order-header-shadow">
    <h5 class="card-title d-flex justify-content-between flex-grow-1">
        <span><?php echo e(translate('most_rated_products')); ?></span>
        <a href="<?php echo e(route('admin.reviews.list')); ?>" class="fz-12px font-medium text-006AE5"><?php echo e(translate('view_all')); ?></a>
    </h5>
</div>

<div class="card-body">
    <div class="rated--products">
        <?php $__currentLoopData = $most_rated_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php ($product=\App\Model\Product::find($item['product_id'])); ?>
            <?php if(isset($product)): ?>
                <a href="<?php echo e(route('admin.product.view',[$item['product_id']])); ?>">
                    <div class="rated-media d-flex align-items-center">
                        <img src="<?php echo e(($product->identityImageFullPath[0])); ?>" alt="<?php echo e($product->name); ?> image">
                        <span class="line--limit-1 w-0 flex-grow-1">
                            <?php echo e(isset($product)?substr($product->name,0,30) . (strlen($product->name)>20?'...':''):'not exists'); ?>

                        </span>
                    </div>
                    <div class="">
                        <span class="rating text-info"><i class="tio-star"></i></span>
                        <span><?php echo e($avg_rating = count($product->rating)>0?number_format($product->rating[0]->average, 2, '.', ' '):0); ?> </span>
                        (<?php echo e($item['total']); ?>)
                    </div>
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/partials/_most-rated-products.blade.php ENDPATH**/ ?>