<a href="<?php echo e($url); ?>" <?php echo $attributes; ?>>
    <?php if($icon): ?>
        <i class="<?php echo e($icon); ?>"></i>
    <?php endif; ?>

    <?php if(!$hideText): ?>
        <?php echo $text; ?>

    <?php endif; ?>
</a>