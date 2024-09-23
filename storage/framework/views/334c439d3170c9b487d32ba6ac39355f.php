<?php $__env->startSection('title', translate('Payment Setup')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <?php echo $__env->make('admin-views.business-settings.partial.third-party-api-navmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-3"><?php echo e(translate('payment')); ?> <?php echo e(translate('method')); ?></h5>
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('cash_on_delivery')); ?>
                        <form action="<?php echo e(route('admin.business-settings.web-app.payment-method-update',['cash_on_delivery'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>

                                <div class="form-group">
                                    <label class="form-label text--title">
                                        <strong><?php echo e(translate('cash_on_delivery')); ?></strong>
                                    </label>
                                </div>

                                <div class="d-flex flex-wrap mb-4">
                                    <label class="form-check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status"  value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                        <span class="form-check-label text--title pl-2"><?php echo e(translate('active')); ?></span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                        <span class="form-check-label text--title pl-2"><?php echo e(translate('inactive')); ?></span>
                                    </label>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary px-5"><?php echo e(translate('save')); ?></button>
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <label class="form-label text--title">
                                        <strong><?php echo e(translate('cash_on_delivery')); ?></strong>
                                    </label>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary px-5"><?php echo e(translate('configure')); ?></button>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-3"><?php echo e(translate('payment')); ?> <?php echo e(translate('method')); ?></h5>
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('digital_payment')); ?>
                        <form action="<?php echo e(route('admin.business-settings.web-app.payment-method-update',['digital_payment'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>

                                <div class="form-group">
                                    <label class="form-label text--title">
                                        <strong><?php echo e(translate('digital')); ?> <?php echo e(translate('payment')); ?></strong>
                                    </label>
                                </div>

                                <div class="d-flex flex-wrap mb-4">
                                    <label class="form-check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status"  value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                        <span class="form-check-label text--title pl-2"><?php echo e(translate('active')); ?></span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                        <span class="form-check-label text--title pl-2"><?php echo e(translate('inactive')); ?></span>
                                    </label>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary px-5"><?php echo e(translate('save')); ?></button>
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <label class="form-label text--title">
                                        <strong><?php echo e(translate('digital')); ?> <?php echo e(translate('payment')); ?></strong>
                                    </label>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary px-5"><?php echo e(translate('configure')); ?></button>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-3"><?php echo e(translate('payment')); ?> <?php echo e(translate('method')); ?></h5>
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('offline_payment')); ?>
                        <form action="<?php echo e(route('admin.business-settings.web-app.payment-method-update',['offline_payment'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>

                                <div class="form-group">
                                    <label class="form-label text--title">
                                        <strong><?php echo e(translate('offline')); ?> <?php echo e(translate('payment')); ?></strong>
                                    </label>
                                </div>

                                <div class="d-flex flex-wrap mb-4">
                                    <label class="form-check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status"  value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                        <span class="form-check-label text--title pl-2"><?php echo e(translate('active')); ?></span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                        <span class="form-check-label text--title pl-2"><?php echo e(translate('inactive')); ?></span>
                                    </label>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary px-5"><?php echo e(translate('save')); ?></button>
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <label class="form-label text--title">
                                        <strong><?php echo e(translate('offline')); ?> <?php echo e(translate('payment')); ?></strong>
                                    </label>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary px-5"><?php echo e(translate('configure')); ?></button>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php if($published_status == 1): ?>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around">
                            <h4 class="text-danger mt-3">
                                <i class="tio-info-outined"></i>
                                <?php echo e(translate('Your current payment settings are disabled, because you have enabled
                                payment gateway addon, To visit your currently active payment gateway settings please follow
                                the link.')); ?>

                            </h4>
                            <span>
                            <a href="<?php echo e(!empty($payment_url) ? $payment_url : ''); ?>" class="btn btn-outline-primary"><i class="tio-settings mr-1"></i><?php echo e(translate('settings')); ?></a>
                        </span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="row digital_payment_methods mt-3 g-3" id="payment-gatway-cards">
            <?php $__currentLoopData = $data_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.web-app.payment-config-update'):'javascript:'); ?>" method="POST"
                              id="<?php echo e($payment->key_name); ?>-form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card-header d-flex flex-wrap align-content-around">
                                <h5>
                                    <span class="text-uppercase"><?php echo e(str_replace('_',' ',$payment->key_name)); ?></span>
                                </h5>
                                <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                    <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">on</span>
                                    <span class="mr-2 switch--custom-label-text off text-uppercase">off</span>
                                    <input type="checkbox" name="status" value="1"
                                           class="toggle-switch-input" <?php echo e($payment['is_active']==1?'checked':''); ?>>
                                    <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                </label>
                            </div>

                            <?php ($additional_data = $payment['additional_data'] != null ? json_decode($payment['additional_data']) : []); ?>
                            <div class="card-body">
                                <div class="payment--gateway-img">
                                    <img class="h--92px"
                                         src="<?php echo e(App\CentralLogics\Helpers::onErrorImage($additional_data != null ? $additional_data->gateway_image : '',
                                               asset('storage/app/public/payment_modules/gateway_image') . '/' . ($additional_data != null ? $additional_data->gateway_image : ''),
                                               asset('public/assets/admin/img/placeholder.png'), 'payment_modules/gateway_image/')); ?>"
                                         alt="<?php echo e(translate('gateway_image')); ?>">
                                </div>

                                <input name="gateway" value="<?php echo e($payment->key_name); ?>" class="d-none">

                                <?php ($mode=$data_values->where('key_name',$payment->key_name)->first()->live_values['mode']); ?>
                                <div class="form-floating mb-2">
                                    <select class="js-select form-control theme-input-style w-100" name="mode">
                                        <option value="live" <?php echo e($mode=='live'?'selected':''); ?>>Live</option>
                                        <option value="test" <?php echo e($mode=='test'?'selected':''); ?>>Test</option>
                                    </select>
                                </div>

                                <?php ($skip=['gateway','mode','status']); ?>
                                <?php $__currentLoopData = $data_values->where('key_name',$payment->key_name)->first()->live_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!in_array($key,$skip)): ?>
                                        <div class="form-floating mb-2">
                                            <label for="exampleFormControlInput1"
                                                   class="form-label"><?php echo e(ucwords(str_replace('_',' ',$key))); ?>*</label>
                                            <input type="text" class="form-control"
                                                   name="<?php echo e($key); ?>"
                                                   placeholder="<?php echo e(ucwords(str_replace('_',' ',$key))); ?> *"
                                                   value="<?php echo e(env('APP_ENV')=='demo'?'':$value); ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="form-floating mb-2">
                                    <label for="exampleFormControlInput1"
                                           class="form-label"><?php echo e(translate('payment_gateway_title')); ?></label>
                                    <input type="text" class="form-control" name="gateway_title" placeholder="<?php echo e(translate('payment_gateway_title')); ?>"
                                           value="<?php echo e($additional_data != null ? $additional_data->gateway_title : ''); ?>">
                                </div>

                                <div class="form-floating mb-2">
                                    <label for="exampleFormControlInput1"
                                           class="form-label"><?php echo e(translate('choose logo')); ?></label>
                                    <input type="file" class="form-control" name="gateway_image" accept=".jpg, .png, .jpeg|image/*">
                                </div>

                                <div class="text-right mb-2">
                                    <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                            class="btn btn-primary px-5 call-demo"><?php echo e(translate('save')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

<script>
    "use strict";

    $(document).on('change', 'input[name="gateway_image"]', function () {
        console.log('aa');
        var $input = $(this);
        var $form = $input.closest('form');
        var gatewayName = $form.attr('id');

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            var $imagePreview = $form.find('.payment--gateway-img img');

            reader.onload = function (e) {
                $imagePreview.attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    function checkedFunc() {
        $('.switch--custom-label .toggle-switch-input').each( function() {
            if(this.checked) {
                $(this).closest('.switch--custom-label').addClass('checked')
            }else {
                $(this).closest('.switch--custom-label').removeClass('checked')
            }
        })
    }
    checkedFunc()
    $('.switch--custom-label .toggle-switch-input').on('change', checkedFunc)


    <?php if($published_status == 1): ?>
    $('#payment-gatway-cards').find('input').each(function(){
        $(this).attr('disabled', true);
    });
    $('#payment-gatway-cards').find('select').each(function(){
        $(this).attr('disabled', true);
    });
    $('#payment-gatway-cards').find('.switcher_input').each(function(){
        $(this).removeAttr('checked', true);
    });
    $('#payment-gatway-cards').find('button').each(function(){
        $(this).attr('disabled', true);
    });
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>




<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/business-settings/payment-index.blade.php ENDPATH**/ ?>