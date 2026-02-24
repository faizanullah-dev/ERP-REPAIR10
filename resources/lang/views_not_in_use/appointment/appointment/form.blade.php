@push('css')
    <link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
            <label for="customer_id" class="control-label">{{ 'Customer*' }}</label>
            <select class="form-control clr_input_fields borderRadius {{--select2--}}" id="customer_id" name="customer_id" required>
                <option selected disabled>Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}" @if(isset($appointment) && $appointment->customer_id==$customer->id) selected @endif>{{$customer->name}}</option>
                @endforeach
            </select>
            {{--<input class="form-control" name="customer_id" type="text" id="customer_id" value="{{ $appointment->customer_id??''}}" >--}}
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
            <label for="appointment_for_lead_id" class="control-label">{{ 'Appointment For*' }}</label>
            <select class="form-control {{--clr_input_fields borderRadius select2--}}" id="appointment_for_lead_id" name="appointment_for_lead_id" required>
                @if(!empty($leadExist))
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @else
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($photoanddocument) && $lead->id == $photoanddocument->lead_id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @endif
            </select>
            {!! $errors->first('appointment_for_lead_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('attendees_user_id') ? 'has-error' : ''}}">
            <label for="attendees_user_id" class="control-label">{{ 'Attendees User*' }}</label>
            {{--<input class="form-control" name="attendees_user_id" type="text" id="attendees_user_id" value="{{ $appointment->attendees_user_id??''}}" >--}}
            <select class="form-control clr_input_fields borderRadius select2" multiple id="attendees_user_id" name="attendees_user_id[]" required>
                @foreach($users as $user)
                    <option value="{{$user->id}}" @if(isset($appointment) && in_array($user->id, $appointment->getAppointmentAttendee->pluck('attendees_id')->toArray())) selected @endif>{{$user->name??""}}</option>
                @endforeach
            </select>
            {!! $errors->first('attendees_user_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
            <label for="location" class="control-label">{{ 'Location*' }}</label>
            <input class="form-control" name="location" type="text" id="location" value="{{ $appointment->location??''}}" required>
            {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('additional_recipients') ? 'has-error' : ''}}">
            <label for="additional_recipients" class="control-label">{{ 'Additional Recipients' }}</label>
            <input class="form-control" name="additional_recipients" type="text" id="additional_recipients" value="{{ $appointment->additional_recipients??''}}" >
            {!! $errors->first('additional_recipients', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('date_time_from') ? 'has-error' : ''}}">
            <label for="date_time_from" class="control-label">{{ 'Date Time From*' }}</label>
            <input class="form-control" name="date_time_from" type="datetime-local" min="2023-5-22" id="date_time_from" value="{{ $appointment->date_time_from??''}}" required>
            {!! $errors->first('date_time_from', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('date_time_to') ? 'has-error' : ''}}">
            <label for="date_time_to" class="control-label">{{ 'Date Time To*' }}</label>
            <input class="form-control" name="date_time_to" type="datetime-local" min="2023-5-22" id="date_time_to" value="{{ $appointment->date_time_to?? '' }}" required>
            {!! $errors->first('date_time_to', '<p class="help-block">:message</p>') !!}
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
            <label for="images" class="control-label">{{ 'Images' }}</label>
            <div action="#" id="dropzone" class="dropzone">
                <div class="fallback">
                    <input name="images" id="images" type="file" multiple accept="image/*" required />
                </div>
            </div>
        </div>
        <input type="hidden" name="appointment_attachment" id="appointment_attachment">
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            <label for="description" class="control-label">{{ 'Description' }}</label>
            <textarea class="form-control" rows="5" name="description" type="textarea" id="description">{{ $appointment->description??''}}</textarea>
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

{{--<div class="form-group {{ $errors->has('attachment') ? 'has-error' : ''}}">--}}
    {{--<label for="attachment" class="col-md-4 control-label">{{ 'Attachment' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="attachment" type="file" id="attachment" value="{{ $appointment->attachment??''}}" onchange="PreviewImage_1();">--}}
        {{--<img src="{{asset('website')}}/{{ $appointment->attachment??''}}" id="imagePreview_1"  height="100" width="100">--}}
        {{--{!! $errors->first('attachment', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
<script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>

    var today = new Date().toISOString().slice(0, 16);
    document.getElementsByName("date_time_from")[0].min = today;

    var today = new Date().toISOString().slice(0, 16);
    document.getElementsByName("date_time_to")[0].min = today;

$(document).ready(function () {
        var sum = 0;
        var appointment_attachment_arr = [];
        Dropzone.autoDiscover = false;
        $("#dropzone").dropzone({
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
                $('#appointment_attachment').val(appointment_attachment_arr);
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
</script>
<script>
    @if(isset($appointment))
        leadDropdown("{{$appointment->customer_id}}","{{$appointment->appointment_for_lead_id}}");
    @endif
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
    $('#customer_id').on('change',function() {
        var id = 0;
        var customer_id = $("#customer_id").val();
        leadDropdown(customer_id,id)
    });
    function leadDropdown(customer_id,id){
        $.ajax({
            url: '{{route('lead_dropdown')}}',
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
    }//end function leadDropdown.
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

    // Get the current date and time
    var currentDate = new Date();

    // Format the date and time to be compatible with datetime-local input
    var formattedDate = currentDate.toISOString().slice(0, 16);

    // Set the value of the input element
    document.getElementById("myDateTimeInput").value = formattedDate;

</script>
@endpush