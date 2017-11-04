<?php echo $__env->yieldPushContent('block.top'); ?>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <?php echo $__env->yieldPushContent('block.top.column.left'); ?>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <?php echo $__env->yieldPushContent('block.top.column.right'); ?>
    </div>
</div>

<?php echo $__env->yieldPushContent('block.content'); ?>

<div class="row">
    <div class="col-md-8">
        <?php echo $__env->yieldPushContent('block.content.column.left'); ?>
    </div>
    <div class="col-md-4">
        <?php echo $__env->yieldPushContent('block.content.column.right'); ?>
    </div>
</div>

<?php echo $__env->yieldPushContent('block.footer'); ?>