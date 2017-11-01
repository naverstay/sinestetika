<section class="sidebar">

	<?php echo $__env->yieldPushContent('sidebar.top'); ?>

	<ul class="sidebar-menu">
		<?php echo $__env->yieldPushContent('sidebar.ul.top'); ?>

		<?php echo $template->renderNavigation(); ?>


		<?php echo $__env->yieldPushContent('sidebar.ul.bottom'); ?>
	</ul>

	<?php echo $__env->yieldPushContent('sidebar.bottom'); ?>
</section>