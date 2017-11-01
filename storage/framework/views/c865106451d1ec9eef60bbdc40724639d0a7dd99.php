<?php if($isEditable): ?>
    <a href="#"
       class="inline-editable"
       data-name="<?php echo e($name); ?>"
       data-value="<?php echo e($value); ?>"
       data-url="<?php echo e($url); ?>"
       data-type="checklist"
       data-pk="<?php echo e($id); ?>"
       data-source="{ 1 : '<?php echo e($checkedLabel); ?>' }"
       data-emptytext="<?php echo e($uncheckedLabel); ?>"
    ></a>

<?php else: ?>
    <?php if($value): ?> <?php echo e($checkedLabel); ?> <?php else: ?> <?php echo e($uncheckedLabel); ?> <?php endif; ?>
<?php endif; ?>

<?php echo $append; ?>

