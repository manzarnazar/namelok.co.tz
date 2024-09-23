<?php $__env->startSection('title', translate('Category Discount')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/coupon.png')); ?>" class="w--20" alt="<?php echo e(translate('discount')); ?>">
                </span>
                <span>
                    <?php echo e(translate('discount')); ?>

                </span>
            </h1>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="<?php echo e(route('admin.discount.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('name')); ?></label>
                                <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control" placeholder="<?php echo e(translate('New discount')); ?>" maxlength="255" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-0" id="type-category">
                                <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('category')); ?> <span
                                        class="input-label-secondary">*</span></label>
                                <select name="category_id" class="form-control js-select2-custom" required>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('start')); ?> <?php echo e(translate('date')); ?></label>
                                <label class="input-date">
                                    <input type="text" name="start_date" id="start_date" value="<?php echo e(old('start_date')); ?>" class="js-flatpickr form-control flatpickr-custom" placeholder="<?php echo e(translate('dd/mm/yy')); ?>" data-hs-flatpickr-options='{ "dateFormat": "Y/m/d", "minDate": "today" }' required>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('expire')); ?> <?php echo e(translate('date')); ?></label>
                                <label class="input-date">
                                    <input type="text" name="expire_date" id="expire_date" value="<?php echo e(old('expire_date')); ?>" class="js-flatpickr form-control flatpickr-custom" placeholder="<?php echo e(translate('dd/mm/yy')); ?>" data-hs-flatpickr-options='{ "dateFormat": "Y/m/d", "minDate": "today" }' required>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('discount')); ?> <?php echo e(translate('type')); ?><span
                                        class="input-label-secondary">*</span></label>
                                <select name="discount_type" class="form-control change-discount-type">
                                    <option value="percent"><?php echo e(translate('percent')); ?></option>
                                    <option value="amount"><?php echo e(translate('amount')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('discount_amount')); ?></label>
                                <input type="number" step="0.1" name="discount_amount" value="<?php echo e(old('discount_amount')); ?>" class="form-control" placeholder="<?php echo e(translate('discount_amount')); ?>" required>
                            </div>
                        </div>
                        <div class="col-6" id="max_amount_div">
                            <div class="form-group mb-0">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('maximum_amount')); ?></label>
                                <input type="number" step="0.1" name="maximum_amount" value="<?php echo e(old('maximum_amount')); ?>" class="form-control" placeholder="<?php echo e(translate('maximum_amount')); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="btn--container justify-content-end">
                            <button type="reset" class="btn btn--reset"><?php echo e(translate('reset')); ?></button>
                            <button type="submit" class="btn btn--primary"><?php echo e(translate('submit')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-0">
                <div class="card--header justify-content-between max--sm-grow">
                    <h5 class="card-title"><?php echo e(translate('discount_list')); ?> <span class="badge badge-soft-secondary"><?php echo e($discounts->total()); ?></span></h5>
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control"
                                   placeholder="<?php echo e(translate('Search_by_name')); ?>" aria-label="Search"
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
                        <th class="border-0"><?php echo e(translate('title')); ?></th>
                        <th class="border-0"><?php echo e(translate('discount type')); ?></th>
                        <th class="border-0"><?php echo e(translate('discount on')); ?></th>
                        <th class="border-0"><?php echo e(translate('discount amount')); ?></th>
                        <th class="border-0"><?php echo e(translate('maximum amount')); ?></th>
                        <th class="border-0"><?php echo e(translate('duration')); ?></th>
                        <th class="text-center border-0"><?php echo e(translate('status')); ?></th>
                        <th class="text-center border-0"><?php echo e(translate('action')); ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td>
                                <span class="d-block font-size-sm text-body text-trim-25">
                                    <?php echo e($discount['name']); ?>

                                </span>
                            </td>
                            <td><?php echo e(translate($discount->discount_type)); ?></td>
                            <td><?php echo e($discount->category ? $discount->category->name:''); ?></td>
                            <td>
                                <?php echo e($discount->discount_type == 'percent' ? $discount->discount_amount . '%' : Helpers::set_symbol($discount->discount_amount)); ?>

                            </td>
                            <td><?php echo e($discount->discount_type == 'percent' ? Helpers::set_symbol($discount->maximum_amount) : '-'); ?></td>
                            <td>
                                <?php echo e($discount->start_date->format('d M, Y')); ?> - <?php echo e($discount->expire_date->format('d M, Y')); ?>

                            </td>
                            <td>
                                <label class="toggle-switch my-0">
                                    <input type="checkbox"
                                           data-route="<?php echo e(route('admin.discount.status', [$discount->id, $discount->status ? 0 : 1])); ?>"
                                           data-message="<?php echo e($discount->status? translate('you_want_to_disable_this_discount'): translate('you_want_to_active_this_discount')); ?>"
                                           class="toggle-switch-input status-change-alert" id="stocksCheckbox<?php echo e($discount->id); ?>"
                                        <?php echo e($discount->status ? 'checked' : ''); ?>>
                                    <span class="toggle-switch-label mx-auto text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="action-btn"
                                       href="<?php echo e(route('admin.discount.edit',[$discount['id']])); ?>">
                                        <i class="tio-edit"></i></a>
                                    <a class="action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                       data-id="discount-<?php echo e($discount['id']); ?>"
                                       data-message="<?php echo e(translate("Want to delete this")); ?>">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                </div>
                                <form action="<?php echo e(route('admin.discount.delete',[$discount['id']])); ?>"
                                      method="post" id="discount-<?php echo e($discount['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <table>
                    <tfoot>
                    <?php echo $discounts->links(); ?>

                    </tfoot>
                </table>

            </div>
            <?php if(count($discounts) == 0): ?>
                <div class="text-center p-4">
                    <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('image')); ?>">
                    <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/discount.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/discount/index.blade.php ENDPATH**/ ?>