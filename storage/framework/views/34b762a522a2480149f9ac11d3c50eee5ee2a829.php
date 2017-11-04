<div class="form-group form-element-text <?php echo e($errors->has($name) ? 'has-error' : ''); ?>">
	<label for="<?php echo e($name); ?>" class="control-label">
		<?php echo e($label); ?>


		<?php if($required): ?>
			<span class="form-element-required">*</span>
		<?php endif; ?>
	</label>
	<input <?php echo $attributes; ?> value="<?php echo e($value); ?>"
		   <?php if($readonly): ?> readonly <?php endif; ?>
	>

	<?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.helptext'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>