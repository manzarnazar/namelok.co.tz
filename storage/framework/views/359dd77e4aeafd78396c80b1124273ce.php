<?php $__env->startSection('title', translate('flash_sale')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/flash_sale.png')); ?>" class="w--20" alt="">
                </span>
                <span>
                    <?php echo e(translate('flash sale')); ?>

                </span>
            </h1>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <form action="<?php echo e(route('admin.offer.flash.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('title')); ?></label>
                                        <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control" placeholder="<?php echo e(translate('enter title')); ?>" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                        <label for="name" class="title-color font-weight-medium text-capitalize"><?php echo e(translate('start_date')); ?></label>
                                        <input type="date" name="start_date" required id="start_date"
                                               class="js-flatpickr form-control flatpickr-custom" placeholder="<?php echo e(translate('dd/mm/yy')); ?>" data-hs-flatpickr-options='{ "dateFormat": "Y/m/d", "minDate": "today" }'>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                        <label for="name" class="title-color font-weight-medium text-capitalize"><?php echo e(translate('end_date')); ?></label>
                                        <input type="date" name="end_date" required id="end_date"
                                               class="js-flatpickr form-control flatpickr-custom" placeholder="<?php echo e(translate('dd/mm/yy')); ?>" data-hs-flatpickr-options='{ "dateFormat": "Y/m/d", "minDate": "today" }'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column justify-content-center h-100">
                                <h5 class="text-center mb-3 text--title text-capitalize">
                                    <?php echo e(translate('image')); ?>

                                    <small class="text-danger">* ( <?php echo e(translate('ratio')); ?> 3:1 )</small>
                                </h5>
                                <label class="upload--vertical">
                                    <input type="file" name="image" id="customFileEg1" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" hidden>
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
                    <h5 class="card-title"><?php echo e(translate('Flash Sale List')); ?> <span class="badge badge-soft-secondary"><?php echo e($flashDeals->total()); ?></span></h5>
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control"
                                   placeholder="<?php echo e(translate('Search_by_flash_sale_title')); ?>" aria-label="Search"
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
                        <th class="border-0"><?php echo e(translate('image')); ?></th>
                        <th class="border-0"><?php echo e(translate('title')); ?></th>
                        <th class="border-0"><?php echo e(translate('duration')); ?></th>
                        <th class="border-0"><?php echo e(translate('status')); ?></th>
                        <th class="border-0"><?php echo e(translate('is_publish')); ?>?</th>
                        <th class="text-center border-0"><?php echo e(translate('active_products')); ?></th>
                        <th class="text-center border-0"><?php echo e(translate('action')); ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $flashDeals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$flash_deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td>
                                <div>
                                    <img class="img-vertical-150" src="<?php echo e($flash_deal->imageFullPath); ?>">
                                </div>
                            </td>
                            <td>
                                <span class="d-block font-size-sm text-body text-trim-25">
                                    <?php echo e($flash_deal['title']); ?>

                                </span>
                            </td>
                            <td><?php echo e(date('d-M-y',strtotime($flash_deal['start_date']))); ?> - <?php echo e(date('d-M-y',strtotime($flash_deal['end_date']))); ?></td>
                            <td>
                                <?php if(\Carbon\Carbon::parse($flash_deal['end_date'])->endOfDay()->isPast()): ?>
                                    <span class="badge badge-soft-danger"><?php echo e(translate('expired')); ?> </span>
                                <?php else: ?>
                                    <span class="badge badge-soft-success"> <?php echo e(translate('active')); ?> </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <label class="toggle-switch my-0">
                                    <input type="checkbox"class="toggle-switch-input status-change-alert" id="stocksCheckbox<?php echo e($flash_deal->id); ?>"
                                           data-route="<?php echo e(route('admin.offer.flash.status', [$flash_deal->id, $flash_deal->status ? 0 : 1])); ?>"
                                           data-message="<?php echo e($flash_deal->status? translate('you_want_to_disable_this_deal'): translate('you_want_to_active_this_deal')); ?>"
                                        <?php echo e($flash_deal->status ? 'checked' : ''); ?>>
                                    <span class="toggle-switch-label mx-auto text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td class="text-center"><?php echo e($flash_deal->products_count); ?></td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="h-30 d-flex gap-2 align-items-center btn btn-soft-info btn-sm border-info" href="<?php echo e(route('admin.offer.flash.add-product',[$flash_deal['id']])); ?>">
                                        <img src="<?php echo e(asset('/public/assets/back-end/img/plus.svg')); ?>" class="svg" alt="">
                                        <?php echo e(translate('Add Product')); ?>

                                    </a>
                                    <a class="action-btn"
                                       href="<?php echo e(route('admin.offer.flash.edit',[$flash_deal['id']])); ?>">
                                        <i class="tio-edit"></i></a>
                                    <a class="action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                       data-id="deal-<?php echo e($flash_deal['id']); ?>"
                                       data-message="<?php echo e(translate('Want to delete this')); ?>?">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                </div>
                                <form action="<?php echo e(route('admin.offer.flash.delete',[$flash_deal['id']])); ?>"
                                      method="post" id="deal-<?php echo e($flash_deal['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <table>
                    <tfoot>
                    <?php echo $flashDeals->links(); ?>

                    </tfoot>
                </table>

            </div>
            <?php if(count($flashDeals) == 0): ?>
                <div class="text-center p-4">
                    <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                    <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/flatpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/admin/js/upload-single-image.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/offer/flash-deal-index.blade.php ENDPATH**/ ?>