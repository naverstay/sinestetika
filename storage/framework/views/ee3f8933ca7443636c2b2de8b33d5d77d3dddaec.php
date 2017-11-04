<?php if(!empty($filter_title)): ?>
    <h4 class="page-title">
        <?php echo e($filter_title); ?>:
<?php endif; ?>

<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <small class="label label-default">
        <?php echo e($filter->getTitle()); ?>


        <a href="<?php echo e(URL::current()); ?>?<?php echo http_build_query(request()->except($filter->getName())); ?>">
            <span aria-hidden="true">&times;</span>
        </a>
    </small>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(!empty($filter_title)): ?>
    </h4>
<?php endif; ?>