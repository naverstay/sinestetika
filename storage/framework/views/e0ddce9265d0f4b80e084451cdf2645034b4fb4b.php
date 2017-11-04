<<?php echo e($tag); ?> <?php echo $attributes; ?>>
    <tr>
        <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td data-index="<?php echo e($index); ?>">
                <?php echo $filter; ?>

            </td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
</<?php echo e($tag); ?>>