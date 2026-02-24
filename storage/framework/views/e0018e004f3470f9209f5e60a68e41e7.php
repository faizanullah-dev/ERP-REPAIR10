<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/dropzone-master/dist/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group <?php echo e($errors->has('lead_id') ? 'has-error' : ''); ?>">
            <label for="lead_id" class="col-md-4 control-label"><?php echo e('Lead'); ?></label>
            <select class="form-control  borderRadius assign_lead_readonly" name="lead_id" required>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php if(isset($leadExist) && $lead->id == $leadExist->id): ?> selected <?php endif; ?>><?php echo e($lead->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php if(isset($estimate) && $lead->id == $estimate->lead_id): ?> selected <?php endif; ?>><?php echo e($lead->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <?php echo $errors->first('lead_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group <?php echo e($errors->has('images') ? 'has-error' : ''); ?>">
            <label for="images" class="control-label"><?php echo e('Photo And Documents'); ?> <span class="text-danger">*</span></label>
            <div action="#" id="estimatedropzone" class="dropzone">
                <div class="fallback">
                    <input name="images" id="images" type="file" multiple accept="image/*" required />
                </div>
            </div>
        </div>
        <input type="hidden" name="estimate_attachment" id="estimate_attachment">
    </div>
    <div class="col-md-12">
        <div class="form-group mb-0 d-flex justify-content-center">
            <input class="btn btn-green new_estimate_modal_btn" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
        </div>
    </div>
</div>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('plugins/components/dropzone-master/dist/dropzone.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var sum = 0;
            var estimate_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#estimatedropzone").dropzone({
                url: "<?php echo e(route('upload_estimate_attachment')); ?>",
                addRemoveLinks: true,
                dictRemoveFileConfirmation:  "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function(file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if(id == 'undefined'){
                        id = 0;
                    }
                    console.log(image_name);
                    estimate_attachment_arr = jQuery.grep(estimate_attachment_arr, function(value) {
                        return value != image_name;
                    });
                    $('#estimate_attachment').val(estimate_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "<?php echo e(route('remove_estimate_attachment')); ?>",
                        data: {image_name:image_name,id:id},
                        async: false,
                        success: function(result) {
                            $('#product_div').html(result);
                        }
                    });
                },
                sending: function(file, xhr, formData) {
                    formData.append("_token", "<?php echo e(csrf_token()); ?>");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    estimate_attachment_arr.push(response);
                    $('#estimate_attachment').val(estimate_attachment_arr);
                    $(file._removeLink).attr('image_name',response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function() {  // start of getting existing images
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function(file){
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!","ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
            <?php if(isset($estimate->images) && $estimate->images != null): ?>
            <?php $__currentLoopData = $estimate->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            var file = {
                name: "<?php echo e(explode('.',@$attachment->name)[0]); ?>",
                size: "<?php echo e(filesize(public_path().'/website/'.@$attachment->name)); ?>",
                status: Dropzone.ADDED,
                accepted: true
            };
            dropzone.emit("addedfile", file);
            <?php if(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash'])): ?>
            dropzone.emit("thumbnail", file, "<?php echo e(asset('/website').'/'.$attachment->name); ?>");
            <?php elseif(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['pdf'])): ?>
            dropzone.emit("thumbnail", file, "<?php echo e(asset('/website/images').'/pdf.png'); ?>");
            <?php elseif(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['doc','docx'])): ?>
            dropzone.emit("thumbnail", file, "<?php echo e(asset('/website/images').'/Word-Logo.png'); ?>");
            <?php else: ?>
            dropzone.emit("thumbnail", file, "<?php echo e(asset('/website/images').'/Word-Logo.png'); ?>");
            <?php endif; ?>
            dropzone.emit("complete", file);
            $(file._removeLink).attr('id','<?php echo e($attachment->id); ?>')
            $(file._removeLink).attr('image_name','<?php echo e($attachment->name); ?>')
            dropzone.files.push(file);
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        });
    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/estimate/estimate/form.blade.php ENDPATH**/ ?>