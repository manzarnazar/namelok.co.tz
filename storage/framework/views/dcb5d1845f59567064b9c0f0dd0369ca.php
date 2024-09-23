<div class="product-card card quick-view-trigger" data-product-id="<?php echo e($product->id); ?>">
    <?php
        $category_id = null;
        foreach (json_decode($product['category_ids'], true) as $cat) {
            if ($cat['position'] == 1){
                $category_id = ($cat['id']);
            }
        }

        $category_discount = \App\CentralLogics\Helpers::category_discount_calculate($category_id, $product['price']);
        $product_discount = \App\CentralLogics\Helpers::discount_calculate($product, $product['price']);

        if ($category_discount >= $product['price']){
            $discount = $product_discount;
        }else{
            $discount = max($category_discount, $product_discount);
        }
    ?>

    <div class="card-header inline_product clickable p-0">
        <?php if(!empty(json_decode($product['image'],true))): ?>
            <img src="<?php echo e($product->identityImageFullPath[0]); ?>" class="w-100 h-100 object-cover aspect-ratio-80">
        <?php else: ?>
            <img
            src="<?php echo e(asset('public/assets/admin/img/160x160/2.png')); ?>"
                class="w-100 h-100 object-cover aspect-ratio-80"
            >
        <?php endif; ?>
    </div>

    <div class="card-body inline_product text-center p-1 clickable">
        <div class="product-title1 text-dark font-weight-bold">
            <?php echo e(Str::limit($product['name'], 12)); ?>

        </div>
        <div class="justify-content-between text-center">
            <div class="product-price text-center">
                <?php echo e(Helpers::set_symbol($product['price'] - $discount)); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/pos/_single_product.blade.php ENDPATH**/ ?>