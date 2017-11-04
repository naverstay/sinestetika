

<?php $__env->startSection('content'); ?>
        <div class="p-service-intro blue-bg">
            <div class="p-service-intro-body container container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-10 col-xs-12">
                        <h1 class="p-service-title"><?php echo $service->html_caption; ?></h1>
                    </div>
                </div>
            </div>
            <div class="container container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="p-service-tags b-tags">
                            <?php $__currentLoopData = $service->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $section->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="#<?php echo e($tag->name); ?>" class="b-tags-item"><span><?php echo e($tag->caption); ?></span></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)" class="intro-arrow hidden-xs"><span></span></a>
        </div>
        <div class="container container-fluid">
            <?php if($service->descr): ?>
                <div class="p-service-descr">
                    <?php echo $service->descr; ?>

                </div>
            <?php endif; ?>

            <div class="p-service-sections <?php echo e(($service->sections->count() == 1 ? '__single' : '')); ?>">
                <?php $__currentLoopData = $service->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-service-section" <?php echo ($section->tags->count() ? 'id="' . $section->tags->first()->name . '"' : ''); ?>>
                        <h2 class="p-service-section-title h-floating"><?php echo e($section->caption); ?></h2>
                        <div class="p-service-section-content">
                            <?php echo $section->descr; ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($projects->count()): ?>
                <div class="p-service-projects">
                    <h2 class="line-heading h-floating">Проекты</h2>

                    <?php echo $__env->make('partial.projects', ['projects'=>$projects], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php echo $__env->make('partial.footer.services', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>