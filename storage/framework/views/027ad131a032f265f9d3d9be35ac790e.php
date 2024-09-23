<?php $__env->startSection('title', translate('Product List')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid product-list-page">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/products.png')); ?>" class="w--24" alt="">
                </span>
                <span>
                    <?php echo e(translate('product List')); ?>

                    <span class="badge badge-soft-secondary"><?php echo e($products->total()); ?></span>
                </span>
            </h1>
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
                            <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-outline-primary-2 dropdown-toggle min-height-40" href="javascript:;"
                                    data-hs-unfold-options='{
                                            "target": "#usersExportDropdown",
                                            "type": "css-animation"
                                        }'>
                                    <i class="tio-download-to mr-1"></i> <?php echo e(translate('export')); ?>

                                </a>

                                <div id="usersExportDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                    <span class="dropdown-header"><?php echo e(translate('download')); ?>

                                        <?php echo e(translate('options')); ?></span>
                                    <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.product.bulk-export')); ?>">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                            alt="Image Description">
                                        <?php echo e(translate('excel')); ?>

                                    </a>
                                </div>
                            </div>
                            <div>
                                <a href="<?php echo e(route('admin.product.limited-stock')); ?>" class="btn btn--primary-2 min-height-40"><?php echo e(translate('limited stocks')); ?></a>
                            </div>
                            <div>
                                <a href="<?php echo e(route('admin.product.add-new')); ?>" class="btn btn-primary min-height-40 py-2"><i
                                        class="tio-add"></i>
                                    <?php echo e(translate('add new product')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('#')); ?></th>
                                <th><?php echo e(translate('product_name')); ?></th>
                                <th><?php echo e(translate('selling_price')); ?></th>
                                <th class="text-center"><?php echo e(translate('total_sale')); ?></th>
                                <th class="text-center"><?php echo e(translate('show_in_daily_needs')); ?></th>
                                <th class="text-center"><?php echo e(translate('featured')); ?></th>
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
                                    <td class="text-center">
                                        <?php echo e($product->total_sold); ?>

                                    </td>
                                    <td class="pt-1 pb-3  <?php echo e($key == 0 ? 'pt-4' : ''); ?>">
                                        <div class="text-center">
                                            <label class="switch my-0">
                                                <input type="checkbox" class="status" onchange="daily_needs('<?php echo e($product['id']); ?>','<?php echo e($product->daily_needs==1?0:1); ?>')"
                                                    id="<?php echo e($product['id']); ?>" <?php echo e($product->daily_needs == 1?'checked':''); ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="pt-1 pb-3  <?php echo e($key == 0 ? 'pt-4' : ''); ?>">
                                        <label class="toggle-switch my-0">
                                            <input type="checkbox"
                                                   onclick="featured_status_change_alert('<?php echo e(route('admin.product.feature', [$product->id, $product->is_featured ? 0 : 1])); ?>', '<?php echo e($product->is_featured? translate('want to remove from featured product'): translate('want to add in featured product')); ?>', event)"
                                                   class="toggle-switch-input" id="stocksCheckbox<?php echo e($product->id); ?>"
                                                <?php echo e($product->is_featured ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label mx-auto text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td class="pt-1 pb-3  <?php echo e($key == 0 ? 'pt-4' : ''); ?>">
                                        <label class="toggle-switch my-0">
                                            <input type="checkbox"
                                                onclick="status_change_alert('<?php echo e(route('admin.product.status', [$product->id, $product->status ? 0 : 1])); ?>', '<?php echo e($product->status? translate('you want to disable this product'): translate('you want to active this product')); ?>', event)"
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
        function status_change_alert(url, message, e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(translate("Are you sure?")); ?>',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#107980',
                cancelButtonText: '<?php echo e(translate("No")); ?>',
                confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            })
        }
</script>

<script>
    function featured_status_change_alert(url, message, e) {
        e.preventDefault();
        Swal.fire({
            title: '<?php echo e(translate("Are you sure?")); ?>',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#107980',
            cancelButtonText: '<?php echo e(translate("No")); ?>',
            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        })
    }
</script>

    <script>
        function daily_needs(id, status) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.product.daily-needs')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('<?php echo e(translate("Daily need status updated successfully")); ?>');
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/product/list.blade.php ENDPATH**/ ?>