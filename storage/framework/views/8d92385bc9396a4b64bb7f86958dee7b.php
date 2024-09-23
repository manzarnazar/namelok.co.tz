<?php if(session()->has('address')): ?>
<?php
    $address = session()->get('address')
?>
<ul>
    <li>
        <span><?php echo e(translate('Name')); ?></span>
        <strong><?php echo e($address['contact_person_name']); ?></strong>
    </li>
    <li>
        <span><?php echo e(translate('contact')); ?></span>
        <strong><?php echo e($address['contact_person_number']); ?></strong>
    </li>
</ul>
<div class="location">
    <i class="tio-poi"></i>
    <span>
        <?php echo e($address['address']); ?>

    </span>
</div>
<?php endif; ?>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/pos/_address.blade.php ENDPATH**/ ?>