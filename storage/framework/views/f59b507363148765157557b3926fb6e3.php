<?php $__env->startSection('title', translate('Sale Report')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="media align-items-center">
                <img class="w--20" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/credit-card.svg"
                     alt="Image Description">
                <div class="media-body pl-3">
                    <h1 class="page-header-title mb-1"><?php echo e(translate('sale')); ?> <?php echo e(translate('report')); ?> <?php echo e(translate('overview')); ?></h1>
                    <div>
                        <span><?php echo e(translate('admin')); ?>:</span>
                        <a href="#" class="text--primary-2"><?php echo e(auth('admin')->user()->f_name.' '.auth('admin')->user()->l_name); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="w-100 pt-3">
                        <form class="w-100">
                            <div class="row g-3 g-sm-4 g-md-3 g-lg-4">
                                <div class="col-sm-6 col-md-4 col-lg-2">
                                    <select class="custom-select custom-select-sm text-capitalize min-h-45px" name="branch_id">
                                        <option disabled selected>--- <?php echo e(translate('select')); ?> <?php echo e(translate('branch')); ?> ---</option>
                                        <option value="all" <?php echo e(is_null($branchId) || $branchId == 'all' ? 'selected': ''); ?>><?php echo e(translate('all')); ?> <?php echo e(translate('branch')); ?></option>
                                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($branch['id']); ?>" <?php echo e($branch['id'] == $branchId ? 'selected' : ''); ?>><?php echo e($branch['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="input-date-group">
                                        <label class="input-label" for="start_date"><?php echo e(translate('Start Date')); ?></label>
                                        <label class="input-date">
                                            <input type="text" id="start_date" name="start_date" value="<?php echo e($startDate); ?>" class="js-flatpickr form-control flatpickr-custom min-h-45px" placeholder="<?php echo e(translate('yy-mm-dd')); ?>" data-hs-flatpickr-options='{ "dateFormat": "Y-m-d"}'>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="input-date-group">
                                        <label class="input-label" for="end_date"><?php echo e(translate('End Date')); ?></label>
                                        <label class="input-date">
                                            <input type="text" id="end_date" name="end_date" value="<?php echo e($endDate); ?>" class="js-flatpickr form-control flatpickr-custom min-h-45px" placeholder="<?php echo e(translate('yy-mm-dd')); ?>" data-hs-flatpickr-options='{ "dateFormat": "Y-m-d"}'>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-4 __btn-row">
                                    <a href="<?php echo e(route('admin.report.sale-report')); ?>" id="" class="btn w-100 btn--reset min-h-45px"><?php echo e(translate('clear')); ?></a>
                                    <button type="submit" id="show_filter_data" class="btn w-100 btn--primary min-h-45px"><?php echo e(translate('show data')); ?></button>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-12 pt-4">
                            <div class="report--data">
                                <div class="row g-3">
                                    <div class="col-sm-4">
                                        <div class="order--card h-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                                    <span><?php echo e(translate('total orders')); ?></span>
                                                </h6>
                                                <span class="card-title text-success" id="order_count"><?php echo e(count($orders)); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="order--card h-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                                    <span><?php echo e(translate('total item qty')); ?></span>
                                                </h6>
                                                <span class="card-title text-success" id="item_count"><?php echo e($totalQty); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="order--card h-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                                    <span><?php echo e(translate('total amount')); ?></span>
                                                </h6>
                                                <span class="card-title text-success" id="order_amount"><?php echo e($totalSold); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="set-rows">
                    <table class="table table-borderless table-align-middle">
                        <thead class="thead-light">
                        <tr>
                            <th><?php echo e(translate('#')); ?> </th>
                            <th><?php echo e(translate('product info')); ?></th>
                            <th><?php echo e(translate('qty')); ?></th>
                            <th><?php echo e(translate('date')); ?></th>
                            <th><?php echo e(translate('amount')); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php
                                $price = $detail['price'] - $detail['discount_on_product'];
                                $orderTotal = $price * $detail['quantity'];
                                $product = json_decode($detail->product_details, true);
                                $images = $product['image'] != null ? (gettype($product['image'])!='array'?json_decode($product['image'],true):$product['image']) : [];
                                $productImage = count($images) > 0 ? $images[0] : null;

                            ?>
                            <tr>
                                <td>
                                    <?php echo e($orderDetails->firstItem()+$key); ?>

                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.product.view',[$product['id']])); ?>" target="_blank" class="product-list-media">
                                        <img src="<?php echo e($detail->product? $detail->product->identityImageFullPath[0] : asset('public/assets/admin/img/160x160/2.png')); ?>">
                                        <h6 class="name line--limit-2">
                                            <?php echo e($product['name']); ?>

                                        </h6>
                                    </a>
                                </td>
                                <td>
                                    <span class="badge badge-soft-primary"><?php echo e($detail['quantity']); ?></span>
                                </td>
                                <td>
                                    <div class="word-nobreak">
                                        <?php echo e(date('d M Y',strtotime($detail['created_at']))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <?php echo e(Helpers::set_symbol($orderTotal)); ?>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                    <div class="card-footer border-0">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <?php echo $orderDetails->links(); ?>

                        </div>
                    </div>
                    <?php if(count($orderDetails) === 0): ?>
                        <div class="text-center p-4">
                            <img class="mb-3 w-120px" src="<?php echo e(asset('public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('Image Description')); ?>">
                            <p class="mb-0"><?php echo e(translate('No data to show')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/flatpicker.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/report/sale-report.blade.php ENDPATH**/ ?>