<?php if($hasChild): ?>
<li <?php echo $attributes; ?>>
    <a href="#" >
        <?php echo $icon; ?>

        <span><?php echo $title; ?></span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            <?php if($badges->count() > 0): ?>
            <span class="sidebar-page-badges">
            <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $badge->render(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span>
            <?php endif; ?>
        </span>
    </a>

    <ul class="treeview-menu">
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <?php echo $page->render(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li>
<?php else: ?>
<li <?php echo $attributes; ?>>
    <a href="<?php echo e($url); ?>">
        <?php echo $icon; ?>

        <span><?php echo $title; ?></span>

        <?php if($badges->count() > 0): ?>
        <span class="pull-right-container">
            <span class="sidebar-page-badges">
            <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $badge->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span>
        </span>    
        <?php endif; ?>
    </a>
</li>
<?php endif; ?>
