<li <?php echo $attributes; ?>>
    <a href="#<?php echo e($name); ?>" aria-controls="<?php echo e($name); ?>" role="tab" data-toggle="tab">
        <?php if($icon): ?>
            <?php echo $icon; ?>

        <?php endif; ?>

        <?php echo e($label); ?>

        <?php if($badge): ?>
            <?php echo $badge->render(); ?>

        <?php endif; ?>
    </a>
</li>