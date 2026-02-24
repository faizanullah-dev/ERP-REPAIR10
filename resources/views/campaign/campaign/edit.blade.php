@extends('layouts.master')
@section('content')
    <div id="taf-tabs" class="lead_edit_campaign">
        <form method="POST" id="campaign_form">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="campaign_search">
                        <div class="form-group">
                            <div>
                                <label>Campaign Name</label>
                                    <input type="text" class="form-control campaign_name" name="name" value="{{ $campaign->name??"" }}" placeholder="Enter Campaign Name" style="margin-bottom: 15px;">
                            </div>
                            <div>
                            <label>Campaign Stage</label>
                            <select class="form-control campaign_name_select campaign_stage" id="" name="stage_id" style="padding: 0 15px; height: 65px;">
                                @foreach($stages as $key => $stage)
                                    <option value="{{$stage->id}}" @if(isset($campaign) && $stage->id == $campaign->stage_id) selected @endif>{{$stage->name??""}} ({{ isset($stage->leads) ? $stage->leads->count() : 0 }} leads)</option>
                                @endforeach
                            </select>
                            </div>
                            <input type="hidden" class="form-control" name="campaign_id" id="campaign_id" value="{{ optional($campaign)->id ?? '0' }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="left-side">
                        <div class="left-scroll">
                            <ul class="nav nav-tabs">
                                @php
                                    $maxAddedDay = $campaignDetails->max('day');
                                @endphp
                                @for ($i = 1; $i <= max($maxAddedDay, 30); $i++)
                                    @php
                                        $dayDetails = $campaignDetails->where('day', $i);
                                        $activeClass = $dayDetails->count() > 0 ? 'active' : '';
                                    @endphp
                                    <li class="{{ $activeClass }}">
                                        <a href="#tab{{ $i }}" class="tab-link" data-has-data="{{ $dayDetails->count() > 0 }}">
                                            <span class="day_num"> Day {{ $i }}</span>
                                            <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                        </a>
                                    </li>
                                @endfor
                            </ul>
                        </div>

                        <div class="custom_filter ">
                            <button class="btn custom_filter_btn btn green_btn" type="button" id="custom_filter_btn">
                                Add More
                            </button>
                            <div class="custom_filter_box">
                                <div class="">
                                    <input class="form-control" type="number" id="" placeholder="">
                                </div>
                                <div class="">
                                    <button class="btn close-btn" type="button">Close</button>
                                    <button class="btn green_btn add_more_btn" type="button" > Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        @for ($i = 1; $i <= max($maxAddedDay, 30); $i++)
                            @php
                                $dayDetails  = $campaignDetails->where('day', $i);
                                $activeClass = ($i === 1) ? 'active' : '';
                                $currentTimestamp = time() + $i;
                                $reminderIndex = 0;
                            @endphp
                            <div class="tab-pane {{ $activeClass }}" id="tab{{ $i }}">
                                <div class="taf-form">
                                    @if($dayDetails->isEmpty())
                                        <div class="taf-row">
                                            <input type="hidden" class="tab_pane_hidden" name="campaign[{{ $i }}][days][]" value="{{$i}}">
                                            <h3 class="text-center">Day {{ $i }} </h3>
                                            <div class="taf-compaign">
                                                <h5 class="m-0">Reminder {{ ++$reminderIndex }} </h5>
                                                <div class="btn-create">
                                                    <button type="button" day-id="{{ $i }}" class="btn_create btn"><i class="fa fa-plus" style="color:#fff;"></i></button>
                                                </div>
                                            </div>
                                            <div class="taf-header">
                                                <div class="left-col">
                                                    <div class="left_col_select">
                                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                        <span>Send email at </span>
                                                        <div class="form-group">
                                                            <input type="time" name="campaign[{{ $i }}][time][]" class="form-control send_email_time set_time" required>
                                                        </div>
                                                    </div>
                                                    <div class="radio_boxs">
                                                        <span style="flex-shrink: 0;">Message Typess</span>
                                                        <select class="form-control message_type" name="campaign[{{ $i }}][message_type][]">
                                                            <option value="phone" @if(isset($detail) && $detail->message_type == 'phone') selected @endif>Phone</option>
                                                            <option value="email" @if(isset($detail) && $detail->message_type == 'email') selected @endif >Email</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="radio_boxs email_template_div">
                                                    <span style="flex-shrink: 0;">Select Email Template</span>
                                                    <select class="form-control">
                                                        <option value="">--Select Template--</option>
                                                        @foreach($emailTemplates as $emailTemplate)
                                                            <option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title ?? "" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group compaign_email_fields">
                                                <label for="formSubject">Subject</label>
                                                <input type="text" class="form-control subject_mail" name="campaign[{{ $i }}][subject][]" id="formSubject" placeholder="Type here">
                                            </div>
{{--                                            <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}compaign_email_fields">--}}
{{--                                                <label for="images" class="control-label">{{ 'Attachments' }} <span class="text-danger">*</span></label>--}}
{{--                                                <div action="#" class="dropzone attachmentDropzone" drop-day-id="{{ $i }}">--}}
{{--                                                    <div class="fallback">--}}
{{--                                                        <input name="images" id="images" type="file" multiple accept="image/*" required />--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="form-group {{ $errors->has('images') ? 'has-error' : '' }} compaign_email_fields">
                                                <label for="images" class="control-label">Attachments <span class="text-danger">*</span></label>
                                                <div action="#" id="camp_day_{{ $i }}_reminder_{{ $reminderIndex }}" drop-day-id="{{ $i }}" day-detail-id="{{ $detail->id }}" drop-reminder-index="{{ $reminderIndex }}" class="dropzone attachmentDropzone">
                                                    <div class="fallback">
                                                        <input name="campaign[{{ $i }}][reminders][{{ $reminderIndex }}][mail_attachment][]" id="images_{{ $i }}_{{ $reminderIndex }}" type="file" multiple accept="image/*" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="formNote">Note</label>
                                                <textarea class="form-control note_description subject_description" id="textCk{{ $i }}" name="campaign[{{ $i }}][message][]" required placeholder="Enter message here...">{{ $detail->message??"" }}</textarea>
                                            </div>
                                            <div class="form-group d-none">
                                                <label for="formNote">Note</label>
                                                <textarea class="form-control subject_description" id="formNote" name="campaign[{{ $i }}][message][]" rows="4" placeholder="Your message here"></textarea>
                                            </div>
                                            <input type="hidden" name="campaign[{{ $i }}][timestamp][]" value="{{ $currentTimestamp }}">
                                        </div>
                                    @else
                                        @php
                                            $dayDetails = $campaignDetails->where('day', $i);
                                        @endphp
                                        @foreach ($dayDetails as $key => $detail)
                                            @php $index = $key + 1; @endphp
                                            <div class="taf-row">
                                                <input type="hidden" class="tab_pane_hidden" name="campaign[{{ $i }}][days][]" value="{{$i}}">
                                                <h3 class="text-center">Day {{ $i }} </h3>
                                                @if ($key <= 0)
                                                    <div class="taf-compaign">
                                                        <h5 class="m-0">Reminder {{ $index }} </h5>
                                                        <div class="btn-create">
                                                            <button type="button" day-id="{{ $i }}" class="btn_create btn"><i class="fa fa-plus" style="color:#fff;"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($key >= 1)
                                                    <h5 class="m-0">Reminder {{ $index }} </h5>
                                                @endif
                                                <div class="taf-header">
                                                    <div class="left-col">
                                                        <div class="left_col_select">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                            <span>Send email at </span>
                                                            <div class="form-group">
                                                                <input type="time" name="campaign[{{ $i }}][time][]" value="{{ $detail->time }}" class="form-control send_email_time set_time" required>
                                                            </div>
                                                        </div>
                                                        <div class="radio_boxs">
                                                            <span style="flex-shrink: 0;">Message Type</span>
                                                            <select class="form-control message_type" name="campaign[{{ $i }}][message_type][]">
                                                                <option value="phone" @if(isset($detail) && $detail->message_type == 'phone') selected @endif>Phone</option>
                                                                <option value="email" @if(isset($detail) && $detail->message_type == 'email') selected @endif >Email</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="radio_boxs email_template_div">
                                                        <span style="flex-shrink: 0;">Select Email Template</span>
                                                        <select class="form-control">
                                                            <option value="">--Select Template--</option>
                                                            @foreach($emailTemplates as $emailTemplate)
                                                                {{--<option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title ?? "" }}</option>--}}
                                                                <option value="{{ $emailTemplate->id }}"
                                                                        @if($emailTemplate->id == $detail->email_template_id) selected @endif>
                                                                    {{ $emailTemplate->title ?? "" }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group compaign_email_fields">
                                                    <label for="formSubject">Subject <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control subject_mail" name="campaign[{{ $i }}][subject][]" id="formSubject" value="{{ $detail->subject??"" }}" placeholder="Type here" required>
                                                </div>
{{--                                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}compaign_email_fields">--}}
{{--                                                    <label for="images" class="control-label">{{ 'Attachments' }} <span class="text-danger">*</span></label>--}}
{{--                                                    <div action="#" id="editDropzone" class="dropzone attachmentDropzone" drop-day-id="{{ $i }}" day-detail-id="{{ $detail->id }}">--}}
{{--                                                        <div class="fallback">--}}
{{--                                                            <input name="images" id="images" type="file" multiple accept="image/*" required />--}}
{{--                                                        </div>--}}
{{--                                                        <input type="hidden" name="campaign[{{ $i }}][reminders][{{ $index }}][mail_attachment][]" id="campaign_attachment">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="form-group {{ $errors->has('images') ? 'has-error' : '' }} compaign_email_fields">
                                                    <label for="images" class="control-label">Attachments <span class="text-danger">*</span></label>
                                                    <div action="#" id="camp_day_{{ $i }}_reminder_{{ $index }}"
                                                         drop-day-id="{{ $i }}"
                                                         day-detail-id="{{ $detail->id }}"
                                                         drop-reminder-index="{{ $index }}"
                                                         class="dropzone attachmentDropzone">
                                                        <div class="fallback">
                                                            <input type="hidden" name="campaign[{{ $i }}][reminders][{{ $index }}][mail_attachment][]" id="campaign_attachment">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="formNote">Note</label>
                                                    <textarea class="form-control note_description subject_description" id="textCk{{ $i }}" name="campaign[{{ $i }}][message][]" required placeholder="Enter message here...">{{ $detail->message??"" }}</textarea>
                                                </div>
                                                <input type="hidden" name="campaign[{{ $i }}][timestamp][]" value="{{ $detail->timestamp??"" }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="col-md-12">
                        <div>
                            <select class="form-control status" id="formSelect" name="status">
                                <option value="1" @if(isset($campaign) && $campaign->status == 1) selected @endif>Active</option>
                                <option value="0" @if(isset($campaign) && $campaign->status == 0)  selected @endif>InActive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-offset-4 mt-4 col-md-4">
                        <div class="form-group">
                            <div class=" d-flex justify-content-center ">
                                <input class="btn green_btn borderRadius add_task_modal_btn " id="update_btn" type="submit" value="Update">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.note_description').each(function () {
                if (!$(this).data("editor-instance")) {
                    ClassicEditor.create(this)
                        .then(editor => {
                            $(this).data("editor-instance", editor);
                            editor.model.document.on('change:data', () => {
                                $(this).val(editor.getData()).trigger('keyup');
                            });
                        })
                        .catch(error => {
                            console.error("Error initializing CKEditor:", error);
                        });
                }
            });
        });

        $(document).on('change', '.message_type', function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'email') {
                $('.email_template_div').show();
            } else {
                $('.email_template_div').hide();
            }
        });
        function getTemplateData(_this){
            let templateId = "";
            let $tafRow = "";
            let $dropzone = "";
            let $ckEditor = "";
            if($(_this).val()){
                templateId = $(_this).val();
                $tafRow = $(_this).closest('.taf-row');
                $dropzone = $tafRow.find('.attachmentDropzone');
                $ckEditor = $tafRow.find('.note_description');
            } else {
                templateId = $(_this).find('.email_template_div select option:selected').val();
                $tafRow = $(_this);
                $dropzone = $tafRow.find('.attachmentDropzone');
                $ckEditor = $tafRow.find('.note_description');
            }

            if(templateId) {
                $.ajax({
                    url: '/getCampaignEmailTemplate/' + templateId,
                    type: 'GET',
                    success: function (response) {
                        //console.log(response);
                        $tafRow.find('.subject_mail').val(response.subject);
                        $ckEditor.each(function () {
                            let ckEditor_this = $(this);
                            let editorElement = ckEditor_this;
                            const existingEditor = $(editorElement).data("editor-instance");
                            if (existingEditor) {
                                existingEditor.setData(response.note);
                            } else {
                                ClassicEditor.create(editorElement)
                                    .then(editor => {
                                        $(editorElement).data("editor-instance", editor);
                                        editor.setData(response.note);
                                    })
                                    .catch(error => {
                                        console.error("Error initializing CKEditor:", error);
                                    });
                            }
                        });
                        $dropzone.empty();
                        if (response.images.length > 0) {
                            response.images.forEach(function (image) {
                                var img = $('<img>', {
                                    src: image.url,
                                    height: 100,
                                    width: 100,
                                    alt: 'Image for ' + image.name
                                });
                                $dropzone.append(`<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
                        <div class="dz-image">
                            <img data-dz-thumbnail="" alt="laptop.png" src="` + image.url + `">
                        </div>
                        <div class="dz-details">
                            <div class="dz-filename">
                                <span data-dz-name="">` + image.name + `</span>
                            </div>
                        </div>
                        <div class="dz-progress">
                            <span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span>
                        </div>
                        <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                        <div class="dz-success-mark">
                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.5,31.8431458 L17.5852419,25.9283877..." />
                            </svg>
                        </div>
                        <input type="hidden" name="mail_attachments[]" value="` + image.name + `">
                    </div>`);
                            });
                        } else {
                            $dropzone.append('<p>No images available for this template.</p>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
        $(window).on('load', function(){
            $('.taf-form .taf-row').each(function() {
                let _this = $(this);
                getTemplateData(_this);
            });
        });

        $(document).on('change', '.email_template_div select, .create_email_template_div select, .dynamic_email_template_div select', function() {
            let _this = $(this);
            getTemplateData(_this);
        });

        $(document).ready(function() {
            $('body').on('change', '.set_time', function() {
                var [hours, minutes] = $(this).val().split(':').map(Number);
                var adjustedMinutes = Math.ceil(minutes / 30) * 30;
                if (adjustedMinutes === 60) {
                    hours = (hours + 1) % 24;
                    adjustedMinutes = 0;
                }
                var formattedTime = `${hours < 10 ? '0' : ''}${hours}:${adjustedMinutes < 10 ? '0' : ''}${adjustedMinutes}`;
                $(this).val(formattedTime);
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.tab-link', function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                $('.tab-pane').removeClass('active');
                $(target).addClass('active');
                $('.tab-pane').closest('li').removeClass('active');
                $(this).closest('li').addClass('active');

                 $(target).find('.note_description').not(':has(+ .ck-editor)').each(function () {
                    ClassicEditor.create(this)
                        .then(editor => {
                            $(this).data('editor-instance', editor);
                            editor.model.document.on('change:data', () => {
                                $(this).val(editor.getData()).trigger('keyup');
                            });
                        })
                        .catch(error => {
                            console.error('Error initializing CKEditor:', error);
                        });
                });

            });
        });

        $(document).ready(function() {
            $(document).on("click", ".btn_create", function(event) {
                var creatCounter =  $(this).attr('day-id');
                var currentTimestamp = Date.now();
                //console.log(creatCounter)
                event.preventDefault();
                var currentId = $(this).closest(".taf-form").find('.taf-row').length + 1;
                var newRow =
                    '<div class="taf-row">' +
                    '<input type="hidden" name="campaign[' + creatCounter +'][timestamp][]" value="' + currentTimestamp + '">' +
                    '<input type="hidden" name="campaign[' + creatCounter + '][days][]" value="' + creatCounter + '" class="form-control">' +
                    '<div class="taf-compaign">' +
                    '<h5 class="m-0">Reminder ' +currentId+ '</h5>'+
                    '<div class="btn-delete campaign_detail_id_for_delete" data-campaign-id="' + creatCounter + '">' +
                    '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                    '</div>' +
                    '</div> ' +
                    '<div class="taf-header"> <div class="left-col"> <div class="left_col_select"> ' +
                    '<i class="fa fa-envelope-o" aria-hidden="true">' +
                    '</i> ' +
                    '<span>Send email at </span>' +
                    ' <div class="form-group">' +
                    '<input type="time" name="campaign[' + creatCounter + '][time][]"  class="form-control set_time" required>' +
                    '</div> </div> <div class="radio_boxs" style="display: flex; align-items: center;">' +
                    '<span for="formMessageType">Message Types</span>' +
                    '<select class="form-control create_message_type" name="campaign[' + creatCounter + '][message_type][]">' +
                    '<option value="phone">Phone</option> ' +
                    '<option value="email">Email</option> ' +
                    '</select> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="radio_boxs create_email_template_div" style="display: none;">' +
                    '<label for="formEmailTemplate">Select Email Template</label>' +
                    '<select class="form-control " name="campaign[' + creatCounter + '][email_template][]">' +
                    '<option value="">--Select Template--</option>';
                @foreach($emailTemplates as $emailTemplate)
                    newRow += '<option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title ?? "" }}</option>';
                @endforeach
                    newRow += '</select>' +
                    '</div>' +
                    '<div class="right-col d-none"> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="form-group compaign_email_fields"> ' +
                    '<label for="formSubject">Subject</label> ' +
                    '<input type="text" class="form-control subject_mail" name="campaign[' + creatCounter + '][subject][]" id="formSubject" placeholder="Type here"> ' +
                    '</div> ' +
                    '<div class="form-group compaign_email_fields">' +
                    '<label for="formSubject">Attachments</label>' +
                    '<div action="#" id="" class="dropzone attachmentDropzone data_id" data-dropzone-id="' + creatCounter + '" data-attachment-id="' +currentId+ '">' +
                    '<div class="fallback">' +
                    '<input name="images" id="images" type="file" multiple accept="image/*" required />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="formNote">Note</label>' +
                    '<textarea class="form-control note_description subject_description" id="formNote" name="campaign[' + creatCounter + '][message][]" rows="4" placeholder="Hi [First Name]! This is [User First Name] with [Detail Company Name]. I am reaching out to you today to confirm you received our estimate, if you have any questions or concerns, please feel free to contact our office."></textarea>' +
                    '</div>' +
                    ' <!--<button type="button" class="btn save_as_draft">Save As Draft</button>--> ' +
                    '</div>';
                $(this).closest(".taf-form").append(newRow);
                $('.note_description').not(':has(+ .ck-editor)').each(function () {
                    ClassicEditor.create(this)
                        .then(editor => {
                            $(this).data('editor-instance', editor);
                            editor.model.document.on('change:data', () => {
                                $(this).val(editor.getData()).trigger('keyup'); // Trigger keyup on the textarea
                            });
                        })
                        .catch(error => {
                            console.error('Error initializing CKEditor:', error);
                        });
                });

                // Initialize Dropzone for the newly created attachment container
                var dropzoneContainer = $(this).closest(".taf-form").find('.dropzone[data-attachment-id="' +currentId+ '"]');
                initializeDropzones(dropzoneContainer);

                $(document).on('change', '.create_message_type', function() {
                    var selectedValue = $(this).val();
                    if (selectedValue === 'email') {
                        $(this).closest('.taf-row').find('.create_email_template_div').show();
                    } else {
                        $(this).closest('.taf-row').find('.create_email_template_div').hide();
                    }
                });
            });

            @php
                $attachmentsByDay = [];
                foreach ($campaignDetails as $detail) {
                    foreach ($detail->campaignAttachment as $attachment) {
                        // Group attachments by day and campaign_detail_id
                        $attachmentsByDay[$detail->day][$detail->id][] = [
                            'id' => $attachment->id,
                            'name' => $attachment->name,
                            'size' => @filesize(public_path('/website/' . $attachment->name))
                        ];
                    }
                }
            @endphp

            let existingAttachments = @json($attachmentsByDay);
            console.log("Existing Attachments:", existingAttachments);

// Disable auto-discovery of Dropzone
            Dropzone.autoDiscover = false;

// Initialize Dropzones for each container
            function initializeDropzones(container) {
                let attachmentDropzone = []; // Array to hold attachment responses
                $(".attachmentDropzone").each(function () {
                    let dropzoneElement = $(this);
                    let dropDayId = dropzoneElement.attr("drop-day-id");
                    let campaignDetailId = dropzoneElement.attr("day-detail-id");
                    let reminderIndex = dropzoneElement.attr("drop-reminder-index");

                    // Prevent reinitialization if Dropzone is already attached
                    if (dropzoneElement.hasClass("dz-clickable")) {
                        return;
                    }

                    // Initialize Dropzone on the container
                    let myDropzone = new Dropzone(dropzoneElement[0], {
                        url: "{{ route('upload_email_attachment') }}",
                        addRemoveLinks: true,
                        dictRemoveFile: "Remove",
                        maxFiles: 5,
                        acceptedFiles: "image/*,application/pdf,.doc,.docx",
                        sending: function (file, xhr, formData) {
                            formData.append("_token", "{{ csrf_token() }}");
                        },
                        success: function (file, response) {
                            file.previewElement.classList.add("dz-success");
                            attachmentDropzone.push(response);

                            // Append hidden input for the attachment
                            const hiddenInput = $('<input>')
                                .attr("type", "hidden")
                                .attr("name", `campaign[${dropDayId}][reminders][${reminderIndex}][mail_attachment][]`)
                                .val(response);
                            dropzoneElement.append(hiddenInput);
                        },
                        error: function (file, response) {
                            file.previewElement.classList.add("dz-error");
                        },
                        init: function () {
                            let dropzone = this;
                            console.log("Dropzone initialized for:", dropDayId, "Campaign-Detail-ID:", campaignDetailId, "Reminder-Index:", reminderIndex);

                            // Max file exceeded handler
                            this.on("maxfilesexceeded", function (file) {
                                this.removeFile(file);
                                Swal.fire("File Limit exceeded!", "ERROR");
                            });

                            // Check if there are existing attachments
                            if (existingAttachments.hasOwnProperty(dropDayId) && existingAttachments[dropDayId].hasOwnProperty(campaignDetailId)) {
                                existingAttachments[dropDayId][campaignDetailId].forEach(function (attachment) {
                                    let imageUrl = "{{ asset('/website/') }}/" + attachment.name;

                                    // Mock file to display existing attachment in Dropzone
                                    let mockFile = {
                                        name: attachment.name,
                                        size: attachment.size || 1024,
                                        type: "image/jpeg"
                                    };

                                    dropzone.emit("addedfile", mockFile);
                                    dropzone.emit("thumbnail", mockFile, imageUrl);
                                    dropzone.emit("complete", mockFile);
                                    dropzone.files.push(mockFile);

                                    // Add custom attributes for the preview element
                                    $(mockFile.previewElement).attr("data-id", attachment.id);
                                    $(mockFile.previewElement).attr("data-image-name", attachment.name);
                                });
                            }
                        }
                    });
                });
            }


            $(document).ready(function () {
                initializeDropzones();
            });


    $(".add_more_btn").on("click", function() {
                var numClonesInput = $(".custom_filter_box input");
                var numClones = parseInt($(numClonesInput).val());
                if (!isNaN(numClones) && numClones > 0) {
                    var lastTabNumber = parseInt($("#taf-tabs .nav-tabs li").last().find(".day_num").text().match(/\d+/)[0]);
                    for (var i = 0; i < numClones; i++) {
                        var newTabNumber = lastTabNumber + 1;
                        var newTabId = "tab" + newTabNumber;
                        var currentTimestamp = Date.now();
                        var newNavTab = '<li class="" > <a href="#' + newTabId + '" data-toggle="tab" class="tab-link"> <span class="day_num"> Day ' + newTabNumber + '</span> <span> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span> </a> </li>';
                        var newTabPane =
                            '<div class="tab-pane " id="' + newTabId + '">' +
                            '<div class="taf-form"> ' +
                            '<div class="taf-row"> ' +
                            '<h3 class="text-center">Day ' +newTabNumber+ '</h3>' +
                            '<div class="taf-compaign"> ' +
                            '<h5 class="m-0">Reminder 1 </h5>'+
                            '<div class="btn-create"> ' +
                            '<button type="button" day-id="' + newTabNumber + '" class="btn_create btn"><i class="fa fa-plus" style="color:#fff;"></i></button> ' +
                            '</div> ' +
                            '</div> ' +
                            '<input type="hidden" name="campaign[' + newTabNumber +'][timestamp][]" value="' + currentTimestamp + '">' +
                            '<input type="hidden" class="tab_pane_hidden" name="campaign[' + newTabNumber + '][days][]" value="' + newTabNumber + '"> ' +
                            '<div class="taf-header"> ' +
                            '<div class="left-col"> ' +
                            '<div class="left_col_select"> ' +
                            '<i class="fa fa-envelope-o" aria-hidden="true"></i> ' +
                            '<span>Send email at </span> ' +
                            '<div class="form-group"> ' +
                            '<input type="time" name="campaign[' + newTabNumber + '][time][]" class="form-control send_email_time set_time"> ' +
                            '</div> ' +
                            '</div> ' +
                            '<div class="radio_boxs">' +
                            '<span>Message Type</span> ' +
                            '<select class="form-control dynamic_message_type" name="campaign[' + newTabNumber + '][message_type][]"> ' +
                            '<option value="phone">Phone</option> ' +
                            '<option value="email">Email</option> ' +
                            '</select> ' +
                            '</div> ' +
                            '</div> ' +
                            '<div class="radio_boxs dynamic_email_template_div" style="display: none;">' +
                            '<label for="formEmailTemplate">Select Email Template</label>' +
                            '<select class="form-control" name="campaign[' + newTabNumber + '][email_template][]">' +
                            '<option value="">--Select Template--</option>';
                        @foreach($emailTemplates as $emailTemplate)
                            newTabPane += '<option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title ?? "" }}</option>';
                        @endforeach
                            newTabPane += '</select>' +
                            '</div>' +
                            '</div> ' +
                            '<div class="form-group compaign_email_fields"> ' +
                            '<label for="formSubject">Subject</label> ' +
                            '<input type="text" class="form-control subject_mail" name="campaign[' + newTabNumber + '][subject][]" id="formSubject" placeholder="Type here"> ' +
                            '</div> ' +
                            '<div class="form-group compaign_email_fields">' +
                            '<label for="formSubject">Attachments</label>' +
                            '<div action="#" id="" class="dropzone attachmentDropzone data_id" data-dropzone-id="' + newTabNumber + '" data-attachment-id="' +newTabNumber+ '">' +
                            '<div class="fallback">' +
                            '<input name="images" id="images" type="file" multiple accept="image/*" required />' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="formNote">Note</label>' +
                            '<textarea class="form-control note_description subject_description" id="formNote" name="campaign[' + newTabNumber + '][message][]" rows="4" placeholder="Hi [First Name]! This is [User First Name] with [Detail Company Name]. I am reaching out to you today to confirm you received our estimate, if you have any questions or concerns, please feel free to contact our office."></textarea>' +
                            '</div>' +
                            '<div class="form-group d-none"> ' +
                            '<label for="formNote">Note</label> ' +
                            '<textarea class="form-control subject_description" id="formNote" name="campaign[' + newTabNumber + '][message][]" rows="4" placeholder="Hi [First Name]! This is [User First Name] with [Detail Company Name]. I am reaching out to you today to confirm you received our estimate, if you have an questions or concern, please feel free to contact our office."></textarea> ' +
                            '</div>  ' +
                            '</div> ' +
                            '</div> ' +
                            '</div> ';
                        $("#taf-tabs .nav-tabs").append(newNavTab);
                        $("#taf-tabs .tab-content").append(newTabPane);
                        lastTabNumber = newTabNumber;

                        var dropzoneContainer = $('#tab'+newTabNumber).find('.taf-form .dropzone[data-attachment-id="' +newTabNumber+ '"]');
                        initializeDropzones(dropzoneContainer);

                        $(document).on('change', '.dynamic_message_type', function() {
                            var selectedValue = $(this).val();
                            if (selectedValue === 'email') {
                                $(this).closest('.taf-row').find('.dynamic_email_template_div').show();
                            } else {
                                $(this).closest('.taf-row').find('.dynamic_email_template_div').hide();
                            }
                        });
                    }
                    $(numClonesInput).val('');
                    $(numClonesInput).closest('.custom_filter_box').removeAttr('style');
                }
            });
        });

        $(document).ready(function() {
            $(".custom_filter_btn").click(function() {
                $(".custom_filter_box").fadeIn(300); // Adjust the duration (in milliseconds) for desired speed
            });
            $(".custom_filter_box .close-btn").click(function() {
                $(".custom_filter_box").fadeOut(300);
            });
        });

        $(document).ready(function() {
            $(document).on('keyup change', ".campaign_name, .campaign_stage, .message_type, .send_email_time, .subject_mail, .subject_description, .status", function() {
                var formData = new FormData($('#campaign_form')[0]);
                html_this = $(this)
                $.ajax({
                    url: "{{ route('update_campaign') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.is_valid) {
                            $('#campaign_id').val(response.campaign_id);
                            $(html_this).closest('.taf-row').find('.campaign_detail_id_for_delete').attr('data-campaign-id',response.campaignDetail_id)
                        } else {
                            // Handle invalid response or show an error message
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', textStatus, errorThrown);
                    }
                });
            });
        });

        $(document).on("click", "#update_btn", function() {
            showConfirmationDialog();
        });

        function submitForm() {
            var formData = new FormData($('#campaign_form')[0]);
            $.ajax({
                url: "{{ route('update_campaign') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.is_valid) {
                        $('#campaign_id').val(response.campaign_id);
                    } else {
                        $('#campaign_id').val(response.campaign_id);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error:', textStatus, errorThrown);
                }
            });
        }

        function showConfirmationDialog() {
            swal({
                title: 'Are You Sure You Want To Submit The Form?',
                icon: "warning",
                buttons: ["Cancel","Yes!"],
                dangerMode: true,
            })
                .then(function(confirm) {
                    if (confirm) {
                        submitForm();
                        var selectedStatus = $('#formSelect').val();
                        swal("Form Submitted!", "Your form has been successfully submitted.", "success")
                            .then(function () {
                                // Redirect to a new page
                                if (selectedStatus === '1') {
                                    window.location.href = '/campaign/campaign?campaign_type=active';
                                } else if (selectedStatus === '0') {
                                    window.location.href = '/campaign/campaign?campaign_type=inactive';
                                }
                            });
                    }
                });
        }

        $(document).ready(function() {
            $(".delete-button").click(function(event) {
                event.preventDefault(); // Prevent the default link behavior
                var campaignId = $(this).data("campaign-id");
                var clickedButton = $(this);
                swal({
                    title: 'Are You Sure You Want To Delete The Data?',
                    icon: "warning",
                    buttons: ["Cancel", "Yes!"],
                    dangerMode: true,
                }).then(function(confirm) {
                    if (confirm) {
                        $.ajax({
                            type: "GET",
                            url: "/delete_campaign/" + campaignId, // Adjust the URL to match your route
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                // Remove the deleted campaign from the DOM
                                clickedButton.closest('.taf-row').remove();
                                $(".campaign[data-campaign-id='" + campaignId + "']").remove();
                                var selectedStatus = $('#').val();
                                swal("Form Updated!", "Your form has been Updated Successfully.", "success")
                                    .then(function() {
                                        // Redirect to a new page
                                        if (selectedStatus === 'active') {
                                            window.location.href = '/campaign/campaign?campaign_type=active';
                                        } else if (selectedStatus === 'inactive') {
                                            window.location.href = '/campaign/campaign?campaign_type=inactive';
                                        }
                                    });
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                });
            });
        });

        $(document).on('click', '.btn-delete', function (event) {
            event.preventDefault();
            var campaignDetailID = $(this).attr('data-campaign-id');
            var clickedButton = $(this);
            $.ajax({
                url: "/delete_campaignDetail/" + campaignDetailID,
                type: 'GET',
                data: { id: campaignDetailID },
                success: function(response) {
                    clickedButton.closest('.taf-row').remove();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 404){
                        clickedButton.closest('.taf-row').remove();
                    }
                }
            });
        });

    //Active Class on SideBar
    $('#taf-tabs').on('click', '.left-scroll .nav-tabs li', function() {
        $(this).closest('ul').find('li').removeClass('active');
        $(this).addClass('active');
        confirmActive();
    });

    function confirmActive(){
        let tab = $('#taf-tabs .nav-tabs > li');
        let tabPane = $('#taf-tabs .tab-content > .tab-pane');
        $(tabPane).each(function() {
            let id = $(this).attr('id');
            let set_time = $(this).find('.set_time').val();

            $(tab).each(function(){
                let href = $(this).find('a').attr('href').replace('#', '');
                if(set_time != ""){
                    if(id == href){
                        $(this).addClass('confirmActive');
                    }
                } else {
                    if(id == href){
                        $(this).removeClass('confirmActive');
                    }
                }
            });
        });
    }

    $(window).on('load', function(){
        confirmActive();
    });
</script>
@endpush