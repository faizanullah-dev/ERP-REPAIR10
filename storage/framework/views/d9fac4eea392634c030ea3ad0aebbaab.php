
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/calendar/dist/fullcalendar.css')); ?>" rel="stylesheet" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Bootstrap DateTimePicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

    <style>
        .event-images img {width: 100%; height: 100%;}
        #wrapper .page-wrapper { padding-bottom : 0; }
        #calendar .fc-view-container .fc-body .fc-row { min-height: 100px;     height: fit-content !important;}
        .calender .inner:is(.full_calendar) { /* max-height: calc(100vh - 288px); */max-height: unset;}
        /*.calender .inner:is(.full_calendar):has(.fc-agendaDay-view) { overflow-y: hidden; }*/
        #calendar .fc-view-container .fc-body .fc-day-grid-container { max-height: fit-content; }
        .white-box {margin: 5px 10px;}
        .calendar_section {margin: 0;margin-bottom: 20px;}
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="white-box">
        <div class="row calendar_section">
            <div class="col-md-12 ps-0 px-0">
                <div class="calendar_fields d-flex flex-wrap align-items-end justify-content-between">
                    <h3 class="box-title"> Staff Calendar </h3>
                    <form method="get" action="<?php echo e(url('calendar_appointment_view')); ?>" style="width: calc(100% - 440px);" id="filter-form">
                        <div class="filter_inputs_btns_wrapper form-group">
                            <input type="hidden" name="appointment_filter" value="yes">
                            <div class="filter_inputs_parent lead-clndr-view">
                                
                                <select class="form-control select2" data-placeholder="Select User" id="" name="user_id[]" multiple>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>" <?php echo e((in_array($user->id, (array) request('user_id'))) ? 'selected' : ''); ?>><?php echo e($user->name??""); ?> - (<?php echo e($user->email??""); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                            <div class=" filter_inputs_parent">
                                
                                <select class="form-control select2" data-placeholder="Select Category" id="" name="category_id">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e((request('category_id') == $category->id) ? 'selected' : ''); ?>>
                                            <?php echo e($category->name ?? ""); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>

                            </div>
                            <div class="filter_inputs_parent filter_btns_parent">
                                <div class="reset_apply_btn">
                                    <button type="submit" class="btn blue_btn " onclick="this.disabled = true; this.form.submit();">Apply <i class="fa-solid fa-check"></i></button>
                                    <a href="<?php echo e(url('calendar_appointment_view')); ?>" class="btn gray_btn ">Reset <img class="img-fluid" src="<?php echo e(asset('/website/images').'/recycle.svg'); ?> " ></a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <a class="btn blue_btn add_appointment_modal_btn" style="background: #2C3146;" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">Add Appointment<i class="icon-plus"></i></a>
                    
                </div>
            </div>
        </div>
        <section class="calender">
            <div class="position-relative">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('appointment_calender_type') == 'pending'): ?>
                    <a class="btn green_btn text-dark" href="<?php echo e(url('appointment/appointment?appointment_type=pending')); ?>"><i class="icon-plus"></i> View List</a>
                <?php elseif(request('appointment_calender_type') == 'won'): ?>
                    <a class="btn green_btn text-dark" href="<?php echo e(url('appointment/appointment?appointment_type=won')); ?>"><i class="icon-plus"></i> View List</a>
                <?php elseif(request('appointment_calender_type') == 'lost'): ?>
                    <a class="btn green_btn text-dark" href="<?php echo e(url('appointment/appointment?appointment_type=lost')); ?>"><i class="icon-plus"></i> View List</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="clearfix"></div>
                <div class="container-fluid d-block">
                    <div class="row">
                        <div class="col-md-12 p-2">
                            <div class="inner full_calendar">
                                <div id="calendar"></div>
                                
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content event_modal_content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i>
                    </button>
                </div>
                <div class="modal-body event_modal_body ">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addAppointmentModal" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(url('/appointment/appointment')); ?>" accept-charset="UTF-8"
                          class="form-horizontal MyAppointment appointment_form" id="add_appointment_form" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input name="view_lead" value="1" type="hidden">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group <?php echo e($errors->has('customer_id') ? 'has-error' : ''); ?>">
                                    <label for="customer_id" class="control-label"><?php echo e('Customer'); ?></label>
                                    <select class="form-control  custom_modal_select2" data-placeholder="Select Customer" name="customer_id">
                                        <option value="" selected disabled>Select Customer</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php else: ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name??""); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                    <?php echo $errors->first('customer_id', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                                    <label for="title" class="control-label"><?php echo e('Title'); ?> <span style="color: red">*</span></label>
                                    <input class="form-control" name="title" type="text"  placeholder="Enter Title" value="" required>
                                    <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group <?php echo e($errors->has('appointment_for_lead_id') ? 'has-error' : ''); ?>">
                                    <label for="appointment_for_lead_id" class="control-label"><?php echo e('Appointment For'); ?></label>
                                    <select class="form-control appointment_for_lead_id custom_modal_select2 " data-placeholder="Select Appointment"  name="appointment_for_lead_id">
                                        <option value="" selected disabled>Select Appointment</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($lead->id); ?>"><?php echo e($lead->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php else: ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($lead->id); ?>"><?php echo e($lead->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </select>
                                    <?php echo $errors->first('appointment_for_lead_id', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php echo e($errors->has('attendees_user_id') ? 'has-error' : ''); ?>">
                                    <label for="attendees_user_id" class="control-label"><?php echo e('Attendees User*'); ?></label>
                                    
                                    <select class="form-control attendees_user_id custom_modal_select2" data-placeholder="Select Attendees" name="attendees_user_id[]" required>
                                        <option value="" selected disabled>Select Attendees</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $appointmentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name??""); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                    <?php echo $errors->first('attendees_user_id', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="col-md-6">
                                <div class="form-group <?php echo e($errors->has('Address') ? 'has-error' : ''); ?>">
                                    <label for="location" class="control-label"><?php echo e('Address'); ?></label>
                                    <input class="form-control" placeholder="Enter address" name="location" type="text" id="appointment_address" value="">
                                    <?php echo $errors->first('location', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group <?php echo e($errors->has('date_time_from') ? 'has-error' : ''); ?>">
                                    <label for="date_time_from" class="control-label">Appointment Start Time*</label>
                                    <div class="input-group date date_and_time" id="date_time_from_picker">
                                        <input class="form-control" name="date_time_from" type="text" id="date_time_from" value="<?php echo e($yearEstimation->year . '-01-01' ?? ''); ?>"  required>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <span class="error_date_time_from" style="color: red"></span>
                                    <?php echo $errors->first('date_time_from', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php echo e($errors->has('date_time_to') ? 'has-error' : ''); ?>">
                                    <label for="date_time_to" class="control-label">Appointment End Time*</label>
                                    <div class="input-group date date_and_time" id="date_time_to_picker">
                                        <input class="form-control" name="date_time_to" type="text" id="date_time_to" value="<?php echo e($yearEstimation->year . '-01-01' ?? ''); ?>"  required>
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
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                    <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group <?php echo e($errors->has('images') ? 'has-error' : ''); ?>">
                                    <label for="images" class="control-label"><?php echo e('Images'); ?></label>
                                    <div action="#" id="apptdropzone" class="dropzone">
                                        <div class="fallback">
                                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="appointment_attachment" id="appointment_attachment">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group error_positioned_parent_modal <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
                                    <label for="description" class="control-label"><?php echo e('Description'); ?></label>
                                    <textarea class="form-control" rows="5" name="description" type="textarea" id="description"></textarea>
                                    <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            <div class="col-md-offset-4 col-md-4">
                                <div class="form-group">
                                    <div class="d-flex justify-content-center ">
                                        <input class="btn d-block mx-auto btn-green" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="editAppointmentModal" class="modal fade" tabindex="-1" aria-labelledby="editAppointmentModal" aria-hidden="true"  ></div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    
    <script src="<?php echo e(asset('plugins/components/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/components/calendar/dist/fullcalendar.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js" defer></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Bootstrap DateTimePicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
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
        $(document).ready(function() {
            // document.querySelectorAll('#description').forEach(element => {
            //     ClassicEditor
            //         .create(element)
            //         .catch(error => {
            //             console.error(error);
            //         });
            // });
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Spaces are not allowed.");
            let editor;
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .then(newEditor => {
                        editor = newEditor;

                        editor.model.document.on('change:data', function() {
                            $('#add_appointment_form').valid();
                        });
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

            $('#add_appointment_form').validate({
                ignore: [],
                rules: {
                    // description: {
                    //     editorRequired: true
                    // },
                    // customer_id: {
                    //     required: true
                    // },
                    title: {
                        required: true,
                        noSpace: true
                    },
                    // location: {
                    //     required: true
                    // },
                    date_time_to: {
                        required: true
                    },
                    date_time_from: {
                        required: true
                    },
                    // appointment_for_lead_id: {
                    //     required: true
                    // },
                    'attendees_user_id[]': {
                        required: true
                    }
                },
                messages: {
                    // description: {
                    //     editorRequired: 'Please enter a message in the description.'
                    // },
                    // customer_id: {
                    //     required: "Please select a Customer."
                    // },
                    title: {
                        required: "Please enter a Title.",
                        noSpace: "Spaces are not allowed."
                    },
                    // location: {
                    //     required: "Please add a Location."
                    // },
                    date_time_to: {
                        required: "Please select a Date To."
                    },
                    date_time_from: {
                        required: "Please select a Date From."
                    },
                    // appointment_for_lead_id: {
                    //     required: "Please select a Lead."
                    // },
                    'attendees_user_id[]': {
                        required: "Please select Attendees."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });


        });


        // $(window).on("load", function () {
        //
        //     $('.customer_id').on('change', function () {
        //         let $select = $('.appointment_for_lead_id');
        //
        //         // Remove any selected value
        //         $select.val(null).trigger('change');
        //
        //         // Optional: Ensure placeholder is visible
        //         setTimeout(function () {
        //             $select.select2('destroy').val(null).select2();
        //         }, 10);
        //     });
        // });
        $(document).ready(function() {
            var selectedYear = <?php echo json_encode($yearEstimation->year, 15, 512) ?>;
            var currentMonth = new Date().getMonth() + 1;
            var currentMonthFormatted = currentMonth < 10 ? '0' + currentMonth : currentMonth;
            // $('#userFilter', '.select2').select2({
            // });
            $('#calendar').fullCalendar({
                <?php if(App\CommonSetting::first()->calendar == 1): ?>
                firstDay: 1,
                <?php elseif(App\CommonSetting::first()->calendar == 2): ?>
                hiddenDays: [0, 6],
                <?php elseif(App\CommonSetting::first()->calendar == 3): ?>
                firstDay: 0,
                    timeZone: 'local', 
                <?php endif; ?>
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,agendaDay,printPdfBtn',
                    },
                    editable: true,
                    eventLimit: 5,
                views: {
                    month: {
                        showNonCurrentDates: false,
                        fixedWeekCount: false
                    }
                },
                // validRange: {
                //     start: moment().startOf('month').toISOString(), // First day of the current month at 00:00:00 UTC
                //     end: moment().endOf('month').toISOString() // Last day of the current month at 23:59:59 UTC
                // },
                //
                //     customButtons: {
                //
                //     },
                defaultView: 'month',
                // defaultDate: selectedYear + '-01-01',
                defaultDate: selectedYear + '-' + currentMonthFormatted + '-01',
                events: [
                        <?php $__currentLoopData = $appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
    $startDate = \Carbon\Carbon::parse($app->date_time_from);
    $endDate = \Carbon\Carbon::parse($app->date_time_to);

    // Ensure end date is not before start date
    if ($endDate->lt($startDate)) {
        $endDate = $startDate->copy()->addHour(); // Default to 1-hour duration
    }

    // Normalize date format for FullCalendar (ISO8601)
    $startFormatted = $startDate->format('Y-m-d H:i');
    $endFormatted   = $endDate->format('Y-m-d H:i');
    ?>
                    {
                        id: '<?php echo e($app->id); ?>',
                        title2: '<?php echo e($app->title ?? ""); ?>',
                        title: '<?php echo e(@$app->location ?? ""); ?> / <?php echo e(@$app->lead->category->name ?? ""); ?> ',
                        // start: '<?php echo e(\Carbon\Carbon::parse($app->date_time_from)->format("m-d-y h:i A")); ?>',
                        // end: '<?php echo e(\Carbon\Carbon::parse($app->date_time_to)->format("m-d-y h:i A")); ?>',
//                 start: moment('<?php echo e(\Carbon\Carbon::parse($app->date_time_from)->toIso8601String()); ?>').format("MM-DD-YYYY h:mm A"),
// end: moment('<?php echo e(\Carbon\Carbon::parse($app->date_time_to)->toIso8601String()); ?>').format("MM-DD-YYYY h:mm A"),
start: '<?php echo e($startFormatted); ?>',
        end: '<?php echo e($endFormatted); ?>',
                        description: '<?php echo json_encode(@$app->description); ?>  ',
                        location: '<?php echo e(@$app->location); ?> ',
                        images: [
                            <?php $__currentLoopData = $app->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                '<?php echo e(@$item->name); ?>',
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ],
                        status: '<?php echo e($app->status == 1 ? 'Active' : 'Inactive'); ?>',
                        attendees: [
                            <?php $__currentLoopData = $app->getAppointmentAttendee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                '<?php echo e(@$item->AttendeesDetail->name); ?>',
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ].join(','),
                        color: '<?php echo e(@$app->getAppointmentAttendee[0]->AttendeesDetail->profile->colour_id ?? ""); ?>',
                        tooltip: 'Address: <?php echo e(@$app->customer->profile->address ?? "N/A"); ?>\n' +
                            'Details: <?php echo e(@$app->lead->category->name ?? "N/A"); ?>\n' +
                            'Note: <?php echo strip_tags(@$app->description); ?>',
                        lead_id: '<?php echo e($app->lead->id ?? ""); ?>',
                        leadName: '<?php echo e($app->lead->title ?? ""); ?>',
                        customerName: '<?php echo e(@$app->customer->name ?? ""); ?>',
                        jobTitle: '<?php echo e(@$app->customer->profile->job_title ?? ""); ?>',
                        completion_status: '<?php echo e(@$app->completion_status ?? ""); ?>',
                        appointment_for_lead_id: '<?php echo e(@$app->appointment_for_lead_id ?? ""); ?>',
                    }<?php if(!$loop->last): ?>,<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],

                // eventTimeFormat: {
                //     hour: '2-digit',
                //     minute: '2-digit'
                // },
                dayClick: function(date) {
                    $('#addAppointmentModal').modal('show');
                    var formattedDate = date.format('MM-DD-YYYY') + ' 00:00';
                    document.getElementsByName('date_time_from')[0].value = formattedDate;
                    document.getElementsByName('date_time_to')[0].value = formattedDate;
                },

                eventRender: function(event, element) {
                    var startTime = event.start.format('h:mm A');  // Use moment.js to format the start time
                    var endTime = event.end ? event.end.format('h:mm A') : "N/A";  // Format the end time
                    element.find('.fc-time').text(startTime);
                    if (/^#ffffff$|^rgb\s*\(\s*255\s*,\s*255\s*,\s*255\s*\)$|^rgba\s*\(\s*255\s*,\s*255\s*,\s*255\s*,\s*1\s*\)$|^hsla\s*\(\s*0\s*,\s*0\s*,\s*100\s*,\s*1\s*\)$/.test(event.color)) {
                        element.css('border-color', 'black');
                        element.addClass('white-bg-event');

                    }
                    console.log('event',event);
                    var tooltipContent =
                        '<div class="custom_tooltip_content" style="padding: 10px; background-color: rgba(0,0,0,0.7); color: #fff; border-radius: 5px; font-size: 12px;">' +
                        '<div class="tooltip_content_box">' +
                        '<div class="tooltip_left_text"><p><strong>Customer Name:</strong></p></div>' +
                        '<div class="tooltip_right_text"><p>' + event.customerName + '</p></div>' +
                        '<div class="tooltip_left_text"><p><strong>Appointment For:</strong></p></div>' +
                        '<div class="tooltip_right_text"><p>' + event.leadName + '</p></div>' +
                        '<div class="tooltip_left_text"><p><strong>Job title:</strong></p></div>' +
                        '<div class="tooltip_right_text"><p>' + event.title2 + '</p></div>' +
                        '<div class="tooltip_left_text"><p><strong>Address:</strong></p></div>' +
                        '<div class="tooltip_right_text"><p>' + event.location + '</p></div>' +
                        '</div>' +
                        '</div>';
                    var customTooltip = $('<div class="custom-tooltip"></div>').html(tooltipContent);
                    element.on('mouseenter', function() {
                        var position = element.offset(); // Get position relative to the document
                        var eventHeight = element.outerHeight(); // Get height of the event element
                        var elementWidth = element.outerWidth(); // Get width of the event element
                        var containerWidth = $('#calendar').width(); // Get the container width (calendar)
                        var containerHeight = $('#calendar').height(); // Get the container height (calendar)

                        var tooltipWidth = 300; // Adjust tooltip width to your preference
                        var tooltipHeight = 100; // Adjust tooltip height if needed
                        var offset = 10; // Space between the tooltip and the event element

                        // Calculate the tooltip position, ensuring it's within the screen/container
                        var tooltipLeft = position.left + offset;
                        var tooltipTop = position.top - eventHeight - 150; // Position above the element with an offset

                        // Check if the tooltip is going out of the container on the right side
                        if (tooltipLeft + tooltipWidth > containerWidth) {
                            tooltipLeft = containerWidth - tooltipWidth - offset; // Adjust to the left side if it's too far right
                        }

                        // Check if the tooltip is going out of the container on the bottom side
                        if (tooltipTop + tooltipHeight > containerHeight) {
                            tooltipTop = containerHeight - tooltipHeight - offset; // Adjust to the top if it's too far bottom
                        }

                        customTooltip.css({
                            'position': 'absolute',
                            'top': tooltipTop + 'px',
                            'left': tooltipLeft + 'px', // Set the calculated position
                            'z-index': '1000000',
                            'min-width': tooltipWidth + 'px',
                            'display': 'block',
                            'background-color': '#333',
                            'color': '#fff',
                            'border-radius': '5px',
                            'padding': '8px',
                            'font-size': '14px',
                            'text-align': 'left',
                            'box-shadow': '0 4px 6px rgba(0, 0, 0, 0.2)',
                        });
                        $('#calendar').append(customTooltip); // Append the tooltip to the calendar
                    }).on('mouseleave', function() {
                        // Set a 5-second delay before removing the tooltip
                        setTimeout(function() {
                            customTooltip.fadeOut(function() {
                                customTooltip.remove(); // Remove tooltip after fade out
                            });
                        }, 500);
                    });

                    // Check if the event is marked as completed and show a tick mark if true
                    if (event.completion_status === 'complete') {
                        var tickIcon = $('<i class="fa fa-check"></i>');
                        element.find('.fc-content').prepend(tickIcon);  // Prepend the tick mark to the event element
                    }

                    var deleteIcon = $('<i class="fa fa-trash  px-2 delete-icon" style="cursor:pointer;"></i>').attr('delete-task-id', event.id);
                    var editIcon = $('<i class="fa fa-edit  px-2 edit-icon edit_appointment_modal_btn" style="cursor:pointer;"></i>').attr('edit-appointment-id', event.id);
                    element.find('.fc-content').append(editIcon).append(deleteIcon);

                    editIcon.on('click', function(event) {
                        event.stopPropagation();
                        var appointment_id = $(this).attr('edit-appointment-id');
                        $.ajax({
                            url: "<?php echo e(route('edit_appointment_modal')); ?>",
                            type: 'post',
                            data: {
                                "_token": "<?php echo e(csrf_token()); ?>",
                                "appointment_id": appointment_id,
                            },
                            success: function(result) {
                                $('#editAppointmentModal').html(result);
                                $('#editAppointmentModal').modal('show');
                                $('.attendees_user_id').select2({
                                    placeholder: "Select Attendee",
                                    allowClear: true,
                                    dropdownParent: $('#editAppointmentModal')
                                });
                            },
                            error: function(e) {
                                console.log(e.status);
                            }
                        });
                    });


                    deleteIcon.on('click', function(event) {
                        event.stopPropagation();
                        var task_id = $(this).attr('delete-task-id');
                        Swal.fire({
                            title: 'Are You Sure You Want To Delete The Scheduling Task?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "<?php echo e(route('appointment_delete')); ?>",
                                    type: 'POST',
                                    data: { _token: '<?php echo e(csrf_token()); ?>', task_id: task_id },
                                    success: function(response) {
                                        if (response.status === true) {
                                            Swal.fire('Deleted!', response.message, 'success').then(function() {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire('Error!', response.message, 'error');
                                        }
                                    },
                                    error: function() {
                                        Swal.fire('Error!', 'There was an error while deleting the task.', 'error');
                                    }
                                });
                            }
                        });
                    });
                },

                eventClick: function(event, jsEvent, view) {
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = event.description;
                    var decodedDescription = tempDiv.textContent || tempDiv.innerText || '';

                    var isCompleted = event.completion_status == 'complete';
                    var completeBtnText = isCompleted ? 'Completed' : 'Mark As Complete';
                    var completeBtnDisabled = isCompleted ? 'disabled' : '';

                    console.log(event);
                    $('#eventModalLabel').text(event.title);
                    $('#eventModal .modal-body').html(
                        '<div class="staff_calendar_modal_content"><div class="row">' +
                        '<div class="col-md-6"><p> <label>Title:</label> <input type="text" name="subject" class="form-control" value="' + event.title2 +'"  id="" readonly></input></p></div>' +
                        '<div class="col-md-6"><p> <label>Lead Attendees:</label> <input type="text" name="subject" class="form-control" value="' + event.attendees +'"  id="" readonly></input></p></div>' +
                        '<div class="col-md-6"><p> <label>Status:</label> <badge class="badge badge-success pending pric_span">' + event.status + '</badge>  </p></div>' +
                        '<div class="col-md-6"><p> <label>Location:</label> <input type="text" name="subject" class="form-control" value="' + event.location +'"  id="" readonly></input> </p></div>' +
                        '<div class="col-md-12"><p> <label>Description:</label> <textarea class="form-control" rows="5" name="message" type="text" id="" readonly>' + $('<div>').text(decodedDescription).html() +'</textarea> </p></div>' +
                        '<div class="col-md-12"><p><label>Images:</label></p>' +
                        '<div class="event-images">' +
                        (event.images.length > 0 ?
                                event.images.map(function(image) {
                                    return '<div class="event-image"><a href="<?php echo e(asset('website')); ?>/' + image + '" target="_blank"><div class="file"><div class="image"><img src="<?php echo e(asset('website')); ?>/' + image + '"></div><div class="download_btn">View/Download</div></div></a></div>';
                                }).join('') :
                                'Not Available'
                        ) +
                        '</div></div>' +
                        '<div class="col-md-12"><div class="communication_btn_wrapper"><div class="calendar_communication_btns">' +
                        '<a href="javascript:void(0)" class="btn secondary_btn call_btn" data-lead-id="' + event.appointment_for_lead_id + '"><i class="fa-solid fa-phone"></i>Call</a>' +
                        '<a href="javascript:void(0)" class="btn secondary_btn sms_btn" data-appointment-id="' + event.id + '"><i class="fa-solid fa-comment"></i>SMS</a>' +
                        '<a href="javascript:void(0)" class="btn secondary_btn email_btn" data-appointment-id="' + event.id + '" data-lead-id="' + event.appointment_for_lead_id + '"><i class="fa-solid fa-envelope"></i>Email</a>' +
                        '<a href="https://www.google.com/maps?q=' + encodeURIComponent(event.location) + '" target="_blank" class="btn secondary_btn location_btn"><i class="fa-solid fa-location-dot"></i>Direction</a></div>' +
                        '<div class="view_lead_btn"><a href="<?php echo e(url('view_lead/')); ?>/' + event.lead_id + '" class="btn btn-green"><i class="fa-solid fa-user"></i>View Lead</a> ' +
                        '<button class="btn btn-green mark_complete" data-appointment-id="' + event.id + '" ' + completeBtnDisabled + '><i class="fa-solid fa-check"></i>' + completeBtnText + '</button></div></div></div></div></div>'
                    );


                    $('#eventModal .modal-body .staff_calendar_modal_content .row').append('<div class="col-md-6"><p>Start: ' + event.start.format('MMMM DD, YYYY h:mm A') + '</p></div>');
                    if (event.end) {
                        $('#eventModal .modal-body .staff_calendar_modal_content .row').append('<div class="col-md-6"><p>End: ' + event.end.format('MMMM DD, YYYY h:mm A') + '</p></div>');
                    }
                    $('#eventModal').modal('show');
                    console.log('FullCalendar initialized');
                },

                eventDrop: function(event, delta, revertFunc) {
                    $.ajax({
                        url: '<?php echo e(route("update_date_appointments")); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: event.id,
                            start: event.start.format('YYYY-MM-DD HH:mm'),
                            end: event.end ? event.end.format('YYYY-MM-DD HH:mm') : null
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Appointment Updated',
                                text: 'The appointment date has been successfully updated.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON.message || 'An error occurred.',
                            });
                            revertFunc();
                        }
                    });
                },

                eventResize: function(event, delta, revertFunc) {
                    $.ajax({
                        url: '<?php echo e(route("update_date_appointments")); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: event.id,
                            start: event.start.format('YYYY-MM-DD HH:mm'),
                            end: event.end ? event.end.format('YYYY-MM-DD HH:mm') : null
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Appointment Resized',
                                text: 'The appointment time has been successfully changed.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON.message || 'An error occurred.',
                            });
                            revertFunc();
                        }
                    });
                },
                eventAfterAllRender: function () {
                    if ($('#exportPrintBtn').length === 0) {
                        $('.fc .fc-toolbar .fc-right').append(
                            '<button id="exportPrintBtn" class="btn green_btn ml-2">Print Pdf</button>'
                        );
                    }
                }

            });

            //     $('#exportCsvBtn').click(function() {
            //         var events = $('#calendar').fullCalendar('clientEvents');
            //         var csvData = [];
            //
            //         events.forEach(function(event) {
            //             var eventData = {
            //                 Title: event.title,
            //                 Attendees: event.attendees,
            //                 Status: event.status,
            //                 Description: event.description,
            //                 Location: event.location,
            //                 Start: event.start.format('MMMM DD, YYYY h:mm A'),
            //                 End: event.end ? event.end.format('MMMM DD, YYYY h:mm A') : ''
            //             };
            //
            //             csvData.push(eventData);
            //         });
            //
            //         var csv = Papa.unparse(csvData, {
            //             delimiter: ',',
            //             header: true
            //         });
            //
            //         var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            //         var link = document.createElement('a');
            //         link.href = URL.createObjectURL(blob);
            //         link.download = 'calendar_events.csv';
            //         document.body.appendChild(link);
            //         link.click();
            //         document.body.removeChild(link);
            //     });
            // });
            $(document).on('click', '#exportPrintBtn', function() {
                exportPrintPdf();
            });

            function exportPrintPdf() {
                // Check dependencies
                if (!window.jspdf || !moment || !$('#calendar').fullCalendar) {
                    console.error('Required dependencies (jsPDF, Moment.js, or FullCalendar) are missing.');
                    return;
                }

                // Initialize jsPDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Add the header title - Centered
                const pageWidth = doc.internal.pageSize.width;
                const text = 'Staff Calendar All Appointments';
                const textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                const xPosition = (pageWidth - textWidth) / 2; // Center the text
                doc.setFontSize(16);
                doc.setFont('helvetica', 'normal');
                doc.text(text, xPosition, 20);

                // Get all events from the calendar
                const events = $('#calendar').fullCalendar('clientEvents');

                // If no events, add a message and save
                if (!events || events.length === 0) {
                    doc.setFontSize(12);
                    doc.text('No events to display.', 10, 30);
                    doc.save(`staff_calendar_appointments_${moment().format('MMMM_D_YYYY_hh_mm_A')}.pdf`);
                    return;
                }

                // Prepare table data
                const tableData = events.map(event => [
                    event.customerName || 'N/A',
                    event.title2 || 'N/A',
                    event.attendees || 'N/A',
                    event.location || 'N/A',
                    event.start && event.start.isValid() ? event.start.format('MMMM D, YYYY hh:mm A') : 'N/A',
                    event.end && event.end.isValid() ? event.end.format('MMMM D, YYYY hh:mm A') : 'N/A',
                    event.status || 'N/A'
                ]);

                // Use autoTable if available
                if (typeof doc.autoTable === 'function') {
                    doc.autoTable({
                        head: [['Customer','Title', 'Attendees User','Address','Start Time', 'End Time', 'Status']],
                        body: tableData,
                        startY: 30,
                        theme: 'grid',
                        styles: {
                            fontSize: 10,
                            cellPadding: 4,
                            overflow: 'linebreak',
                            valign: 'middle',
                            halign: 'left',
                        },
                        columnStyles: {
                            0: { cellWidth: 'auto' },
                            1: { cellWidth: 'auto' },
                            2: { cellWidth: 'auto' },
                            3: { cellWidth: 'auto' },
                            4: { cellWidth: 'auto' },
                            5: { cellWidth: 'auto' },
                            6: { cellWidth: 'auto' }
                        },
                        headStyles: {
                            fillColor: [116, 201, 17],
                            textColor: [255, 255, 255],
                        },
                        didDrawCell: (data) => {
                            // This ensures text wraps properly
                            if (data.cell.section === 'body') {
                                data.cell.text = data.cell.raw;
                            }
                        }
                    });
                } else {
                    // Fallback: Manual table rendering with line breaks
                    let yPos = 30;
                    doc.setFontSize(10);

                    // Table header
                    doc.setFillColor(116, 201, 17);
                    doc.rect(10, yPos - 8, 190, 10, 'F');
                    doc.setTextColor(255, 255, 255);
                    const headers = ['Customer', 'Title', 'Attendees User', 'Address', 'Start Time', 'End Time', 'Status'];
                    const columnWidths = [30, 30, 30, 30, 30, 30, 20];
                    const xPositions = [10, 40, 70, 100, 130, 160, 190];

                    headers.forEach((header, index) => {
                        doc.text(header, xPositions[index], yPos);
                    });

                    yPos += 10;
                    doc.setTextColor(0, 0, 0);

                    // Table rows with line wrapping
                    tableData.forEach(row => {
                        let maxLines = 1;

                        // First pass: calculate how many lines each cell needs
                        const cellLines = row.map((cell, index) => {
                            const text = String(cell);
                            const textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                            const lines = Math.ceil(textWidth / columnWidths[index]) || 1;
                            return lines;
                        });

                        maxLines = Math.max(...cellLines);

                        // Second pass: draw each cell with proper line breaks
                        for (let line = 0; line < maxLines; line++) {
                            row.forEach((cell, index) => {
                                const text = String(cell);
                                const textLines = doc.splitTextToSize(text, columnWidths[index]);
                                if (textLines[line]) {
                                    doc.text(textLines[line], xPositions[index], yPos + (line * 5));
                                }
                            });
                        }

                        yPos += (maxLines * 5) + 5;

                        // Add new page if needed (accounting for A4 height ~297mm)
                        if (yPos > 270) {
                            doc.addPage();
                            yPos = 10;
                        }
                    });
                }

                // Save the PDF
                doc.save(`staff_calendar_appointments_${moment().format('MMMM_D_YYYY_hh_mm_A')}.pdf`);
            }
            function organizeData(events) {
                var organizedData = [];

                // Iterate through each event
                events.forEach(function(event) {
                    var month = event.start.format('MMMM'); // Get month name
                    var days = event.start.format('D'); // Get day of the month
                    var dayOfWeek = event.start.format('dddd'); // Get day of the week

                    // Check if the month is already in the organizedData array
                    var monthEntry = organizedData.find(function(entry) {
                        return entry.Month === month;
                    });
                    if (!monthEntry) {
                        monthEntry = {
                            Month: month,
                            Days: [],
                            'No of Appointments': []
                        };
                        organizedData.push(monthEntry);
                    }
                    monthEntry.Days.push(dayOfWeek);
                    monthEntry['No of Appointments'].push(1);
                });
                return organizedData;
            }
        });
        $(document).ready(function() {
            const disabledDates = [];
            <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $holiday->getHoliday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            disabledDates.push('<?php echo e($h->date); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            // function isDateDisabled(date) {
            //     const formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
            //     return disabledDates.includes(formattedDate);
            // }
            // function initializeDateTimePicker(selector, errorClass) {
            //     $(selector).datetimepicker({
            //         dateFormat: 'yy-mm-dd',
            //         timeFormat: 'HH:mm',
            //         beforeShowDay: function(date) {
            //             if (isDateDisabled(date)) {
            //                 return [false, '', 'This date is a holiday'];
            //             }
            //             return [true, ''];
            //         },
            //         onSelect: function(dateText) {
            //             const errorSpan = $(errorClass);
            //             const selectedDate = dateText.split(' ')[0]; // Extract date part
            //             if (disabledDates.includes(selectedDate)) {
            //                 errorSpan.text('This date is a holiday date.');
            //                 $(this).val(''); // Clear the input value
            //             } else {
            //                 errorSpan.text('');
            //             }
            //         }
            //     });
            // }
            // Example disabled dates (for holidays or unavailable dates)
            console.log('disabledDates',disabledDates)

//             function isDateDisabled(date) {
//                 const d = new Date(date);
//                 const dateStr = d.toISOString().split('T')[0]; // Format as 'yyyy-mm-dd'
//                 return disabledDates.includes(dateStr);
//             }
//
//             let startPicker = null;
//             let endPicker = null;
//
//             function initializeDateTimePicker(selector, errorClass, isStart = true) {
//                 const picker = flatpickr(selector, {
//                     enableTime: true,
//                     dateFormat: 'Y-m-d H:i', // Consistent with Carbon's ISO format (e.g., 2025-06-14 18:00)
//                     defaultDate: new Date(), // Current date-time in PKT
//                     time_24hr: true,
//                     disableMobile: true,
//                     disable: [
//                         function(date) {
//                             return isDateDisabled(date);
//                         }
//                     ],
//                     onChange: function(selectedDates, dateStr, instance) {
//                         const errorSpan = $(errorClass);
//                         if (selectedDates.length > 0) {
//                             const selectedDate = selectedDates[0].toISOString().split('T')[0];
//                             if (disabledDates.includes(selectedDate)) {
//                                 errorSpan.text('This date is a holiday date.');
//                                 $(selector).val('');
//                                 instance.clear();
//                             } else {
//                                 errorSpan.text('');
//                                 if (isStart && endPicker) {
//                                     const defaultDuration = parseInt($(selector).data('default-duration')) || 60; // Default to 60 minutes
//                                     const newEndDate = new Date(selectedDates[0]);
//                                     newEndDate.setMinutes(newEndDate.getMinutes() + defaultDuration);
//                                     endPicker.setDate(newEndDate, true, 'Y-m-d H:i');
//                                 } else if (!isStart && startPicker && startPicker.selectedDates[0]) {
//                                     const startDate = startPicker.selectedDates[0];
//                                     if (selectedDates[0] <= startDate) {
//                                         errorSpan.text('End date must be after start date.');
//                                         $(selector).val('');
//                                         instance.clear();
//                                     }
//                                 }
//                             }
//                         }
//                     },
//                     onClose: function(selectedDates, dateStr, instance) {
//                         if (dateStr) {
//                             // Support multiple input formats for manual entry
//                             const parsedDate = instance.parseDate(dateStr, 'Y-m-d H:i') ||
//                                 instance.parseDate(dateStr, 'Y-m-d H:i') ||
//                                 instance.parseDate(dateStr, 'Y-m-d H:i');
//                             if (!parsedDate) {
//                                 $(errorClass).text('Invalid date/time format. Use: 2025-06-14 18:00');
//                                 $(selector).val('');
//                                 instance.clear();
//                             } else {
//                                 $(errorClass).text('');
//                                 instance.setDate(parsedDate, true, 'Y-m-d H:i');
//                             }
//                         }
//                     }
//                 });
//                 $(selector).removeAttr('readonly');
//                 return picker;
//             }
//
// // Initialize both date-time pickers
//             startPicker = initializeDateTimePicker('#date_time_from', '.error_date_time_from', true);
//             endPicker = initializeDateTimePicker('#date_time_to', '.error_date_time_to', false);
            // Assume disabledDates is an array of strings in 'YYYY-MM-DD' format, e.g., ['2025-06-14', '2025-06-15']
            function isDateDisabled(date) {
                const dateStr = moment(date).format('MM-DD-YYYY');
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
                    const selectedDate = e.date ? moment(e.date).format('DD-MM-YYYY') : null;

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
        var today = new Date().toISOString().slice(0, 16);
        document.getElementsByName("date_time_from")[0].min = today;
        var today = new Date().toISOString().slice(0, 16);
        document.getElementsByName("date_time_to")[0].min = today;
        /* $(document).ready(function() {
             $('.MyAppointment').validate({
                 ignore: [],
                 rules: {
                     customer_id: {
                         required: true
                     },
                     title: {
                         required: true,
                         noSpace: true
                     },
                     location: {
                         required: true

                     },
                     date_time_to: {
                         required: true

                     },
                     date_time_from: {
                         required: true

                     },
                     appointment_for_lead_id: {
                         required: true
                     },
                     'attendees_user_id[]': {
                         required: true
                     }
                 },
                 messages: {
                     customer_id: {
                         required: "Please select Customer First."
                     },
                     title: {
                         required: "Please enter Title.",
                         noSpace: "Spaces are not allowed."
                     },
                     location: {
                         required: "Please add Address"
                     },
                     date_time_to: {
                         required: "Please select date to"
                     },
                     date_time_from: {
                         required: "Please select date from"
                     },
                     appointment_for_lead_id: {
                         required: "Please select for"
                     },
                     'attendees_user_id[]': {
                         required: "Please select Attendees"
                     }
                 },
                 submitHandler: function(form) {
                     // Check if the condition for SweetAlert is met
                     var appointment_for_lead_id = $('.appointment_for_lead_id').val();
                     if (appointment_for_lead_id === 'no_data_found' || appointment_for_lead_id === '0'){
                         Swal.fire({
                             title: "Lead Not Found",
                             html:  "Please Choose Different Customer",
                             icon:  "warning",
                             timer: 5000,
                             buttons: false
                         });
                     } else {
                         form.submit();
                     }
                 }
             });
         });*/
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
        
        
        
        $('.customer_id').on('change',function() {
            var id = 0;
            var customer_id = $(this).val(); // Get the selected value
            console.log('customer_id', customer_id)
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
                    $('.appointment_for_lead_id').html(result);
                    $('.appointment_for_lead_id').select2('destroy');
                    setTimeout(function () {
                        $('.appointment_for_lead_id').select2({
                            placeholder: "Select Appointment For",
                            allowClear: true,
                            dropdownParent: $('#addAppointmentModal')
                        });
                        console.log('yes');
                    }, 500);
                },
                error:function(e){
//                alert(e.status);
                    console.log(e.status);
                }
            });
        }
    </script>

    <script>
        $(document).on('click', '.call_btn', function () {
            var now = new Date();
            var time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
            var date = now.toISOString().split('T')[0];
            var lead_id = $(this).data('lead-id');
            let newCall = {
                lead_id: lead_id,
                phone: "2819374192",
                notes: "Appointment Reminder Call",
                time: time,
                date: date,
                duration: "1:59s",
                _token: "<?php echo e(csrf_token()); ?>"
            };
            $.ajax({
                url: "<?php echo e(url('call/call')); ?>",
                type: "POST",
                data: newCall,
                success: function (response) {
                    if (response.call) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Call Added',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Invalid response format',
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'AJAX Error',
                        text: error,
                    });
                }
            });
        });


        $(document).on('click', '.email_btn', function() {
            var appointmentId = $(this).data('appointment-id');
            var leadId = $(this).data('lead-id');

            // Your AJAX call here
            $.ajax({
                url: '<?php echo e(url("appointment_reminder_email")); ?>',
                type: 'POST',
                data: {
                    appointment_id: appointmentId,
                    lead_id: leadId,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Email Send',
                        text: 'The appointment reminder send successfully',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Try again later.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
        $(document).on('click', '.mark_complete', function() {
            var appointmentId = $(this).data('appointment-id');
            var $button = $(this);

            // Your AJAX call here
            $.ajax({
                url: '<?php echo e(url("appointment_complete")); ?>',
                type: 'POST',
                data: {
                    appointment_id: appointmentId,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    $button.html('<i class="fa-solid fa-check"></i> Completed');
                    $button.prop('disabled', true);

                    Swal.fire({
                        icon: 'success',
                        title: 'Appointment Completed',
                        text: 'The appointment marked as completed',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Try again later.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
        $(document).on('click', '.sms_btn', function() {
            var appointmentId = $(this).data('appointment-id');

            // Your AJAX call here
            $.ajax({
                url: '<?php echo e(url("appointment_sms")); ?>',
                type: 'POST',
                data: {
                    appointment_id: appointmentId,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Appointment SMS Send',
                        text: 'The appointment reminder sms send',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Try again later.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
    </script>


    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('googleAPI')); ?>&libraries=places&callback=initAutocomplete" async defer></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/appointment/appointment/calendar/calendar.blade.php ENDPATH**/ ?>