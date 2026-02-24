<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Appointment</h4>
            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/appointment/appointment/' . $appointment->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="edit_appointment_form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
                <section class="task_form">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
                                    <label for="customer_id" class="control-label">{{ 'Customer' }}</label>
                                    <select class="form-control custom_modal_select2 borderRadius customer_id  {{--select2--}}" data-placeholder="Select Customer" id="" name="customer_id" required>
                                        @foreach($leads as $lead)
                                            <option value="{{$lead->customer_id}}" @if(isset($appointment) && $lead->customer_id == $appointment->customer_id) selected @endif>{{$lead->customer->name??""}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                    <label for="title" class="control-label">{{ 'Title*' }}</label>
                                    <input class="form-control" name="title" type="text" id="title" placeholder="Enter Name" value="{{ $appointment->title??''}}" required>
                                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('appointment_for_lead_id') ? 'has-error' : ''}}">
                                    <label for="appointment_for_lead_id" class="control-label">{{ 'Appointment For' }}</label>
                                    <select class="form-control borderRadius appointment_for_lead_id custom_modal_select2 " data-placeholder="Select Appointment" id="appointment_for_lead_id" name="appointment_for_lead_id" required>
                                        @if(!empty($leadExist))
                                            @foreach($leads as $lead)
                                                <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                                            @endforeach
                                        @else
                                            @foreach($leads as $lead)
                                                <option value="{{$lead->id}}" @if(isset($appointment) && $lead->id == $appointment->appointment_for_lead_id) selected @endif>{{$lead->title}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    {!! $errors->first('appointment_for_lead_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('attendees_user_id') ? 'has-error' : ''}}">
                                    <label for="attendees_user_id" class="control-label">{{ 'Attendees User*' }}</label>
                                    <select class="form-control custom_modal_select2 borderRadius attendees_user_id " data-placeholder="Select Attendees"  id="" name="attendees_user_id[]" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" @if(isset($appointment) && in_array($user->id, $appointment->getAppointmentAttendee->pluck('attendees_id')->toArray())) selected @endif>{{$user->name??""}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('attendees_user_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('assign_to_team_id') ? 'has-error' : ''}}">
                                    <label for="assign_to_lead_id" class="control-label">{{ 'Assign To Team ' }} </label>
                                    <select class="form-control borderRadius custom_modal_select2 " data-placeholder="Select Assign Team" name="assign_to_team_id" id="assign_to_lead_id" >
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}" @if(isset($appointment) && $team->id == $appointment->team_id) selected @endif>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('Address') ? 'has-error' : ''}}">
                                    <label for="location" class="control-label">{{ 'Address' }}</label>
                                    <input class="form-control" placeholder="Enter address" name="location" type="text" id="edit_address_appointment" value="{{ $appointment->location??''}}" >
                                    {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group {{ $errors->has('additional_recipients') ? 'has-error' : ''}}">--}}
{{--                                    <label for="additional_recipients" class="control-label">{{ 'Additional Recipients' }}</label>--}}
{{--                                    <input class="form-control" name="additional_recipients" type="text" id="additional_recipients" value="{{ $appointment->additional_recipients??''}}" >--}}
{{--                                    {!! $errors->first('additional_recipients', '<p class="help-block">:message</p>') !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('edit_date_time_from') ? 'has-error' : ''}}">
                                    <label for="edit_date_time_from" class="control-label">{{ 'Appointment Date Time Start*' }}</label>
                                    <div class="input-group date date_and_time" id="edit_date_time_from_picker">
                                        <input class="form-control" name="date_time_from" type="text" id="edit_date_time_from" value="{{ $appointment->date_time_from ? \Carbon\Carbon::parse($appointment->date_time_from)->format('m-d-y h:i A') : '' }}" required>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <span class="error_edit_date_time_from" style="color: red"></span>
                                    {!! $errors->first('edit_date_time_from', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('edit_date_time_to') ? 'has-error' : ''}}">
                                    <label for="edit_date_time_to" class="control-label">{{ 'Appointment Date Time End*' }}</label>
                                    <div class="input-group date date_and_time" id="edit_date_time_to_picker">
                                        <input class="form-control" name="date_time_to" type="text" id="edit_date_time_to" value="{{ $appointment->date_time_to ? \Carbon\Carbon::parse($appointment->date_time_to)->format('m-d-y h:i A') : '' }}" required>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <span class="error_edit_date_time_to" style="color: red"></span>
                                    {!! $errors->first('edit_date_time_to', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                    <label for="status" class="control-label">{{ 'Status' }}</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1" @if(isset($appointment) && $appointment->status == 1) selected @endif>Active</option>
                                        <option value="0" @if(isset($appointment) && $appointment->status == 0) selected @endif>InActive</option>
                                    </select>
                                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                    <label for="images" class="control-label">{{ 'Images/Documents' }}</label>
                                    <div action="#" id="appteditDropzone" class="dropzone">
                                        <div class="fallback">
                                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="appointment_attachment" id="appointment_attachment_edit">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                    <label for="description" class="control-label">{{ 'Description' }}</label>
                                    <textarea class="form-control" rows="5" name="description" id="description_edit">{!!$appointment->description??''!!} </textarea>
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-center save col-md-offset-4 col-md-4 calendar_edit_appointment_btn">
                                <input class="btn btn-primary" type="submit" value="Update">
                            </div>
                        </div>
                    </div>
                </section>
                <script>
                    google.maps.event.addDomListener(window, 'load', function () {
                        var places = new google.maps.places.Autocomplete(document.getElementById('edit_address_appointment'));
                        google.maps.event.addListener(places, 'place_changed', function () {
                            var place = places.getPlace();
                            var address = place.formatted_address;
                            var latitude = place.geometry.location.lat();
                            var longitude = place.geometry.location.lng();
                            var latlng = new google.maps.LatLng(latitude, longitude);
                            var geocoder = geocoder = new google.maps.Geocoder();
                            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    if (results[0]) {
                                        var address = results[0].formatted_address;
                                        var pin = results[0].address_components[results[0].address_components.length - 1].long_name;
                                        var country = results[0].address_components[results[0].address_components.length - 2].long_name;
                                        var state = results[0].address_components[results[0].address_components.length - 3].long_name;
                                        var city = results[0].address_components[results[0].address_components.length - 4].long_name;
                                        document.getElementById('txtCountry').value = country;
                                        document.getElementById('txtState').value = state;
                                        document.getElementById('txtCity').value = city;
                                        document.getElementById('txtZip').value = pin;
                                    }
                                }
                            });

                        });
                    });

                    $(document).ready(function() {

                        {{--const disabledDates = [];--}}
                        {{--@foreach($holidays as $holiday)--}}
                        {{--@foreach($holiday->getHoliday as $h)--}}
                        {{--disabledDates.push('{{ $h->date }}');--}}
                        {{--@endforeach--}}
                        {{--@endforeach--}}
                        {{--function isDateDisabled(date) {--}}
                        {{--    const formattedDate = flatpickr.formatDate(date, "Y-m-d");--}}
                        {{--    return disabledDates.includes(formattedDate);--}}
                        {{--}--}}
                        {{--flatpickr(".editStartDate", {--}}
                        {{--    altInput: true,--}}
                        {{--    enableTime: true,--}}
                        {{--    dateFormat: "Y-m-d H:i",--}}
                        {{--    disable: [--}}
                        {{--        function(date) {--}}
                        {{--            return isDateDisabled(date);--}}
                        {{--        }--}}
                        {{--    ],--}}
                        {{--    onChange: function(selectedDates, dateStr, instance) {--}}
                        {{--        const selectedDate = dateStr.split(" ")[0]; // Extract date part--}}
                        {{--        const errorElement = $(instance.input).siblings(".error-message");--}}

                        {{--        if (disabledDates.includes(selectedDate)) {--}}
                        {{--            errorElement.text("This date is a holiday.");--}}
                        {{--            instance.clear();--}}
                        {{--        } else {--}}
                        {{--            errorElement.text("");--}}
                        {{--        }--}}
                        {{--    }--}}
                        {{--});--}}
                        {{--const now = new Date();--}}
                        {{--const minDate = flatpickr.formatDate(now, "Y-m-d\TH:i");--}}
                        {{--document.getElementsByName("date_time_from")[0].min = minDate;--}}
                        {{--document.getElementsByName("date_time_to")[0].min = minDate;--}}


                        const disabledDates = [];
                        @foreach($holidays as $holiday)
                        @foreach($holiday->getHoliday as $h)
                        disabledDates.push('{{ $h->date }}');
                        @endforeach
                        @endforeach
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
                                const selectedDate = e.date ? moment(e.date).format('DD-MM-YYYY') : null;

                                if (selectedDate && disabledDates.includes(selectedDate)) {
                                    errorSpan.text('This date is a holiday date.');
                                    $input.val('');
                                    picker.data('DateTimePicker').clear();
                                } else {
                                    errorSpan.text('');
                                    if (isStart && endPicker) {
                                        // Ensure the end date is at least 1 hour greater than the start date
                                        const defaultDuration = 60; // 60 minutes = 1 hour
                                        const newEndDate = e.date ? moment(e.date).add(defaultDuration, 'minutes') : moment().add(defaultDuration, 'minutes');
                                        endPicker.data('DateTimePicker').date(newEndDate);
                                    } else if (!isStart && startPicker && startPicker.data('DateTimePicker').date()) {
                                        const startDate = startPicker.data('DateTimePicker').date();
                                        if (e.date && e.date.isBefore(startDate.add(1, 'hour'))) {
                                            // Ensure that end date is at least 1 hour greater than the start date
                                            errorSpan.text('End date must be at least one hour greater than start date.');
                                            $input.val('');
                                            picker.data('DateTimePicker').clear();
                                        }
                                    }
                                }
                            });



                            return picker;
                        }

                        startPicker = initializeDateTimePicker('#edit_date_time_from_picker', '.error_edit_date_time_from', true);
                        endPicker = initializeDateTimePicker('#edit_date_time_to_picker', '.error_edit_date_time_to', false);
                    });

                    {{--$(document).ready(function() {--}}
                    {{--    const disabledDates = [];--}}
                    {{--    @foreach($holidays as $holiday)--}}
                    {{--    @foreach($holiday->getHoliday as $h)--}}
                    {{--    console.log('Adding disabled date:', '{{ $h->date }}');--}}
                    {{--    disabledDates.push('{{ $h->date }}');--}}
                    {{--    @endforeach--}}
                    {{--    @endforeach--}}
                    {{--    function isDateDisabled(date) {--}}
                    {{--        const formattedDate = $.datepicker.formatDate('yy-mm-dd', date);--}}
                    {{--        return disabledDates.includes(formattedDate);--}}
                    {{--    }--}}
                    {{--    function initializeDateTimePicker(selector, errorClass) {--}}
                    {{--        $(selector).datetimepicker({--}}
                    {{--            dateFormat: 'yy-mm-dd',--}}
                    {{--            timeFormat: 'HH:mm',--}}
                    {{--            beforeShowDay: function(date) {--}}
                    {{--                if (isDateDisabled(date)) {--}}
                    {{--                    return [false, '', 'This date is a holiday'];--}}
                    {{--                }--}}
                    {{--                return [true, ''];--}}
                    {{--            },--}}
                    {{--            onSelect: function(dateText) {--}}
                    {{--                const errorSpan = $(errorClass);--}}
                    {{--                const selectedDate = dateText.split(' ')[0]; // Extract date part--}}
                    {{--                if (disabledDates.includes(selectedDate)) {--}}
                    {{--                    console.log(selectedDate + ' is disabled.');--}}
                    {{--                    errorSpan.text('This date is a holiday date.');--}}
                    {{--                    $(this).val(''); // Clear the input value--}}
                    {{--                } else {--}}
                    {{--                    errorSpan.text('');--}}
                    {{--                }--}}
                    {{--            }--}}
                    {{--        });--}}
                    {{--    }--}}
                    {{--    initializeDateTimePicker('#edit_date_time_from', '.error_date_time_from');--}}
                    {{--    initializeDateTimePicker('#edit_date_time_to', '.error_date_time_to');--}}
                    {{--});--}}
                    $(document).ready(function () {
                        var sum = 0;
                        var appointment_attachment_arr = [];
                        Dropzone.autoDiscover = false;
                        $("#appteditDropzone").dropzone({
                            url: "{{route('upload_appointment_attachment')}}",
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
                                $('#appointment_attachment_edit').val(appointment_attachment_arr);
                                file.previewElement.remove();
                                $.ajax({
                                    type: 'get',
                                    url: "{{ route('remove_appointment_attachment') }}",
                                    data: {image_name:image_name,id:id},
                                    async: false,
                                    success: function(result) {
                                        $('#product_div').html(result);
                                    }
                                });
                            },
                            sending: function(file, xhr, formData) {
                                formData.append("_token", "{{ csrf_token() }}");
                            },
                            success: function (file, response) {
                                file.previewElement.classList.add("dz-success");
                                appointment_attachment_arr.push(response);
                                $('#appointment_attachment_edit').val(appointment_attachment_arr);
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
                        @if(isset($appointment->images) && $appointment->images != null)
                        @foreach ($appointment->images as $attachment)
                        var file = {
                            name: "{{ explode('.',$attachment->name)[1]}}",
                            size: "{{ filesize(public_path().'/website/'.@$attachment->name) }}",
                            status: Dropzone.ADDED,
                            accepted: true
                        };
                        dropzone.emit("addedfile", file);
                        @if(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']))
                        dropzone.emit("thumbnail", file, "{{ asset('/website').'/'.$attachment->name }}");
                        @elseif(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['pdf']))
                        dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/pdf.png' }}");
                        @elseif(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['doc','docx']))
                        dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
                        @else
                        dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
                        @endif
                        dropzone.emit("complete", file);
                        $(file._removeLink).attr('id','{{ $attachment->id }}')
                        $(file._removeLink).attr('image_name','{{ $attachment->name}}')
                        dropzone.files.push(file);
                        @endforeach
                        @endif

                    });
                    @if(isset($appointment))
                    leadDropdown("{{$appointment->customer_id}}","{{$appointment->appointment_for_lead_id}}");
                    @endif
                    $(document).ready(function() {
                        ClassicEditor
                            .create(document.querySelector('#description_edit'))
                            .catch(error => {
                                console.error(error);
                            });
                    });

                    $(document).on('change','.customer_id',function() {
                        // Get the selected value and selected ID
                        var customer_id = $(this).val(); // Get selected value of customer_appointment_select
                        var id = $(this).find('option:selected').data('id'); // Assuming `data-id` attribute on option contains the id

                        // Call the leadDropdown function with the customer_id and id
                        leadDropdown(customer_id, id);
                    });

                    function leadDropdown(customer_id, id){
                        $.ajax({
                            url: '{{route('lead_dropdown')}}',
                            type: 'GET',
                            data: {
                                'id': id,
                                'customer_id': customer_id
                            },
                            success: function(result) {
                                // Update the dropdown with the result
                                $('.appointment_for_lead_id').html(result);

                                // Reinitialize Select2 after content is updated
                                $('.appointment_for_lead_id').select2('destroy'); // Destroy previous Select2 instance to avoid conflicts
                                $('.appointment_for_lead_id').select2({
                                    allowClear: true,
                                    width: '100%',
                                    placeholder: function() {
                                        return $(this).data('placeholder');
                                    },
                                    dropdownParent: $('#editAppointmentModal')
                                });
                            },
                            error:function(e){
                                console.log(e.status);
                            }
                        });
                    }

                    $('#MyAppointment').on('submit', function(event) {
                        var appointment_for_lead_id = $('#appointment_for_lead_id').val();
                        if (appointment_for_lead_id === 'no_data_found' || appointment_for_lead_id === '0'){
                            event.preventDefault();
                            Swal.fire({
                                title: "Oops..",
                                html:  "no leads available for this customer, please select valid customer for appointment",
                                icon:  "error",
                                timer: 5000,
                                buttons: false,
                            });
                        }//end if.
                    });
                    $.validator.addMethod("dateAfter", function(value, element, param) {
                        var startDate = $(param).val();
                        var endDate = value;

                        if (startDate && endDate) {
                            // Ensure both start and end dates are parsed into valid Date objects
                            var startMoment = moment(startDate, 'MM-DD-YY hh:mm A');
                            var endMoment = moment(endDate, 'MM-DD-YY hh:mm A');

                            // Check if end date is at least 1 hour greater than start date
                            return endMoment.isSameOrAfter(startMoment.add(1, 'hour'));
                        }
                        return true;
                    }, "End date must be at least one hour greater than the start date.");


                    $('#edit_appointment_form').validate({
                        ignore: [],
                        rules: {
                            customer_id: {
                                required: true
                            },
                            title: {
                                required: true,
                                noSpace: true
                            },
                            // location: {
                            //     required: true
                            // },
                            date_time_to: {
                                required: true,
                                dateAfter: '#edit_date_time_from'
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
                            // location: {
                            //     required: "Please add Address"
                            // },
                            date_time_to: {
                                required: "Please select date to",
                                dateAfter: "End date must be greater than or equal to start date."
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
                        errorPlacement: function(error, element) {
                            if (element.attr("name") === "description") {
                                error.insertAfter("#description_edit");
                            } else {
                                error.insertAfter(element);
                            }
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });

                </script>
            </form>
        </div>
    </div>
</div>
<script>

</script>
