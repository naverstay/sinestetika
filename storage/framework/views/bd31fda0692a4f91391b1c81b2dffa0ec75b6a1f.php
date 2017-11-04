<div <?php echo $attributes; ?>>
    <?php echo $__env->make(AdminTemplate::getViewPath('form.partials.elements'), ['items' => $elements], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>