<a href="<?php echo e(url(config('sleeping_owl.url_prefix'))); ?>" class="logo">
	<span class="logo-lg"><?php echo AdminTemplate::getLogo(); ?></span>
	<span class="logo-mini"><?php echo AdminTemplate::getLogoMini(); ?></span>
</a>

<nav class="navbar navbar-static-top" role="navigation">
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
	</a>
	<div class="navbar-custom-menu">	
		<ul class="nav navbar-nav">
			<?php echo $__env->yieldPushContent('navbar'); ?>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<?php echo $__env->yieldPushContent('navbar.right'); ?>
		</ul>
	</div>
</nav>
