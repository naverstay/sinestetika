<div class="form-group form-element-multiselect <?php echo e($errors->has($name) ? 'has-error' : ''); ?>">
    <label for="<?php echo e($name); ?>" class="control-label">
        <?php echo e($label); ?>


        <?php if($required): ?>
            <span class="form-element-required">*</span>
        <?php endif; ?>
    </label>

    <deselect :value="<?php echo e(json_encode($value)); ?>"
              :id="'<?php echo e(str_replace(['[', ']'], '', $name)); ?>'"
              :multiple="true" :options="<?php echo e(json_encode($options)); ?>" inline-template>
        <div>
            <multiselect v-model="val"
                         track-by="id"
                         label="text"
                         :multiple="multiple"
                         <?php if($limit): ?>
                         :limit="<?php echo $limit; ?>"
                         <?php endif; ?>
                         :searchable="true"
                         :options="options"
                         placeholder="<?php echo e(trans('sleeping_owl::lang.select.placeholder')); ?>"
                         :select-label="'<?php echo e(trans('sleeping_owl::lang.select.init')); ?>'"
                         :selected-label="'<?php echo e(trans('sleeping_owl::lang.select.selected')); ?>'"
                         :deselect-label="'<?php echo e(trans('sleeping_owl::lang.select.deselect')); ?>'"
            >
            </multiselect>

            <select v-show="true == false" id="<?php echo e(str_replace(['[', ']'], '', $name)); ?>" multiple name="<?php echo e($name); ?>">

                <option :selected="hasOption(opt.id)" :value="opt.id"
                        v-for="opt in options">
                    {{ opt.text }}
                </option>
            </select>
        </div>
    </deselect>

    <?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.helptext'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make(AdminTemplate::getViewPath('form.element.partials.errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>