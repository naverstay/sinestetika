<?php if(!$url): ?>
    <button <?php echo $attributes; ?> value="<?php echo e($name); ?>">
        <?php if($iconClass): ?><i class="fa <?php echo e($iconClass); ?>"></i><?php endif; ?> <?php echo e($text); ?>

    </button>
<?php else: ?>
    <a href="<?php echo e($url); ?>" class="btn btn-warning">
        <i class="fa <?php echo e($iconClass); ?>"></i> <?php echo e($text); ?>

    </a>
<?php endif; ?>
<?php if($groupElements): ?>
    <div class="btn-group">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-menu btn-actions">
            <div class="btn-group-vertical">
                <?php $__currentLoopData = $groupElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupButton): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($groupButton instanceof \SleepingOwl\Admin\Form\Buttons\FormButton && $groupButton->getShow()): ?>
                        <?php echo $groupButton->render(); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>