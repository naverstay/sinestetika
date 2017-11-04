<div class="form-group form-element-images <?php echo e($errors->has($name) ? 'has-error' : ''); ?>">
	<label for="<?php echo e($name); ?>" class="control-label">
		<?php echo e($label); ?>


		<?php if($required): ?>
			<span class="form-element-required">*</span>
		<?php endif; ?>
	</label>

	<?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.helptext'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<element-images
			url="<?php echo e(route('admin.form.element.image', [
				'adminModel' => AdminSection::getModel($model)->getAlias(),
				'field' => $path,
				'id' => $model->getKey()
			])); ?>"
			:values="<?php echo e(json_encode($value)); ?>"
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

			<div class="form-element-files dropzone clearfix">
				<div class="form-element-files__item" v-for="(uri, index) in vals">
					<a :href="image(uri)" class="form-element-files__image" data-toggle="images">
						<img :src="image(uri)"/>
					</a>
					<div class="form-element-files__info">
						<a :href="image(uri)" class="btn btn-default btn-xs pull-right">
							<i class="fa fa-cloud-download"></i>
						</a>

						<button type="button" @click.prevent="remove(index)" v-if="!readonly" class="btn btn-danger btn-xs"
								aria-label="<?php echo e(trans('sleeping_owl::lang.image.remove')); ?>">
							<i class="fa fa-times"></i>
						</button>
					</div>
				</div>
			</div>

			<div v-if="!readonly">
				<br/>
				<div class="btn btn-primary upload-button">
					<i :class="uploadClass"></i> <?php echo e(trans('sleeping_owl::lang.image.browse')); ?>

				</div>
			</div>

			<input :name="name" type="hidden" :value="serializedValues">
		</div>
	</element-images>

	<div class="errors">
		<?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>