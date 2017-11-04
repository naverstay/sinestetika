<?php $__env->startPush('footer-scripts'); ?>
<script>
    Admin.WYSIWYG.switchOn('<?php echo e($name); ?>', '<?php echo e($editor); ?>', <?php echo $parameters; ?>)
</script>
<?php $__env->stopPush(); ?>

<div class="form-group form-element-wysiwyg <?php echo e($errors->has($name) ? 'has-error' : ''); ?>">
    <label for="<?php echo e($name); ?>" class="control-label">
        <?php echo e($label); ?>


        <?php if($required): ?>
            <span class="form-element-required">*</span>
        <?php endif; ?>
    </label>

    <?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.helptext'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo Form::textarea($name, $value, $attributes); ?>


    <?php echo $__env->make(app('sleeping_owl.template')->getViewPath('form.element.partials.errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
