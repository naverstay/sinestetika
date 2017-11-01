<div class="b-projects">
    <div class="row">
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-xs-12">
                <a href="<?php echo e(route('project', $p->name)); ?>" class="b-project h-floating">
                    <div class="b-project-container" style="background-image: url('<?php echo e(asset($p->photo_m)); ?>')">
                        <div class="b-project-info">
                            <div class="b-project-info-container">
                                <h3 class="b-project-caption"><span><?php echo e($p->caption); ?></span></h3>
                                <div class="b-project-descr"><?php echo $p->short_descr; ?></div>
                                <div class="b-project-tags">
                                    <?php echo e($p->tags->implode('caption', ' / ')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>