

<?php $__env->startSection('content'); ?>
    <div class="p-project-intro-wrapper">
        <div class="p-project-intro-bg blue-bg"></div>
        <div class="p-project-intro">
            <div class="p-project-intro-body container container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-10 col-xs-12">
                        <h1 class="p-project-title"><?php echo e($project->caption); ?></h1>
                    </div>
                </div>
            </div>
            <div class="container container-fluid hidden-xs">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                        <div class="p-project-tags b-tags">
                            <?php $__currentLoopData = $project->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="b-tags-item"><span><?php echo e($tag->caption); ?></span></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-project-photo container container-fluid">
                <img src="<?php echo e(asset($project->photo)); ?>" />
            </div>
        </div>
    </div>
        <div class="container container-fluid">
            <?php if($project->descr): ?>
                <div class="p-project-descr">
                    <?php echo $project->descr; ?>

                </div>
            <?php endif; ?>

            <div class="p-project-sections">
                <div class="row row-eq-height">
                <?php $__currentLoopData = $project->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-project-section p-project-section__<?php echo e($s->type); ?> col-xs-12 <?php echo e(($s->small_format == 1 ? 'col-sm-6' : 'col-sm-12')); ?> h-floating"
                            <?php echo ($s->clear ? ' style="clear:left"' : ''); ?>>
                        <div class="p-project-section-body">
                            <?php if($s->type == 'content'): ?>
                                <?php echo $s->content; ?>

                            <?php elseif($s->type == 'video'): ?>
                                    <video poster="<?php echo e($s->video_preview); ?>" controls="false">
                                        <source src="<?php echo e(asset($s->video)); ?>">
                                    </video>
                                    <div class="v-btn-play-big">
                                        <span class="v-btn-play"></span>
                                    </div>
                                    <div class="v-controls hidden">
                                        <div class="v-timeline"><div class="v-timeline-target"></div><div class="v-timeline-current"></div></div>
                                        <div class="v-controls-bar">
                                            <div class="v-btn-play"></div>
                                            <div class="v-volume">
                                                <?php echo e(svg_image('volume', 'v-btn-volume')); ?>
                                                <div class="v-volume-bar"><div class="v-volume-bar-target"></div><div class="v-volume-bar-current"></div></div>
                                            </div>
                                            <div class="v-time">
                                                <div class="v-time-current">0:00</div>
                                                <div class="v-time-sep">/</div>
                                                <div class="v-time-total">0:00</div>
                                            </div>
                                            <svg class="v-btn-fullscreen" version="1.1" viewBox="10 10 16 16"><g class="ytp-fullscreen-button-corner-0"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-id-49"></use><path class="ytp-svg-fill" d="m 10,16 2,0 0,-4 4,0 0,-2 L 10,10 l 0,6 0,0 z" id="ytp-id-49"></path></g><g class="ytp-fullscreen-button-corner-1"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-id-50"></use><path class="ytp-svg-fill" d="m 20,10 0,2 4,0 0,4 2,0 L 26,10 l -6,0 0,0 z" id="ytp-id-50"></path></g><g class="ytp-fullscreen-button-corner-2"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-id-51"></use><path class="ytp-svg-fill" d="m 24,24 -4,0 0,2 L 26,26 l 0,-6 -2,0 0,4 0,0 z" id="ytp-id-51"></path></g><g class="ytp-fullscreen-button-corner-3"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-id-52"></use><path class="ytp-svg-fill" d="M 12,20 10,20 10,26 l 6,0 0,-2 -4,0 0,-4 0,0 z" id="ytp-id-52"></path></g></svg>
                                        </div>
                                    </div>
                            <?php elseif($s->type == 'image'): ?>
                                <?php if(sizeof($s->images) > 1): ?>
                                    <div class="p-project-section-slider">
                                        <?php $__currentLoopData = $s->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="p-project-section-slider-item"><img data-lazy="<?php echo e(asset($img['main'])); ?>" /></div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <img src="<?php echo e(asset(@$s->images[0]['main'])); ?>" />
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>


    <div class="p-project-next">
        <div class="p-project-intro-wrapper __next">
            <div class="p-project-intro-bg blue-bg"></div>
            <div class="p-project-intro">
                <div class="p-project-intro-body container container-fluid">
                    <div class="row">
                        <div class="col-md-8 col-sm-10 col-xs-12">
                            <p class="p-project-next-title">Следующий проект</p>
                            <a class="p-project-title" href="<?php echo e(route('project', $project->name)); ?>"><?php echo e($project->caption); ?></a>
                        </div>
                    </div>
                </div>
                <div class="container container-fluid hidden-xs">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="p-project-tags b-tags">
                                <?php $__currentLoopData = $project->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="b-tags-item"><span><?php echo e($tag->caption); ?></span></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="p-project-photo container container-fluid" href="<?php echo e(route('project', $project->name)); ?>">
                    <img src="<?php echo e(asset($project->photo)); ?>" />
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>