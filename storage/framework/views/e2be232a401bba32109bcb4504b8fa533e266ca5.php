

<?php $__env->startSection('content'); ?>
    <div class="section intro-expertise">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class="text">Sinestetika — независимая междисциплинарная команда с сильной экспертизой в области брендинга, дизайна, цифровых технологий и бизнеса.</p>
                    <p class="text">Мы создаем системы визуальных и вербальных коммуникаций, необходимые для запуска и развития продуктов.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section expertise">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <h2 class="line-heading h-floating">Экспертиза</h2>
                </div>
                <div class="col-sm-8 col-xs-12 home-services">
                    <?php $__currentLoopData = $all_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row home-services-row">
                            <div class="col-sm-4 col-xs-12 home-services-caption h-floating">
                                <a href="<?php echo e(route('service', $s->name)); ?>">
                                    <?php echo e(($s->main_caption ? $s->main_caption : $s->caption)); ?>

                                    <span></span>
                                </a>
                            </div>
                            <div class="col-sm-6 col-sm-offset-2 home-services-descr hidden-xs">
                                <?php echo ($s->main_descr ? $s->main_descr : $s->short_descr); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="section service-tags">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <h4 class="service-tags-caption h-floating">Все услуги</h4>
                </div>
                <div class="col-sm-9">
                    <ul class="row service-tags-list">
                    <li class="col-xs-12 col-sm-4">
                        <?php $__currentLoopData = $service_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('service', $stg->service->name) . ($stg->section && $stg->section->tags->count()>0 ? '#'.$stg->section->tags->first()->name : '')); ?>"><?php echo e($stg->caption); ?></a>
                            <?php if($loop->iteration%4 == 0): ?>
                                </li><li class="col-xs-12 col-sm-4">
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="section projects">
        <div class="container container-fluid">
            <h2 class="line-heading h-floating">Проекты</h2>
            <?php echo $__env->make('partial.projects', ['projects'=>$projects], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div>
                <a href="<?php echo e(route('projects')); ?>" class="all-projects-link">Все проекты</a>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partial.footer.contacts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>