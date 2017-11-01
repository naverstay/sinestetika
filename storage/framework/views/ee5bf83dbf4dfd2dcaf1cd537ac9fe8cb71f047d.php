<?php if($isEditable): ?>
<a href="<?php echo e($link); ?>" <?php echo e(app('html')->attributes($linkAttributes)); ?>>
    <?php echo $value; ?>

</a>
<?php else: ?>
    <?php echo $value; ?>

<?php endif; ?>
<?php echo $append; ?>