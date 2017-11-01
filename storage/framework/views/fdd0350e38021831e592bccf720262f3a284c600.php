

<?php $__env->startSection('content'); ?>
    <div class="p-projects">
        <div class="p-projects-intro blue-bg">
            <div class="container container-fluid">
                <p>Преодолеваем разрыв между стратегией и воплощением благодаря комплексным решениям</p>
            </div>
        </div>
        <div class="container container-fluid">
            <div class="p-projects-filter hidden-xs">
                <ul class="p-projects-filter-groups collapse-xs">
                    <li class="__all __mobile">
                        <a href="javascript:void(0)">
                            <?php echo e((sizeof($selected_groups) > 0
                                    ?
                                        (sizeof($selected_groups) == 1 ? 'выбрана' : 'выбрано') . ' ' . sizeof($selected_groups) . ' ' .
                                        \Lang::choice('услуга|услуги|услуг', sizeof($selected_groups), [], 'ru')
                                    :
                                        'ничего не выбрано'
                                )); ?>

                        </a>
                    </li>
                    <li class="__all<?php echo e((sizeof($selected_groups) <= 0 ? ' active' : '')); ?>"><a href="<?php echo e(route('projects')); ?>">Показать все</a></li>

                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e(($gr->active ? 'active' : '')); ?>"><a href="<?php echo e($gr->href); ?>"><?php echo e($gr->caption); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <?php echo $__env->make('partial.projects', ['projects'=>$projects], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>