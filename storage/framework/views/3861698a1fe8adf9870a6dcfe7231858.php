<div class="modal fade add-customer" id="add-customer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(translate('Add new customer')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('admin.pos.customer.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('First name')); ?> <span class="input-label-secondary text-danger">*</span></label>
                                <input type="text" name="f_name" class="form-control" value="" placeholder="<?php echo e(translate('First name')); ?>" required="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('Last name')); ?> <span class="input-label-secondary text-danger">*</span></label>
                                <input type="text" name="l_name" class="form-control" value="" placeholder="<?php echo e(translate('Last name')); ?>" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('Email')); ?><span class="input-label-secondary text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="" placeholder="<?php echo e(translate('Ex : ex@example.com')); ?>" required="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('Phone (With country code)')); ?><span class="input-label-secondary text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" value="" placeholder="<?php echo e(translate('Phone')); ?>" required="">
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end">
                        <button type="reset" class="btn btn--reset"><?php echo e(translate('Reset')); ?></button>
                        <button type="submit" id="submit_new_customer" class="btn btn--primary"><?php echo e(translate('Submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/pos/add-customer-modal.blade.php ENDPATH**/ ?>