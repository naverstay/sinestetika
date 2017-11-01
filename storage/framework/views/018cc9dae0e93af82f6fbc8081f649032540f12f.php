<?php $__env->startPush('footer-scripts'); ?>
<script type="text/javascript">
$(function() {
    function toggleDataInput(value) {
        var type = $(':input[name=type]').val();

        // vue hack
        if(value && typeof value == 'object' && 'id' in value) {
            type = value.id;
        }

        var elements = {
            'image': $(':input[name=image]').parents('.form-element-images'),
            'video': $(':input[name=video]').parents('.form-element-upload'),
            'content': $(':input[name=content]').parents('.form-element-wysiwyg')
        };

        for(var k in elements) {
            if(k == type) {
                elements[k].show();
            } else {
                elements[k].hide();
            }
        }
    }

    $(':input[name=type]').parent()[0].__vue__.$children[0].$on('input', toggleDataInput);
    //$(document).on('change', ':input[name=type]', toggleDataInput);
    toggleDataInput();
})
</script>
<?php $__env->stopPush(); ?>