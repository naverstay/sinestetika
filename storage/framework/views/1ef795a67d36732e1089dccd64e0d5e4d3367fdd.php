<!--link href="<?php echo e(asset('css/site/fonts/BrutalType.css')); ?>" rel="stylesheet"-->
<?php if(in_array(\Route::currentRouteName(), ['project'])): ?>
    <!--link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet"-->
<?php endif; ?>
<!--link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet"-->

<link href="<?php echo e(asset('css/site.min.css')); ?>?t=<?php echo e(time()); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/site/style.css')); ?>?t=<?php echo e(time()); ?>" rel="stylesheet">