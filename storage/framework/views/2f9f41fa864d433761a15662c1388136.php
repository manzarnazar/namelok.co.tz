<?php $__env->startSection('title', translate('Add new coupon')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/coupon.png')); ?>" class="w--20" alt="<?php echo e(translate('coupon')); ?>">
                </span>
                <span>
                    <?php echo e(translate('Coupon Setup')); ?>

                </span>
            </h1>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-xl-30">
                        <form action="<?php echo e(route('admin.coupon.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row gx--3">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('coupon type')); ?></label>
                                        <select name="coupon_type" class="form-control coupon-type">
                                            <option value="default"><?php echo e(translate('default')); ?></option>
                                            <option value="first_order"><?php echo e(translate('first order')); ?></option>
                                            <option value="free_delivery"><?php echo e(translate('free delivery')); ?></option>
                                            <option value="customer_wise"><?php echo e(translate('customer wise')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('coupon title')); ?></label>
                                        <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control" placeholder="<?php echo e(translate('New coupon')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('coupon code')); ?></label>
                                            <a href="javascript:void(0)" class="float-right c1 fz-12 generate-code"><?php echo e(translate('generate_code')); ?></a>
                                        </div>
                                        <input type="text" name="code" class="form-control" id="code"
                                            placeholder="<?php echo e(\Illuminate\Support\Str::random(8)); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6" id="limit-for-user">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('limit')); ?> <?php echo e(translate('for')); ?> <?php echo e(translate('same')); ?> <?php echo e(translate('user')); ?></label>
                                        <input type="number" name="limit" value="<?php echo e(old('limit')); ?>" id="user-limit" min="1" class="form-control" placeholder="<?php echo e(translate('EX: 10')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6" id="discount_type_div">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('discount')); ?> <?php echo e(translate('type')); ?></label>
                                        <select name="discount_type" id="discount_type" class="form-control">
                                            <option value="percent"><?php echo e(translate('percent')); ?></option>
                                            <option value="amount"><?php echo e(translate('amount')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6" id="discount_amount_div">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('discount amount')); ?></label>
                                        <input type="number" step="any" min="1" max="10000" name="discount" id="discount_amount" value="<?php echo e(old('discount') ? old('discount') : 0); ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('minimum')); ?> <?php echo e(translate('purchase')); ?></label>
                                        <input type="number" step="any" name="min_purchase" value="<?php echo e(old('min_purchase') ? old('min_purchase') : 0); ?>" min="0" max="100000" class="form-control"
                                            placeholder="<?php echo e(translate('100')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6" id="max_discount_div">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('maximum')); ?> <?php echo e(translate('discount')); ?></label>
                                        <input type="number" step="any" min="0" value="<?php echo e(old('max_discount') ? old('max_discount') : 0); ?>" max="1000000" name="max_discount" id="max_discount" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('start')); ?> <?php echo e(translate('date')); ?></label>
                                        <label class="input-date">
                                            <input type="text" name="start_date" id="start_date" value="<?php echo e(old('start_date')); ?>" class="js-flatpickr form-control flatpickr-custom" placeholder="<?php echo e(translate('dd/mm/yy')); ?>" data-hs-flatpickr-options='{ "dateFormat": "Y/m/d", "minDate": "today" }'>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('expire')); ?> <?php echo e(translate('date')); ?></label>
                                        <label class="input-date">
                                            <input type="text" name="expire_date" id="expire_date" value="<?php echo e(old('expire_date')); ?>" class="js-flatpickr form-control flatpickr-custom" placeholder="<?php echo e(translate('dd/mm/yy')); ?>" data-hs-flatpickr-options='{ "dateFormat": "Y/m/d", "minDate": "today" }'>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6 d-none" id="customer_div">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('customer')); ?></label>
                                        <select name="customer_id" id="customer_id" class="form-control js-select2-custom">
                                            <option value=""><?php echo e(translate('select customer')); ?></option>
                                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->f_name.' '. $customer->l_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="reset" class="btn btn--reset"><?php echo e(translate('reset')); ?></button>
                                <button type="submit" class="btn btn--primary"><?php echo e(translate('submit')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-header flex-between border-0">
                        <div class="card--header">
                            <h5 class="card-title"><?php echo e(translate('Coupon Table')); ?> <span class="ml-2 badge badge-pill badge-soft-secondary"><?php echo e($coupons->total()); ?></span> </h5>
                            <form action="<?php echo e(url()->current()); ?>" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search"
                                            class="form-control"
                                            placeholder="<?php echo e(translate('Search by title or coupon code')); ?>" aria-label="Search"
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
                                <th><?php echo e(translate('coupon')); ?></th>
                                <th><?php echo e(translate('coupon_type')); ?></th>
                                <th><?php echo e(translate('discount_type')); ?></th>
                                <th><?php echo e(translate('duration')); ?></th>
                                <th><?php echo e(translate('User')); ?> <?php echo e('Limit'); ?></th>
                                <th class="text-center"><?php echo e(translate('status')); ?></th>
                                <th class="text-center"><?php echo e(translate('action')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($coupons->firstItem()+$key); ?></td>
                                    <td>
                                        <span  id="coupon_details">
                                            <strong class="text--title"><?php echo e(translate('Code')); ?> : <?php echo e($coupon['code']); ?></strong>
                                        </span>
                                        <span id="coupon_details">
                                            <span class="d-block font-size-sm text-body"><?php echo e($coupon['title']); ?></span>
                                        </span>
                                    </td>
                                    <td><?php echo e(translate($coupon->coupon_type)); ?></td>
                                    <td class="text-capitalize">
                                        <div><?php echo e(translate($coupon->coupon_type === 'free_delivery' ? translate('Free Delivery') : translate('discount in '). $coupon['discount_type'])); ?></div>
                                    </td>
                                    <td>
                                        <?php echo e($coupon->start_date->format('d M, Y')); ?> - <?php echo e($coupon->expire_date->format('d M, Y')); ?>

                                    </td>
                                    <td>
                                        <span><?php echo e(translate('Limit')); ?> : <strong><?php echo e($coupon->coupon_type === 'first_order' ? '-' : $coupon['limit']); ?>,</strong></span>
                                        <span><?php echo e(translate('Used')); ?> : <strong><?php echo e($coupon['order_count']); ?></strong></span>
                                    </td>
                                    <td>
                                        <label class="toggle-switch my-0">
                                            <input type="checkbox"
                                                class="toggle-switch-input status-change-alert" id="stocksCheckbox<?php echo e($coupon->id); ?>"
                                                   data-route="<?php echo e(route('admin.coupon.status', [$coupon->id, $coupon->status ? 0 : 1])); ?>"
                                                   data-message="<?php echo e($coupon->status? translate('you_want_to_disable_this_coupon'): translate('you_want_to_active_this_coupon')); ?>"
                                                <?php echo e($coupon->status ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label mx-auto text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="action-btn btn--warning btn-outline-warning get-coupon-details" id="get-coupon-details"
                                               href="#" data-id="<?php echo e($coupon['id']); ?>" data-toggle="modal" data-target="#exampleModalCenter">
                                                <i class="tio-invisible"></i></a>
                                            <a class="action-btn" href="<?php echo e(route('admin.coupon.update',[$coupon['id']])); ?>"><i class="tio-edit"></i></a>
                                            <a class="action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                               data-id="coupon-<?php echo e($coupon['id']); ?>"
                                               data-message="<?php echo e(translate('Want to delete this coupon')); ?>?">
                                                <i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.coupon.delete',[$coupon['id']])); ?>"
                                                    method="post" id="coupon-<?php echo e($coupon['id']); ?>">
                                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <table>
                            <tfoot>
                            <?php echo $coupons->links(); ?>

                            </tfoot>
                        </table>
                        <?php if(count($coupons) == 0): ?>
                        <div class="text-center p-4">
                            <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="Image Description">
                            <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quick-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered coupon-details" role="document">
            <div class="modal-content" id="quick-view-modal">
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/coupon-index.js')); ?>"></script>
    <script>
    "use strict";

        $('.get-coupon-details').on('click', function (){
            let id = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: '<?php echo e(route('admin.coupon.quick-view-details')); ?>',
                data: {
                    id: id
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#loading').hide();
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                }
            });
        })

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/coupon/index.blade.php ENDPATH**/ ?>