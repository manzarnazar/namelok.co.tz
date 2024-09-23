<?php $__env->startSection('title', translate('Add new banner')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/banner.png')); ?>" class="w--20" alt="<?php echo e(translate('banner')); ?>">
                </span>
                <span>
                    <?php echo e(translate('banner setup')); ?>

                </span>
            </h1>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="<?php echo e(route('admin.banner.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('title')); ?></label>
                                        <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control" placeholder="<?php echo e(translate('New banner')); ?>" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('item')); ?> <?php echo e(translate('type')); ?><span
                                                class="input-label-secondary">*</span></label>
                                        <select name="item_type" class="form-control show-item">
                                            <option value="product"><?php echo e(translate('product')); ?></option>
                                            <option value="category"><?php echo e(translate('category')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0" id="type-product">
                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('product')); ?> <span
                                                class="input-label-secondary">*</span></label>
                                        <select name="product_id" class="form-control js-select2-custom">
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product['id']); ?>"><?php echo e($product['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-0" id="type-category d-none">
                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('category')); ?> <span
                                                class="input-label-secondary">*</span></label>
                                        <select name="category_id" class="form-control js-select2-custom">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column justify-content-center h-100">
                                <h5 class="text-center mb-3 text--title text-capitalize">
                                    <?php echo e(translate('banner')); ?> <?php echo e(translate('image')); ?>

                                    <small class="text-danger">* ( <?php echo e(translate('ratio')); ?> 2:1 )</small>
                                </h5>
                                <label class="upload--vertical">
                                    <input type="file" name="image" id="customFileEg1" class="" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" hidden>
                                    <img id="viewer" src="<?php echo e(asset('public/assets/admin/img/upload-vertical.png')); ?>" alt="<?php echo e(translate('banner image')); ?>"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn--container justify-content-end">
                                <button type="reset" class="btn btn--reset"><?php echo e(translate('reset')); ?></button>
                                <button type="submit" class="btn btn--primary"><?php echo e(translate('submit')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-0">
                <div class="card--header justify-content-between max--sm-grow">
                    <h5 class="card-title"><?php echo e(translate('Banner List')); ?> <span class="badge badge-soft-secondary"><?php echo e($banners->total()); ?></span></h5>
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control"
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
                        <th class="border-0"><?php echo e(translate('#')); ?></th>
                        <th class="border-0"><?php echo e(translate('banner image')); ?></th>
                        <th class="border-0"><?php echo e(translate('title')); ?></th>
                        <th class="border-0"><?php echo e(translate('banner type')); ?></th>
                        <th class="text-center border-0"><?php echo e(translate('status')); ?></th>
                        <th class="text-center border-0"><?php echo e(translate('action')); ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td>
                                <div>
                                    <img class="img-vertical-150"
                                         src="<?php echo e($banner->imageFullPath); ?>"
                                         alt="<?php echo e(translate('banner image')); ?>"
                                    >
                                </div>
                            </td>
                            <td>
                                <span class="d-block font-size-sm text-body text-trim-25">
                                    <?php echo e($banner['title']); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($banner['product_id']): ?>
                                    <?php echo e(translate('Product')); ?> : <?php echo e($banner->product?$banner->product->name:''); ?>

                                <?php elseif($banner['category_id']): ?>
                                    <?php echo e(translate('Category')); ?> : <?php echo e($banner->category?$banner->category->name:''); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <label class="toggle-switch my-0">
                                    <input type="checkbox"
                                           class="toggle-switch-input status-change-alert" id="stocksCheckbox<?php echo e($banner->id); ?>"
                                           data-route="<?php echo e(route('admin.banner.status', [$banner->id, $banner->status ? 0 : 1])); ?>"
                                           data-message="<?php echo e($banner->status? translate('you_want_to_disable_this_banner'): translate('you_want_to_active_this_banner')); ?>"
                                        <?php echo e($banner->status ? 'checked' : ''); ?>>
                                    <span class="toggle-switch-label mx-auto text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="action-btn"
                                       href="<?php echo e(route('admin.banner.edit',[$banner['id']])); ?>">
                                        <i class="tio-edit"></i></a>
                                    <a class="action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                       data-id="banner-<?php echo e($banner['id']); ?>"
                                       data-message="<?php echo e(translate("Want to delete this")); ?>">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                </div>
                                <form action="<?php echo e(route('admin.banner.delete',[$banner['id']])); ?>"
                                      method="post" id="banner-<?php echo e($banner['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <table>
                    <tfoot>
                    <?php echo $banners->links(); ?>

                    </tfoot>
                </table>

            </div>
            <?php if(count($banners) == 0): ?>
                <div class="text-center p-4">
                    <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('image')); ?>">
                    <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/banner.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/banner/index.blade.php ENDPATH**/ ?>