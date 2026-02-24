<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/dropzone-master/dist/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.css">
    <!-- Bootstrap DateTimePicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request()->is('view_lead/*')): ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopPush(); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('customer_id') ? 'has-error' : ''); ?>">
            <label for="customer_id" class="control-label"><?php echo e('Customer'); ?></label>
            <select class="form-control borderRadius   select_customer  assign_lead_readonly" id="customer_id" name="customer_id" >
                <option selected disabled>Select Customer</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>" <?php if($customer->id == $leadExist->customer_id): ?> selected <?php endif; ?> data-customer-id="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>" <?php if(isset($appointment) && $customer->id == $appointment->customer_id): ?> selected <?php endif; ?>><?php echo e($customer->name??""); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <?php echo $errors->first('customer_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
            <label for="title" class="control-label"><?php echo e('Title'); ?><span class="text-danger">*</span></label>
            <input class="form-control" name="title" type="text" id="title" placeholder="Enter Title" value="<?php echo e($appointment->title??''); ?>" required>
            <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>

    <div class="col-md-6" >
        <div class="form-group <?php echo e($errors->has('appointment_for_lead_id') ? 'has-error' : ''); ?>">
            <label for="appointment_for_lead_id" class="control-label"><?php echo e('Appointment For'); ?></label>
            <select class="appointment_for_lead_id form-control borderRadius  assign_lead_readonly  <?php if(empty($leadExist)): ?> add_appointment_select_modal <?php endif; ?>" id="appointment_for_lead_id" name="appointment_for_lead_id">
                <option value=""></option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php if(isset($leadExist) && $lead->id == $leadExist->id): ?> selected <?php endif; ?> data-lead-id="<?php echo e($lead->id); ?>"><?php echo e($lead->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php if(isset($appointment) && $lead->id == $appointment->assign_to_lead_id): ?> selected <?php endif; ?> data-lead-id="<?php echo e($lead->id); ?>"><?php echo e($lead->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <?php echo $errors->first('appointment_for_lead_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('attendees_user_id') ? 'has-error' : ''); ?>lead_attendees_user">
            <label for="attendees_user_id" class="control-label"><?php echo e('Attendees User'); ?><span class="text-danger">*</span></label>
            
            <select class="form-control borderRadius add_appointment_select_modal custom_modal_select2 attendees_user_id" multiple id="" name="attendees_user_id[]" required data-placeholder="Enter User">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $appointmentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php if(isset($appointment) && in_array($user->id, $appointment->getAppointmentAttendee->pluck('attendees_id')->toArray())): ?> selected <?php endif; ?>><?php echo e($user->name??""); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <div class="select2-choice lead_su_choice">
                <span class="select2-arrow" role="presentation"><b role="presentation"></b></span>
            </div>
            <?php echo $errors->first('attendees_user_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('assign_to_team_id') ? 'has-error' : ''); ?>">
            <label for="assign_to_lead_id" class="control-label"><?php echo e('Assign To Team '); ?> </label>
            <select class="form-control  add_appointment_select_modal borderRadius custom_modal_select2" name="assign_to_team_id" id="assign_to_lead_id"  data-placeholder="Enter Team">
                <option value=""></option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($team->id); ?>" <?php if(isset($appointment) && $team->id == $appointment->team_id): ?> selected <?php endif; ?>><?php echo e($team->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <?php echo $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('Address') ? 'has-error' : ''); ?>">
            <label for="location" class="control-label"><?php echo e('Address'); ?></label>
            <input class="form-control customer_address" placeholder="Enter address" name="location" type="text" id="appointment_address" value="<?php echo e(old('location', isset($appointment) ? $appointment->location : (isset($leadExist) ? $leadExist->title : ''))); ?>" >

            <?php echo $errors->first('location', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>

    
    
    
    
    
    
    
    
    

    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('date_time_from') ? 'has-error' : ''); ?>">
            <label for="date_time_from" class="control-label"><?php echo e('Appointment Start Time'); ?><span class="text-danger">*</span></label>
            <div class="input-group date date_and_time" id="date_time_from_picker">
                <input class="form-control" name="date_time_from" type="text" id="date_time_from" value="<?php echo e($appointment->date_time_to ?? $yearEstimation->year . '-01-01'); ?>"  required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <span class="error_date_time_from" style="color: red"></span>
            <?php echo $errors->first('date_time_from', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('date_time_to') ? 'has-error' : ''); ?>">
            <label for="date_time_to" class="control-label"><?php echo e('Appointment End Time'); ?><span class="text-danger">*</span></label>
            <div class="input-group date date_and_time" id="date_time_to_picker">
                <input class="form-control" name="date_time_to" type="text" id="date_time_to" value="<?php echo e($appointment->date_time_to ?? $yearEstimation->year . '-01-01'); ?>"  required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <span class="error_date_time_to" style="color: red"></span>
            <?php echo $errors->first('date_time_to', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>

    
    
    
    
    
    
    
    



    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
            <label for="status" class="control-label"><?php echo e('Status'); ?></label>
            <select class="form-control" name="status" id="status" required>
                <option value="1" <?php if(isset($appointment) && $appointment->status == 1): ?> selected <?php endif; ?>>Active</option>
                <option value="0" <?php if(isset($appointment) && $appointment->status == 0): ?> selected <?php endif; ?>>InActive</option>
            </select>
            <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group <?php echo e($errors->has('images') ? 'has-error' : ''); ?>">
            <label for="images" class="control-label"><?php echo e('Images/Documents'); ?></label>
            <div action="#" id="apptdropzone" class="dropzone">
                <div class="fallback">
                    <input name="images" id="images" type="file" multiple accept="image/*"  />
                </div>
            </div>
        </div>
        <input type="hidden" name="appointment_attachment" id="appointment_attachment">
    </div>

    <div class="col-md-12">
        <div class="form-group error_positioned_parent_modal <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
            <label for="description" class="control-label"><?php echo e('Description'); ?></label>
            <textarea class="form-control" rows="5" name="description" id="appointmnet-description"><?php echo $appointment->description??''; ?></textarea>
            <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-0">
            <div class="d-flex justify-content-center">
                <input class="btn btn-green appointment_modal_btn" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
            </div>
        </div>
    </div>

</div>
<?php $__env->startPush('js'); ?>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('googleAPI')); ?>&libraries=places&callback=initAutocomplete" async defer></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?php echo e(asset('plugins/components/moment/moment.js')); ?>"></script>

    <!-- Bootstrap DateTimePicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>

        $(window).on("load", function() {
            const disabledDates = [];
            <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $holiday->getHoliday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            disabledDates.push('<?php echo e($h->date); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        console.log('disabledDates',disabledDates)
            function isDateDisabled(date) {
                const dateStr = moment(date).format('YYYY-MM-DD');
                return disabledDates.includes(dateStr);
            }

            let startPicker = null;
            let endPicker = null;

            function initializeDateTimePicker(selector, errorClass, isStart = true) {
                const $input = $(selector).find('input');
                const picker = $(selector).datetimepicker({
                    format: 'MM-DD-YY hh:mm A',
                    defaultDate: moment(),
                    useCurrent: true,
                    showTodayButton: true,
                    disabledDates: disabledDates,
                    useStrict: true,
                    sideBySide: true // Enable side-by-side date and time selection
                });

                // Remove custom click handler to avoid conflicts
                $input.on('click', function() {
                    picker.data('DateTimePicker').show();
                });

                picker.on('dp.change', function(e) {
                    const errorSpan = $(errorClass);
                    // const selectedDate = e.date ? moment(e.date).format('DD-MM-YYYY') : null;
                    const selectedDate = e.date ? moment(e.date).format('YYYY-MM-DD') : null;

                    if (selectedDate && disabledDates.includes(selectedDate)) {
                        errorSpan.text('This date is a holiday date.');
                        $input.val('');
                        picker.data('DateTimePicker').clear();
                    } else {
                        errorSpan.text('');
                        if (isStart && endPicker) {
                            const defaultDuration = parseInt($input.data('default-duration')) || 60;
                            const newEndDate = e.date ? moment(e.date).add(defaultDuration, 'minutes') : moment();
                            endPicker.data('DateTimePicker').date(newEndDate);
                        } else if (!isStart && startPicker && startPicker.data('DateTimePicker').date()) {
                            const startDate = startPicker.data('DateTimePicker').date();
                            if (e.date && e.date.isSameOrBefore(startDate)) {
                                errorSpan.text('End date must be after start date.');
                                $input.val('');
                                picker.data('DateTimePicker').clear();
                            }
                        }
                    }
                });

                return picker;
            }

            startPicker = initializeDateTimePicker('#date_time_from_picker', '.error_date_time_from', true);
            endPicker = initializeDateTimePicker('#date_time_to_picker', '.error_date_time_to', false);
        });


    </script>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request()->is('view_lead/*')): ?>

        <script>
            $('.select2').select2();
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <script>

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Spaces are not allowed.");
            let editor;
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector('#appointmnet-description'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            }
            $.validator.addMethod("editorRequired", function(value, element) {
                if (editor) {
                    var editorContent = editor.getData().trim();
                    return editorContent.length !== 0;
                }
                return false;
            }, "Description is required.");

            $.validator.addMethod("dateAfter", function(value, element, param) {
                var startDate = $(param).val();
                var endDate = value;
                if (startDate && endDate) {
                    return new Date(endDate) >= new Date(startDate);
                }
                return true;
            }, "End date must be greater than or equal to start date.");

        });
        function initAutocomplete() {
            google.maps.event.addDomListener(window, 'load', function () {
                var places = new google.maps.places.Autocomplete(document.getElementById('appointment_address'));
                google.maps.event.addListener(places, 'place_changed', function () {
                    var place = places.getPlace();
                    var address = place.formatted_address;
                    var latitude = place.geometry.location.lat();
                    var longitude = place.geometry.location.lng();
                    var latlng = new google.maps.LatLng(latitude, longitude);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                var address = results[0].formatted_address;
                            }
                        }
                    });
                });
            });
        }
        $(document).ready(function () {
            var sum = 0;
            var appointment_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#apptdropzone").dropzone({
                url: "<?php echo e(route('upload_appointment_attachment')); ?>",
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
                    appointment_attachment_arr = jQuery.grep(appointment_attachment_arr, function(value) {
                        return value != image_name;
                    });
                    $('#appointment_attachment').val(appointment_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "<?php echo e(route('remove_appointment_attachment')); ?>",
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
                    appointment_attachment_arr.push(response);
                    $('#appointment_attachment').val(appointment_attachment_arr);
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
            <?php if(isset($appointment->images) && $appointment->images != null): ?>
            <?php $__currentLoopData = $appointment->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
        <?php if(isset($appointment)): ?>
        leadDropdown("<?php echo e($appointment->customer_id); ?>","<?php echo e($appointment->appointment_for_lead_id); ?>");
        <?php endif; ?>
        $('#customer_id').on('change',function() {
            var id = 0;
            var customer_id = $("#customer_id").val();
            leadDropdown(customer_id,id)
        });
        function leadDropdown(customer_id,id){
            $.ajax({
                url: '<?php echo e(route('lead_dropdown')); ?>',
                type: 'GET',
                data:{
                    'id': id,
                    'customer_id': customer_id
                },
                success: function(result) {
                    $('#appointment_for_lead_id').html(result);
                },
                error:function(e){
//                alert(e.status);
                    console.log(e.status);
                }
            });
        }

        $(window).on('load',function(){
            let lead_su_choice = $('.lead_attendees_user .lead_su_choice');
            $('.lead_attendees_user > .select2-container').append('<div class="select2-choice">' +lead_su_choice.html()+ '</div>');
            setTimeout(function (){
                $(lead_su_choice).remove();
            },1000);
        });
        $(document).ready(function() {
    function fetchLeadData(leadId) {
        if (!leadId) {
            console.error("No Lead ID provided.");
            return;
        }

        $.ajax({
            url: "<?php echo e(url('lead_detail')); ?>/" + leadId,
            type: 'GET',
            success: function(result) {
                console.log(result);
                if (result.lead && result.lead.address) {
                    $('.customer_address').val(result.lead.address);
                }
            },
            error: function(xhr) {
                console.error("Error: " + xhr.status + " - " + xhr.responseText);
            }
        });
    }

    var initialLeadId = $('.appointment_for_lead_id').find(":selected").data('lead-id');
    if (initialLeadId) {
        fetchLeadData(initialLeadId);
    }
});

    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/appointment/appointment/form.blade.php ENDPATH**/ ?>