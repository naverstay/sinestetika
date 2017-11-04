<div role="tabpanel" class="nav-tabs-custom ">
	<ul class="nav nav-tabs" role="tablist">
	<?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo $tab->render(); ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
	<div class="tab-content">
	<?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div role="tabpanel" class="tab-pane <?php echo ($tab->isActive()) ? 'in active' : ''; ?>" id="<?php echo e($tab->getName()); ?>">
			<?php echo $tab->addTabElement()->getContent()->render(); ?>

		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>