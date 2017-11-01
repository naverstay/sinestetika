<?php if($movableUp): ?>
	<form action="<?php echo e($moveUpUrl); ?>" method="POST" style="display:inline-block;">
		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
		<button class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo e(trans('sleeping_owl::lang.table.moveUp')); ?>">
			&uarr;
		</button>
	</form>
<?php endif; ?>
<?php if($movableDown): ?>
	<form action="<?php echo e($moveDownUrl); ?>" method="POST" style="display:inline-block;">
		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
		<button class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo e(trans('sleeping_owl::lang.table.moveDown')); ?>">
			&darr;
		</button>
	</form>
<?php endif; ?>