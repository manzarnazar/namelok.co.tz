<?php $__env->startSection('title', translate('flash_sale_product')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/flash_sale.png')); ?>" class="w--20" alt="">
                </span>
                <span>
                    <?php echo e(translate('flash deal product')); ?>

                </span>
            </h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 text-capitalize"><?php echo e($flashDeal['title']); ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.offer.flash.add-product',[$flashDeal['id']])); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name" class="title-color text-capitalize"><?php echo e(translate('Add new product')); ?></label>
                                        <select class="js-example-basic-multiple js-states js-example-responsive form-control h--45px" name="product_id">
                                            <option disabled selected><?php echo e(translate('Select Product')); ?></option>
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product->id); ?>">
                                                    <?php echo e($product['name']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="btn--container justify-content-end">
                                    <button type="submit" class="btn btn--primary"><?php echo e(translate('submit')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <h5 class="mb-0 text-capitalize">
                            <?php echo e(translate('Product')); ?> <?php echo e(translate('Table')); ?>

                            <span class="badge badge-soft-dark radius-50 fz-12 ml-1"><?php echo e($flashDealProducts->total()); ?></span>
                        </h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100" cellspacing="0">
                            <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th><?php echo e(translate('SL')); ?></th>
                                <th><?php echo e(translate('name')); ?></th>
                                <th><?php echo e(translate('actual_price')); ?></th>
                                <th><?php echo e(translate('discount')); ?></th>
                                <th><?php echo e(translate('discount_price')); ?></th>
                                <th class="text-center"><?php echo e(translate('action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $flashDealProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$flashProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php ($discount = Helpers::discount_calculate($flashProduct, $flashProduct['price'])); ?>
                                <tr>
                                    <td><?php echo e($flashDealProducts->firstitem()+$k); ?></td>
                                    <td class="pt-1 pb-3  <?php echo e($k == 0 ? 'pt-4' : ''); ?>">
                                        <a href="<?php echo e(route('admin.product.view',[$flashProduct['id']])); ?>" target="_blank" class="product-list-media">
                                            <?php if(!empty(json_decode($flashProduct['image'],true))): ?>
                                                <img src="<?php echo e($flashProduct->identityImageFullPath[0]); ?>"
                                                    alt="<?php echo e(translate('product')); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('public/assets/admin/img/400x400/img2.jpg')); ?>">
                                            <?php endif; ?>
                                            <h6 class="name line--limit-2">
                                                <?php echo e(\Illuminate\Support\Str::limit($flashProduct['name'], 20, $end='...')); ?>

                                            </h6>
                                        </a>
                                    </td>
                                    <td><?php echo e(Helpers::set_symbol($flashProduct['price'])); ?></td>
                                    <td><?php echo e(Helpers::set_symbol($discount)); ?></td>
                                    <td><?php echo e(Helpers::set_symbol($flashProduct['price'] - $discount)); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a  title="<?php echo e(trans ('Delete')); ?>"
                                                class="btn btn-outline-danger btn-sm delete"
                                                id="<?php echo e($flashProduct['id']); ?>">
                                                <i class="tio-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <table>
                            <tfoot>
                            <?php echo $flashDealProducts->links(); ?>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

    <script>
        "use strict";

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });

        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            var flash_deal_id = <?php echo e($flashDeal->id); ?>

            Swal.fire({
                title: "<?php echo e(translate('Are_you_sure_remove_this_product')); ?>?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo e(translate('Yes')); ?>, <?php echo e(translate('delete_it')); ?>!',
                type: 'warning',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                        }
                    });
                    $.ajax({
                        url: "<?php echo e(route('admin.offer.flash.delete.product')); ?>",
                        method: 'POST',
                        data: {
                                id: id,
                                flash_deal_id : flash_deal_id
                            },
                        success: function (data) {
                            toastr.success('<?php echo e(translate('product_removed_successfully')); ?>');
                            location.reload();
                        },
                    });
                }
            })
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/offer/add-product-index.blade.php ENDPATH**/ ?>