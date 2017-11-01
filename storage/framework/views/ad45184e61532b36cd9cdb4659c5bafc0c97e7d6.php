

<?php $__env->startSection('footer'); ?>
    <div class="footer-services">
        <div class="row">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-1 col-xs-offset-0">
                    <a href="<?php echo e(route('service', $s->name)); ?>"><?php echo e($s->main_caption); ?></a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="footer-to-main">
                <a href="<?php echo e(route('home')); ?>">На главную</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partial.footer._blank', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>