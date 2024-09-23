<?php $__env->startSection('title', translate('Review List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/review.png')); ?>" class="w--24" alt="">
                </span>
                <span>
                    <?php echo e(translate('product reviews')); ?> <span class="badge badge-pill badge-soft-secondary"><?php echo e($reviews->total()); ?></span>
                </span>
            </h1>
        </div>

        <div class="card">
            <div class="card-header  border-0">
                <div class="card--header justify-content-end">
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group">
                            <input id="datatableSearch_" type="search" name="search"
                                    class="form-control"
                                    placeholder="<?php echo e(translate('Ex : Search by ID or name')); ?>" aria-label="Search"
                                    value="<?php echo e($search); ?>" required autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text">
                                    <?php echo e(translate('Search')); ?>

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
                        <th><?php echo e(translate('product name')); ?></th>
                        <th><?php echo e(translate('ratings')); ?></th>
                        <th><?php echo e(translate('customer info')); ?></th>
                        <th><?php echo e(translate('status')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($reviews->firstItem()+$key); ?></td>
                            <td>
                                <span class="d-block font-size-sm text-body">
                                    <?php if($review->product): ?>
                                        <?php if(!empty(json_decode($review->product['image'],true))): ?>
                                        <a href="<?php echo e(route('admin.product.view',[$review['product_id']])); ?>" class="short-media">
                                            <img
                                                 src="<?php echo e($review->product->identityImageFullPath[0]); ?>">
                                            <div class="text-cont line--limit-2 max-150px">
                                                <?php echo e($review->product['name']); ?>

                                            </div>
                                        </a>
                                        <?php endif; ?>
                                        <?php else: ?>
                                            <span class="badge-pill badge-soft-dark text-muted text-sm small">
                                                <?php echo e(translate('Product unavailable')); ?>

                                            </span>
                                        <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <span class="text-info">
                                    <?php echo e($review->rating); ?> <i class="tio-star"></i>
                                </span>
                                <div class="max-200px line--limit-3">
                                    <?php echo e($review->comment); ?>

                                </div>
                            </td>
                            <td>
                                <?php if(isset($review->customer)): ?>
                                    <a href="<?php echo e(route('admin.customer.view',[$review->user_id])); ?>" class="text-body">
                                        <h6 class="text-capitalize short-title max-w--160px">
                                            <?php echo e($review->customer->f_name." ".$review->customer->l_name); ?>

                                        </h6>
                                        <span><?php echo e($review->customer->phone); ?></span>
                                    </a>
                                <?php else: ?>
                                    <span class="badge-pill badge-soft-dark text-muted text-sm small">
                                        <?php echo e(translate('Customer unavailable')); ?>

                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <label class="toggle-switch">
                                    <input type="checkbox" class="toggle-switch-input status-change-alert" id="stocksCheckbox<?php echo e($review->id); ?>"
                                           data-route="<?php echo e(route('admin.reviews.status', [$review->id, $review->is_active ? 0 : 1])); ?>"
                                           data-message="<?php echo e($review->is_active? translate('you_want_to_disable_this_review'): translate('you_want_to_active_this_review')); ?>"
                                        <?php echo e($review->is_active ? 'checked' : ''); ?>>
                                    <span class="toggle-switch-label text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <hr>
                <div class="page-area">
                    <table>
                        <tfoot>
                        <?php echo $reviews->links(); ?>

                        </tfoot>
                    </table>
                </div>
                <?php if(count($reviews) == 0): ?>
                    <div class="text-center p-4">
                        <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="Image Description">
                        <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/reviews/list.blade.php ENDPATH**/ ?>