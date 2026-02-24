<div class="row">
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('lead_id') ? 'has-error' : ''); ?>">
            <label for="lead_id" class="col-md-4 control-label"><?php echo e('Lead'); ?></label>
            <select class="form-control   borderRadius assign_lead_readonly" name="lead_id" id="lead_id" required>
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
        <div class="form-group <?php echo e($errors->has('follow_up_reminder') ? 'has-error' : ''); ?>">
            <label for="follow_up_reminder" class="col-md-4 control-label"><?php echo e('Follow Up Reminder'); ?> <span class="text-danger">*</span></label>
            <input class="form-control" name="follow_up_reminder" type="date" id="follow_up_reminder" value="<?php echo e($followupcallnote->follow_up_reminder ?? $yearEstimation->year . '-01-01'); ?>">
            <?php echo $errors->first('follow_up_reminder', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('assign_to_user_id') ? 'has-error' : ''); ?>">
            <label for="assign_to_user_id" class="col-md-4 control-label"><?php echo e('Assign To User'); ?></label>
            
            <select class="form-control  borderRadius custom_modal_select2" multiple name="user_id[]" id="user_id" required data-placeholder="Select an Option">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php if(isset($followupcallnote) && in_array($user->id, $followupcallnote->getFollowUpCallNoteUser->pluck('user_id')->toArray())): ?> selected <?php endif; ?>> <?php echo e($user->name??""); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <?php echo $errors->first('assign_to_user_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group follow_up_notes_mark_wrap <?php echo e($errors->has('mark_id') ? 'has-error' : ''); ?>">
            <label for="mark_id" class="col-md-4 control-label"><?php echo e('Mark'); ?> <span class="text-danger">*</span></label>
            <div class="form-check form-check-inline follow_up_notes_mark_input_wrap">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $marks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input class="mx-3" type="radio" name="mark_id" id="mark<?php echo e($key); ?>" value="<?php echo e($mark->id); ?>" <?php if((!old('mark_id') && isset($followupcallnote) && $followupcallnote->mark_id == $mark->id) || (old('mark_id') == $mark->id)): ?> checked <?php endif; ?> required>
                    <label class="form-check-label fs-4" for="mark<?php echo e($key); ?>"><?php echo e($mark->name); ?></label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php echo $errors->first('mark_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
            <label for="description" class="col-md-4 control-label"><?php echo e('Description'); ?></label>
            <textarea class="form-control" rows="5" name="description" type="textarea" id="description"><?php echo e($followupcallnote->description??''); ?></textarea>
            <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-0 d-flex justify-content-center">
            <input class="btn btn-green" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
        </div>
    </div>
</div>
<?php $__env->startPush('js'); ?>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Spaces are not allowed.");
            $.validator.addMethod("select2Required", function(value, element, params) {
                return $(element).val() ? true : false;
            }, "This field is required");
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "Message field is required");
            $("#followupcallnoteForm").validate({
                ignore: ":hidden:not(.select2-hidden-accessible)",
                rules: {
                    lead_id: {
                        required: true,
                        noSpace: true
                    },
                    follow_up_reminder: {
                        required: true,
                        noSpace: true
                    },
                    'user_id[]': {
                        select2Required: true
                    },
                    mark_id: {
                        required: true,
                        noSpace: true
                    },
                    description: {
                        ckrequired: true
                    }
                },

                messages: {
                    lead_id: {
                        required: "Please select lead",
                    },
                    follow_up_reminder: {
                        required: "Please select follow up reminder",
                    },
                    'user_id[]': {
                        select2Required: "Please select assign to user",
                    },
                    mark_id: {
                        required: "Please select mark",
                    },
                    description: {
                        ckrequired: "Message field is required"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass("select2-hidden-accessible")) {
                        error.insertAfter(element.next('span.select2'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });


        // $(document).ready(function () {
        //     CKEDITOR.replace('description');
        //     $(".select2").select2();
        // });
        $(document).ready(function() {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/followUpCallNote/follow-up-call-note/form.blade.php ENDPATH**/ ?>