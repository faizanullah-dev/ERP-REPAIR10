<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('plugins/components/dropzone-master/dist/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('assign_to_lead_id') ? 'has-error' : ''); ?>">
            <label for="assign_to_lead_id" class="col-md-4 control-label"><?php echo e('Assign To Lead '); ?></label>
            <select class="form-control   borderRadius assign_lead_readonly" name="lead_id" id="" required >
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php if(isset($leadExist) && $lead->id == $leadExist->id): ?> selected <?php endif; ?>><?php echo e($lead->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php if(isset($task) && $lead->id == $task->assign_to_lead_id): ?> selected <?php endif; ?>><?php echo e($lead->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <?php echo $errors->first('lead_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
            <label for="status" class="col-md-4 control-label"><?php echo e('Status'); ?></label>
            <select class="form-control borderRadius" name="status" id="status" required>
                <option value="1" <?php if(isset($jobnote) && $jobnote->status == 1): ?> selected <?php endif; ?>>Active</option>
                <option value="0" <?php if(isset($jobnote) && $jobnote->status == 0): ?> selected <?php endif; ?>>InActive</option>
            </select>
            <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group <?php echo e($errors->has('images') ? 'has-error' : ''); ?>">
            <label for="images" class="control-label"><?php echo e('Images'); ?><span class="text-danger">*</span></label>
            <div action="#" id="jobNotedropzone" class="dropzone brpzone_padBottom">
                <div class="fallback">
                    <input name="images" id="images" type="file" multiple accept="image/*" required />
                </div>
            </div>
        </div>
        <input type="hidden" name="job_note_attachment" id="job_note_attachment">
    </div>
    <div class="col-md-12">
        <div class="form-group error_positioned_parent <?php echo e($errors->has('description') ? 'has-error' : ''); ?> mb-0">
            <label for="description" class="col-md-12 control-label"><?php echo e('Description'); ?> <span class="text-danger">*</span></label>
            <textarea class="form-control" rows="5" name="description" type="textarea" id="jobnotedescription" required><?php echo $jobnote->description ?? ''; ?> </textarea>
            <p class="help-block text-danger" id="description-error"></p>
            <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <textarea name="description" id="jobnotedescription-modal" style="display: none"></textarea>

    <div class="col-md-12">
        <div class="d-flex justify-content-center">
            <input class="btn btn-green add_task_modal_btn job_note_submit_btn m-0" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
        </div>
    </div>

</div>
<?php $__env->startPush('js'); ?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


<script type="text/javascript">
//     $(document).ready(function() {
//         // CKEDITOR.replace('jobnotedescription');
//         $(document).ready(function() {
//             ClassicEditor
//                 .create(document.querySelector('#jobnotedescription'))
//                 .catch(error => {
//                     console.error(error);
//                 });
//         });
// });
</script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length !== 0;
        }, "Spaces are not allowed.");
        let editor;
        if (typeof ClassicEditor !== "undefined") {
            ClassicEditor
                .create(document.querySelector('#jobnotedescription'))
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
        } else {
            console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
        }
        $.validator.addMethod("descriptionRequired", function(value, element) {
            if (editor) {
                var editorContent = editor.getData().trim();
                return editorContent.length !== 0;
            }
            return false;
        }, "Description is required.");
        $('#JobNote-form').validate({
            ignore: [],
            rules: {
                lead_id: {
                    required: true
                },
                description: {
                    descriptionRequired: true
                }
            },
            messages: {
                lead_id: {
                    required: "Please Assign Lead."
                },
                description: {
                    descriptionRequired: "Message field is required."
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "description") {
                    error.appendTo("#description-error");
                }
            },
            submitHandler: function(form) {
                const editorData = editor.getData().trim();
                if (editorData) {
                    $('textarea[name="description"]').val(editorData);
                }
                form.submit();
            }
        });
    });

    $(document).ready(function () {
        var sum = 0;
        var job_note_attachment_arr = [];
        Dropzone.autoDiscover = false;
        $("#jobNotedropzone").dropzone({
            url: "<?php echo e(route('upload_job_note_attachment')); ?>",
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
                job_note_attachment_arr = jQuery.grep(job_note_attachment_arr, function(value) {
                    return value != image_name;
                });
                $('#job_note_attachment').val(job_note_attachment_arr);
                file.previewElement.remove();
                $.ajax({
                    type: 'get',
                    url: "<?php echo e(route('remove_job_note_attachment')); ?>",
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
                job_note_attachment_arr.push(response);
                $('#job_note_attachment').val(job_note_attachment_arr);
                $(file._removeLink).attr('image_name',response)
            },
            error: function (file, response) {
                file.previewElement.classList.add("dz-error");
            },
            init: function() {  // start of getting existing imahes
                dropzone = this;
                //customize by unaiz dont remove
                this.on("maxfilesexceeded", function(file){
                    this.removeFile(file);
                    swal.fire("File Limit exceeded!","ERROR");
                });
                //customize by unaiz dont remove
            }
        });
                <?php if(isset($jobnote->images) && $jobnote->images != null): ?>
                <?php $__currentLoopData = $jobnote->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    var file = {
                            name: "<?php echo e(explode('.',$attachment->name)[1]); ?>",
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

    // Submit form from modal
    $(document).on('click', '.job_note_submit_btn', function (e) {
        e.preventDefault();
        if ($('#JobNote-form').valid()) {
            $('#JobNote-form').submit();
        } else {
            $('html, body').animate({
                scrollTop: $(".error:visible:first").offset().top - 100
            }, 500);
        }
    });

</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/jobNote/job-note/form.blade.php ENDPATH**/ ?>