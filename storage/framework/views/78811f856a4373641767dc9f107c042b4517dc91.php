<div class="form-group form-element-image <?php echo e($errors->has($name) ? 'has-error' : ''); ?>">
	<label for="<?php echo e($name); ?>" class="control-label">
		<?php echo e($label); ?>


		<?php if($required): ?>
			<span class="form-element-required">*</span>
		<?php endif; ?>
	</label>

	<?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.helptext'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<element-image
			url="<?php echo e(route('admin.form.element.image', [
				'adminModel' => AdminSection::getModel($model)->getAlias(),
				'field' => $path,
				'id' => $model->getKey()
			])); ?>"
			value="<?php echo e($value); ?>"
			:readonly="<?php echo e($readonly ? 'true' : 'false'); ?>"
			name="<?php echo e($name); ?>"
			inline-template
	>
		<div>
			<div v-if="errors.length" class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="closeAlert()">
					<span aria-hidden="true">&times;</span>
				</button>

				<p v-for="error in errors"><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{ error }}</p>
			</div>
			<div class="form-element-files clearfix" v-if="has_value">
				<div class="form-element-files__item">
					<a :href="image" class="form-element-files__image" data-toggle="lightbox">
						<img :src="image" />
					</a>
					<div class="form-element-files__info">
						<a :href="image" class="btn btn-default btn-xs pull-right">
							<i class="fa fa-cloud-download"></i>
						</a>

						<button type="button" v-if="has_value && !readonly" class="btn btn-danger btn-xs" @click.prevent="remove()">
							<i class="fa fa-times"></i> <?php echo e(trans('sleeping_owl::lang.image.remove')); ?>

						</button>
					</div>
				</div>
			</div>

			<div v-if="!readonly">
				<div class="btn btn-primary upload-button">
					<i :class="uploadClass"></i> <?php echo e(trans('sleeping_owl::lang.image.browse')); ?>

				</div>

			</div>

			<input :name="name" type="hidden" :value="val">
		</div>
	</element-image>


	<div class="errors">
		<?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>
