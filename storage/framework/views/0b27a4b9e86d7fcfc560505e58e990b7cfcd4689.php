<?php if($placements): ?>
    <?php $__currentLoopData = $placements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__env->startSection(implode('.', [$key, $section])); ?>
                <div <?php echo $attributes; ?>>
                    <div class="btn-group" role="group">
                        <?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($button instanceof \SleepingOwl\Admin\Form\Buttons\FormButton && $button->canShow()): ?>
                                <?php echo $button->render(); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php $__env->stopSection(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div <?php echo $attributes; ?>>
    <div class="btn-group" role="group">
        <?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($button instanceof \SleepingOwl\Admin\Form\Buttons\FormButton && $button->canShow()): ?>
                <?php echo $button->render(); ?>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php else: ?>
    <div <?php echo $attributes; ?>>
        <div class="btn-group" role="group">
            <?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($button instanceof \SleepingOwl\Admin\Form\Buttons\FormButton && $button->canShow()): ?>
                    <?php echo $button->render(); ?>

                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>