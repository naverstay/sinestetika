<?php if($items instanceof \SleepingOwl\Admin\Form\Element\Columns): ?>
    <?php echo $items->render(); ?>

<?php else: ?>
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($item instanceof \Illuminate\Contracts\Support\Renderable): ?>
            <?php echo $item->render(); ?>

        <?php else: ?>
            <?php echo $item; ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
