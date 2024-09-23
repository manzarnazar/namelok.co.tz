<?php $__env->startSection('title', translate('Add new attribute')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/attribute.png')); ?>" class="w--24" alt="<?php echo e(translate('attribute')); ?>">
                </span>
                <span>
                    <?php echo e(translate('Attribute Setup')); ?>

                </span>
            </h1>
        </div>
        <div class="card">
            <div class="card-header border-0">
                <div class="card--header">
                    <h5 class="card-title"><?php echo e(translate('Attribute Table')); ?> <span class="badge badge-soft-secondary"><?php echo e($attributes->total()); ?></span> </h5>
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group">
                            <input id="datatableSearch_" type="search" name="search"
                                class="form-control"
                                placeholder="<?php echo e(translate('Search')); ?>" aria-label="Search"
                                value="<?php echo e($search); ?>" required autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text"><i class="tio-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn--primary ml-lg-4" data-toggle="modal" data-target="#attribute-modal"><i class="tio-add"></i> <?php echo e(translate('add_attribute')); ?></button>
                </div>
            </div>
            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                    <tr>
                        <th><?php echo e(translate('#')); ?></th>
                        <th><?php echo e(translate('name')); ?></th>
                        <th class="text-center"><?php echo e(translate('action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($attributes->firstItem()+$key); ?></td>
                            <td>
                                <span class="d-block font-size-sm text-body text-trim-70">
                                    <?php echo e($attribute['name']); ?>

                                </span>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="action-btn"
                                        href="<?php echo e(route('admin.attribute.edit',[$attribute['id']])); ?>">
                                    <i class="tio-edit"></i></a>
                                    <a class="action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                        data-id="attribute-<?php echo e($attribute['id']); ?>"
                                        data-message="<?php echo e(translate("Want to delete this")); ?>">
                                        <i class="tio-delete-outlined"></i>
                                    </a>
                                </div>
                                <form action="<?php echo e(route('admin.attribute.delete',[$attribute['id']])); ?>"
                                        method="post" id="attribute-<?php echo e($attribute['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <table>
                    <tfoot>
                    <?php echo $attributes->links(); ?>

                    </tfoot>
                </table>

                <?php if(count($attributes) == 0): ?>
                <div class="text-center p-4">
                    <img class="w-120px mb-3" src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="<?php echo e(translate('image')); ?>">
                    <p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="attribute-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.attribute.store')); ?>" method="post">
                    <div class="modal-body pt-3">
                        <?php echo csrf_field(); ?>
                        <?php ($data = Helpers::get_business_settings('language')); ?>
                        <?php ($defaultLang = Helpers::get_default_language()); ?>

                        <?php if($data && array_key_exists('code', $data[0])): ?>
                            <ul class="nav nav-tabs mb-4">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link <?php echo e($lang['default'] == true ? 'active':''); ?>" href="#" id="<?php echo e($lang['code']); ?>-link">
                                        <?php echo e(Helpers::get_language_name($lang['code']).'('.strtoupper($lang['code']).')'); ?>

                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="row">
                                <div class="col-12">
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group lang_form <?php echo e($lang['default'] == false ? 'd-none':''); ?>" id="<?php echo e($lang['code']); ?>-form">
                                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('name')); ?> (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                            <input type="text" name="name[]" class="form-control"
                                                placeholder="<?php echo e(translate('New attribute')); ?>"
                                                <?php echo e($lang['status'] == true ? 'required':''); ?> maxlength="255"
                                                <?php if($lang['status'] == true): ?> oninvalid="document.getElementById('<?php echo e($lang['code']); ?>-link').click()" <?php endif; ?>>
                                        </div>
                                        <input type="hidden" name="lang[]" value="<?php echo e($lang['code']); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group lang_form" id="<?php echo e($defaultLang); ?>-form">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('name')); ?> (<?php echo e(strtoupper($defaultLang)); ?>)</label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('New attribute')); ?>" maxlength="255">
                                </div>
                                <input type="hidden" name="lang[]" value="<?php echo e($defaultLang); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="btn--container justify-content-end">
                            <button type="reset" class="btn btn--reset" data-dismiss="modal"><?php echo e(translate('cancel')); ?></button>
                            <button type="submit" class="btn btn--primary"><?php echo e(translate('submit')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";

        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == '<?php echo e($defaultLang); ?>')
            {
                $(".from_part_2").removeClass('d-none');
            }
            else
            {
                $(".from_part_2").addClass('d-none');
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/attribute/index.blade.php ENDPATH**/ ?>