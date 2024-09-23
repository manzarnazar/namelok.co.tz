<?php $__env->startSection('title', translate('Limited Stocks')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid product-list-page">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/products.png')); ?>" class="w--24" alt="">
                </span>
                <span>
                    <?php echo e(translate('Limited Stocks')); ?>

                    <span class="badge badge-soft-secondary"><?php echo e($products->total()); ?></span>
                </span>
            </h1>
            <p class="d-flex"><?php echo e(translate('the_products_are_shown_in_this_list,_which_quantity_is_below')); ?> <?php echo e($stockLimit); ?></p>
        </div>
        <!-- End Page Header -->

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header border-0">
                        <div class="card--header justify-content-end max--sm-grow">
                            <form action="<?php echo e(url()->current()); ?>" method="GET" class="mr-sm-auto">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search"
                                           class="form-control"
                                           placeholder="<?php echo e(translate('Search_by_ID_or_name')); ?>" aria-label="Search"
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
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('#')); ?></th>
                                <th><?php echo e(translate('product_name')); ?></th>
                                <th><?php echo e(translate('selling_price')); ?></th>
                                <th class=""><?php echo e(translate('quantity')); ?></th>
                                <th class="text-center"><?php echo e(translate('status')); ?></th>
                                <th class="text-center"><?php echo e(translate('action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="pt-1 pb-3  <?php echo e($key == 0 ? 'pt-4' : ''); ?>"><?php echo e($products->firstItem()+$key); ?></td>
                                    <td class="pt-1 pb-3  <?php echo e($key == 0 ? 'pt-4' : ''); ?>">
                                        <a href="<?php echo e(route('admin.product.view',[$product['id']])); ?>" class="product-list-media">
                                            <?php if(!empty(json_decode($product['image'],true))): ?>
                                                <img src="<?php echo e($product->identityImageFullPath[0]); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('public/assets/admin/img/400x400/img2.jpg')); ?>">
                                            <?php endif; ?>
                                            <h6 class="name line--limit-2">
                                                <?php echo e(\Illuminate\Support\Str::limit($product['name'], 20, $end='...')); ?>

                                            </h6>
                                        </a>
                                    </td>
                                    <td class="pt-1 pb-3  <?php echo e($key == 0 ? 'pt-4' : ''); ?>">
                                        <div class="max-85 text-right">
                                            <?php echo e(Helpers::set_symbol($product['price'])); ?>

                                        </div>
                                    </td>
                                    <td class="pt-1 pb-3">
                                        <div class="d-flex align-items-center product-quantity">
                                            <?php echo e($product->total_stock); ?>


                                            <button class="btn py-0 px-2 fz-18" id="<?php echo e($product->id); ?>"
                                                    onclick="update_quantity(<?php echo e($product->id); ?>)" type="button"
                                                    data-toggle="modal" data-target="#update-quantity"
                                                    title="<?php echo e(translate('update_quantity')); ?>">
                                                <i class="tio-add-circle c1"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="pt-1 pb-3  <?php echo e($key == 0 ? 'pt-4' : ''); ?>">
                                        <label class="toggle-switch my-0">
                                            <input type="checkbox"
                                                   onclick="status_change_alert('<?php echo e(route('admin.product.status', [$product->id, $product->status ? 0 : 1])); ?>', '<?php echo e($product->status? translate('you_want_to_disable_this_product'): translate('you_want_to_active_this_product')); ?>', event)"
                                                   class="toggle-switch-input" id="stocksCheckbox<?php echo e($product->id); ?>"
                                                <?php echo e($product->status ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label mx-auto text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td class="pt-1 pb-3  <?php echo e($key == 0 ? 'pt-4' : ''); ?>">
                                        <!-- Dropdown -->
                                        <div class="btn--container justify-content-center">
                                            <a class="action-btn"
                                               href="<?php echo e(route('admin.product.edit',[$product['id']])); ?>">
                                                <i class="tio-edit"></i></a>
                                            <a class="action-btn btn--danger btn-outline-danger" href="javascript:"
                                               onclick="form_alert('product-<?php echo e($product['id']); ?>','<?php echo e(translate("Want to delete this")); ?>')">
                                                <i class="tio-delete-outlined"></i>
                                            </a>
                                        </div>
                                        <form action="<?php echo e(route('admin.product.delete',[$product['id']])); ?>"
                                              method="post" id="product-<?php echo e($product['id']); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                        </form>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <div class="page-area">
                            <table>
                                <tfoot class="border-top">
                                <?php echo $products->links(); ?>

                                </tfoot>
                            </table>
                        </div>
                        <?php if(count($products)==0): ?>
                            <div class="text-center p-4">
                                <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="Image Description">
                                <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="update-quantity" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.product.update-quantity')); ?>" method="post">
                    <div class="modal-body p-0">
                        <?php echo csrf_field(); ?>
                        <div class="rest-part"></div>
                        <div class="card-body pt-0">
                            <div class="btn--container justify-content-end">
                                <button type="button" class="btn btn--danger text-white" data-dismiss="modal" aria-label="Close">
                                    <?php echo e(translate('close')); ?>

                                </button>
                                <button class="btn btn--primary" type="submit"><?php echo e(translate('submit')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    function update_quantity(val) {
        $.get({
            url: '<?php echo e(url('/')); ?>/admin/product/get-variations?id='+val,
            dataType: 'json',
            success: function (data) {
                console.log(data)
                $('.rest-part').empty().html(data.view);
            },
        });
    }

    function update_qty() {
        var total_qty = 0;
        var qty_elements = $('input[name^="qty_"]');
        console.log(qty_elements);
        for (var i = 0; i < qty_elements.length; i++) {
            total_qty += parseInt(qty_elements.eq(i).val());
        }
        if (qty_elements.length > 0) {

            $('input[name="total_stock"]').attr("readonly", true);
            $('input[name="total_stock"]').val(total_qty);
        } else {
            $('input[name="total_stock"]').attr("readonly", false);
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/product/limited-stock.blade.php ENDPATH**/ ?>