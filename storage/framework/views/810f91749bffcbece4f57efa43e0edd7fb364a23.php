<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index, follow" />
    <meta name="name" content="Брендинговое агентство Sinestetika"/>
    <meta name="description" content="Создаем системы визуальных и вербальных коммуникаций, необходимые для роста и развития, а также для запуска новых продуктов."/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:url" content="http://sinestetika.com" />
    <meta property="og:title" content="Брендинговое агентство Sinestetika" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta property="og:description" content="Создаем системы визуальных и вербальных коммуникаций, необходимые для роста и развития, а также для запуска новых продуктов." />
    <meta name="format-detection" content="telephone=no">

    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">

    <title><?php echo e((isset($page_title) ? 'Sinestetika - ' . $page_title : 'Брендинговое агентство Sinestetika')); ?></title>

    <?php if(!is_ajax()): ?>
        <?php echo $__env->make('partial.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
</head>
<body class="<?php echo e(\Request::route()->getName()); ?> __intro">
    <div class="s-page">
        <?php if(\Request::route()->getName() == 'home'): ?>
            <?php echo $__env->make('partial.intro', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <div class="navbar navbar-custom" role="navigation">
            <div class="container container-fluid">
                <div class="row">
                    <div class="navbar-header">
                        <a href="<?php echo e(route('home')); ?>" class="navbar-brand page-scroll">
                            <?php echo e(svg_image('logo', 'logo')); ?>
                            <span></span>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <div class="navbar-toggle">
                            <div class="navbar-toggle-icon">
                                <span></span><span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b-menu-overlay"></div>
            <div class="b-menu">
                <div class="b-menu-container">
                    <div class="b-menu-body">
                        <ul class="b-menu-list b-menu-services">
                            <?php $__currentLoopData = $all_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('service', $s->name)); ?>" class="page-scroll"><?php echo e($s->main_caption); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <ul class="b-menu-list b-menu-main">
                        <li><a href="<?php echo e(route('projects')); ?>" class="nav-experts page-scroll">Проекты</a></li>
                        <li><a href="<?php echo e(route('contacts')); ?>" class="nav-contacts page-scroll">Контакты</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php if(!is_ajax()): ?>
        <?php echo $__env->make('partial.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
</body>
</html>