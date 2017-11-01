<div class="form-group form-element-upload <?php echo e($errors->has($name) ? 'has-error' : ''); ?> well">
    <label for="<?php echo e($name); ?>" class="control-label">
        <?php echo e($label); ?>


        <?php if($required): ?>
            <span class="form-element-required">*</span>
        <?php endif; ?>
    </label>

    <?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.helptext'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php if(! $readonly): ?>
        <?php echo Form::file($name, ['id' => $name]); ?>

    <?php endif; ?>

    <?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php if(!empty($value) && !$readonly): ?>
        <div class="checkbox">
            <label><?php echo Form::checkbox("{$name}_remove"); ?> <?php echo app('translator')->getFromJson('sleeping_owl::lang.file.remove'); ?></label>
        </div>
        <div>
            <video width="400" controls="controls" poster="<?php echo e(asset(mb_substr($value, 0, mb_strrpos($value, '.')+1 ) . 'jpg')); ?>" >
                <source src="<?php echo e(asset($value)); ?>">
            </video>
        </div>
    <?php endif; ?>
</div>