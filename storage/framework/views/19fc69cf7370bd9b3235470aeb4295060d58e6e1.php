<?php if(count($errors->get($path))> 0): ?>

<ul class="form-element-errors">
    <?php $__currentLoopData = $errors->get($path); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo $error; ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php endif; ?>