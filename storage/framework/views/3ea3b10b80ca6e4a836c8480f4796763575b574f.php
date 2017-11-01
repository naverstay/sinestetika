<?php if( ! empty($title)): ?>
	<div class="row">
		<div class="col-lg-12">
			<?php echo $title; ?>

		</div>
	</div>
	<br />
<?php endif; ?>

<?php echo $__env->yieldContent('before.panel'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php if($creatable): ?>
			<a href="<?php echo e(url($createUrl)); ?>" class="btn btn-primary">
				<i class="fa fa-plus"></i> <?php echo e($newEntryButtonText); ?>

			</a>
		<?php endif; ?>

		<?php echo $__env->yieldContent('panel.buttons'); ?>

		<div class="pull-right">
			<?php echo $__env->yieldContent('panel.heading.actions'); ?>
		</div>
	</div>

	<?php echo $__env->yieldContent('panel.heading'); ?>

	<?php $__currentLoopData = $extensions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ext): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo $ext->render(); ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php echo $__env->yieldContent('panel.footer'); ?>
</div>

<?php echo $__env->yieldContent('after.panel'); ?>
