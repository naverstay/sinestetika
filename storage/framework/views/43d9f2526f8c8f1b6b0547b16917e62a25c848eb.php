<?php if($items instanceof \SleepingOwl\Admin\Form\Element\Columns): ?>
    <div class="form-elements">
        <?php echo $items->render(); ?>

    </div>
<?php else: ?>
    <div class="form-elements">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item instanceof \Illuminate\Contracts\Support\Renderable): ?>
                <?php if(method_exists($item, 'getName')): ?>
                    <?php echo $__env->yieldContent('before.'. $item->getName()); ?>
                <?php endif; ?>
                <?php echo $item->render(); ?>

                <?php if(method_exists($item, 'getName')): ?>
                    <?php echo $__env->yieldContent('after.'. $item->getName()); ?>
                <?php endif; ?>
            <?php else: ?>
                <?php echo $item; ?>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>