@extends('layouts.master')
@section('content')
    <div id="taf-tabs">
        <form method="POST"  class="campaign-form" id="campaign_form">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="campaign_search">
                        <div class="form-group">
                            <div>
                                <label>Campaign Name</label>
                                <input type="text" class="form-control campaign_name" id="name" name="name" placeholder="Enter Campaign Name" style="margin-bottom: 15px;" required>
                            </div>
                            <div>
                                <label>Campaign Stage</label>
                                <select class="form-control campaign_name_select campaign_stage select2" data-placeholder="Select Stage" name="stage_id" style="padding: 0 15px; height: 65px;">
                                    @foreach($stages as $key => $stage)
                                        <option value="{{ $stage->id }}">{{ $stage->name }} ({{ isset($stage->leads) ? $stage->leads->count() : 0 }} leads)</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" class="form-control" name="campaign_id" id="campaign_id" value="{{ optional($campaign)->id ?? '0' }}">
                            <input type="hidden" name="play_or_resume" value="{{ $campaign->play_or_resume??"" }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="left-side">
                        <div class="left-scroll">
                            <ul class="nav nav-tabs">
                                @for ($i = 1; $i <= 30; $i++)
                                    @php
                                        $activeClass = ($i === 1) ? 'active' : '';
                                    @endphp
                                    <li class="{{ $activeClass }}" >
                                        <a href="#tab{{ $i }}" data-toggle="tab">
                                            <span class="day_num"> Day {{ $i }}</span>
                                            <span>
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        </span>
                                        </a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                        <div class="custom_filter">
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
{{--                <div class="col-md-9">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="tab-content">--}}
{{--                                @for ($i = 1; $i <= 30; $i++)--}}
{{--                                    @php--}}
{{--                                        $activeClass = ($i === 1) ? 'active' : '';--}}
{{--                                        $currentTimestamp = time() + $i;--}}
{{--                                    @endphp--}}
{{--                                    <div class="tab-pane {{ $activeClass }}" id="tab{{ $i }}">--}}
{{--                                        <div class="taf-form">--}}
{{--                                            <div class="taf-row">--}}
{{--                                                <input type="hidden" class="tab_pane_hidden" name="campaign[{{ $i }}][days][]" value="{{$i}}">--}}
{{--                                                <input type="hidden" name="campaign[{{ $i }}][timestamp][]" value="{{ $currentTimestamp }}">--}}
{{--                                                <input type="hidden" name="campaign[{{ $i }}][campaignDetail_id][]" class="campaignDetail_id">--}}
{{--                                                <h3 class="text-center">Day {{ $i }} </h3>--}}
{{--                                                <div class="taf-compaign">--}}
{{--                                                    <h5 class="m-0">Reminder 1 </h5>--}}
{{--                                                    <div class="btn-create">--}}
{{--                                                        --}}{{--<button type="button" day-id="{{ $i }}" class="btn_create btn">Create Campaign</button>--}}
{{--                                                        <button type="button" day-id="{{ $i }}" class="btn_create btn"><i class="fa fa-plus" style="color:white;"></i></button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="taf-header">--}}
{{--                                                    <div class="left-col">--}}
{{--                                                        <div class="left_col_select">--}}
{{--                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>--}}
{{--                                                            <span>Send email at </span>--}}
{{--                                                            <div class="form-group">--}}
{{--                                                                <input type="time" name="campaign[{{ $i }}][time][]" class="form-control set_time send_email_time" required>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="radio_boxs">--}}
{{--                                                            <span style="flex-shrink: 0;">Message Type</span>--}}
{{--                                                            <select class="form-control message_type" name="campaign[{{ $i }}][message_type][]" >--}}
{{--                                                                <option value="phone">Phone</option>--}}
{{--                                                                <option value="email">Email</option>--}}
{{--                                                            </select>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="radio_boxs email_template_div" style="display: none;">--}}
{{--                                                        <span style="flex-shrink: 0;">Select Email Template</span>--}}
{{--                                                        <select class="form-control email_template" name="campaign[{{ $i }}][email_template_id][]">--}}
{{--                                                            <option value="">--Select Template--</option>--}}
{{--                                                            @foreach($emailTemplates as $emailTemplate)--}}
{{--                                                                <option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title ?? "" }}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group compaign_email_fields">--}}
{{--                                                    <label for="formSubject">Subject</label>--}}
{{--                                                    <input type="text" class="form-control subject_mail" name="campaign[{{ $i }}][subject][]" required id="formSubject" placeholder="Type here">--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}compaign_email_fields">--}}
{{--                                                    <label for="images" class="control-label">{{ 'Attachments' }} <span class="text-danger">*</span></label>--}}
{{--                                                    <div action="#" id="camp_day" class="dropzone attachmentDropzone" drop-day-id="{{ $i }}">--}}
{{--                                                        <div class="fallback">--}}
{{--                                                            <input name="images" id="images" type="file" multiple accept="image/*" required />--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="formNote">Note</label>--}}
{{--                                                    <textarea class="form-control note_description subject_description" id="textCk{{ $i }}" name="campaign[{{ $i }}][message][]" required placeholder="Enter message here..."></textarea>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endfor--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <select class="form-control status" id="formSelect" name="status">--}}
{{--                                    <option value="1">Active</option>--}}
{{--                                    <option value="0">InActive</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <button type="button" class="btn green_btn large_green_btn" id="submit_btn">Submit</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content">
                                @for ($i = 1; $i <= 30; $i++)
                                    @php
                                        $activeClass = ($i === 1) ? 'active' : '';
                                        $currentTimestamp = time() + $i;
                                        $reminderIndex = 0; // Initialize reminder index
                                    @endphp
                                    <div class="tab-pane {{ $activeClass }}" id="tab{{ $i }}">
                                        <div class="taf-form">
                                            <div class="taf-row">
                                                <input type="hidden" class="tab_pane_hidden" name="campaign[{{ $i }}][days][]" value="{{ $i }}">
                                                <input type="hidden" name="campaign[{{ $i }}][timestamp][]" value="{{ $currentTimestamp }}">
                                                <input type="hidden" name="campaign[{{ $i }}][campaignDetail_id][]" class="campaignDetail_id">
                                                <h3 class="text-center">Day {{ $i }} </h3>
                                                <div class="taf-compaign">
                                                    <h5 class="m-0">Reminder {{ ++$reminderIndex }}</h5>
                                                    <div class="btn-create">
                                                        <button type="button" day-id="{{ $i }}" class="btn_create btn">
                                                            <i class="fa fa-plus" style="color:white;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="taf-header">
                                                    <div class="left-col">
                                                        <div class="left_col_select">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                            <span>Send email at </span>
                                                            <div class="form-group">
                                                                <input type="time" name="campaign[{{ $i }}][time][]" class="form-control set_time send_email_time" required>
                                                            </div>
                                                        </div>
                                                        <div class="radio_boxs">
                                                            <span style="flex-shrink: 0;">Message Type</span>
                                                            <select class="form-control message_type" name="campaign[{{ $i }}][message_type][]">
                                                                <option value="phone">Phone</option>
                                                                <option value="email">Email</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emailTemplateSelect" class="form-label input_labels">Select Email Folder <span class="text-danger">*</span></label>
                                                        <select class="form-control borderRadius select2 template_folder" data-placeholder="Select Email Folder" required>
                                                            @foreach($emailTemplateFolder as $value)
                                                                <option value="{{ $value->id }}" email-template="{{ $value->id }}">{{ $value->name??"" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="radio_boxs email_template_div" style="display: none;">
                                                        <span style="flex-shrink: 0;">Select Email Template</span>
                                                        <select class="form-control email_template select2" data-placeholder="Select Email Template" id="emailTemplateSelect" name="campaign[{{ $i }}][email_template_id][]">
                                                            @foreach($emailTemplates as $emailTemplate)
                                                                <option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group compaign_email_fields">
                                                    <label for="formSubject">Subject</label>
                                                    <input type="text" class="form-control subject_mail" name="campaign[{{ $i }}][subject][]" required id="formSubject" placeholder="Type here">
                                                </div>
                                                <div class="form-group {{ $errors->has('images') ? 'has-error' : '' }} compaign_email_fields">
                                                    <label for="images" class="control-label">Attachments <span class="text-danger">*</span></label>
                                                    <div
                                                            action="#"
                                                            id="camp_day_{{ $i }}_reminder_{{ $reminderIndex }}"
                                                            drop-day-id="{{ $i }}"
                                                            drop-reminder-index="{{ $reminderIndex }}"
                                                            class="dropzone attachmentDropzone"
                                                    >
                                                        <div class="fallback">
                                                            <input
                                                                    name="campaign[{{ $i }}][reminders][{{ $reminderIndex }}][mail_attachment][]"
                                                                    id="images_{{ $i }}_{{ $reminderIndex }}"
                                                                    type="file"
                                                                    multiple
                                                                    accept="image/*"
                                                                    required
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="formNote">Note</label>
                                                    <textarea class="form-control note_description subject_description" id="textCk{{ $i }}" name="campaign[{{ $i }}][message][]" required placeholder="Enter message here..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control status" id="formSelect" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn green_btn large_green_btn" id="submit_btn">Submit</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script>
let ckeditorInstance;
    $(document).ready(function () {
        $('.note_description').each(function () {
            if (!$(this).data("editor-instance")) {
                ClassicEditor.create(this)
                    .then(editor => {
                        $(this).data("editor-instance", editor);
                        editor.model.document.on('change:data', () => {
                            $(this).val(editor.getData()).trigger('keyup'); // Trigger keyup on the textarea
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
    $(document).on('change', '.email_template_div select, .dynamic_email_template_div select, .more_days_email_template_div select', function() {
        var templateId = $(this).val();
        var $tafRow = $(this).closest('.taf-row');
        var $dropzone = $tafRow.find('.attachmentDropzone');
        var $ckEditor = $tafRow.find('.note_description');
        $.ajax({
            url: '/getCampaignEmailTemplate/' + templateId,
            type: 'GET',
            success: function(response) {
                console.log(response);
                $tafRow.find('.subject_mail').val(response.subject);
                $ckEditor.each(function () {
                    let editorElement = this;
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
                    response.images.forEach(function(image) {
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
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // $(document).on('change', '.email_template_div select, .dynamic_email_template_div select, .more_days_email_template_div select', function() {
    //     var templateId = $(this).val();
    //     var $tafRow = $(this).closest('.taf-row');
    //     $.ajax({
    //         url: '/getCampaignEmailTemplate/' + templateId,
    //         type: 'GET',
    //         success: function(response) {
    //             console.log(response);
    //             $tafRow.find('.subject_mail').val(response.subject);
    //             if (ckeditorInstance) {
    //                 ckeditorInstance.setData(response.note);
    //             }
    //             $('#imageContainer').empty();
    //             if (response.images.length > 0) {
    //                 response.images.forEach(function(image) {
    //                     var img = $('<img>', {
    //                         src: image.url,
    //                         height: 100,
    //                         width: 100,
    //                         alt: 'Image for ' + image.name
    //                     });
    //                     $('.attachmentDropzone ').append(`<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
    //                         <div class="dz-image">
    //                             <img data-dz-thumbnail="" alt="laptop.png" src="`+image.url+`">
    //                         </div>
    //                         <div class="dz-details">
    // <!--                                                <div class="dz-size">-->
    // <!--                                                    <span data-dz-size="">-->
    // <!--                                                        <strong>0.4</strong> MB</span>-->
    // <!--                                                </div>-->
    //                             <div class="dz-filename">
    //                                 <span data-dz-name="">`+image.name+`</span>
    //                             </div>
    //                         </div>
    //                         <div class="dz-progress">
    //                             <span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span>
    //                         </div>
    //                         <div class="dz-error-message"><span data-dz-errormessage=""></span>
    //                         </div>  <div class="dz-success-mark">
    //                             <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Check</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>      </g>    </svg>  </div>  <div class="dz-error-mark">    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>
    //                         </div>
    //                         <input type="hidden" name="mail_attachments[]" value="`+image.name+`">
    // <!--                                            <a class="dz-remove" href="javascript:undefined;" data-dz-remove="" image_name="`+image.name+`">Remove file</a>-->
    //                     </div>`);
    //                     // $('#imageContainer').append(img);
    //                 });
    //             } else {
    //                 $('#imageContainer').append('<p>No images available for this template.</p>');
    //             }
    //         },
    //         // },
    //         error: function(xhr, status, error) {
    //             console.error(xhr.responseText);
    //         }
    //     });
    // });

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

    $(document).ready(function () {
        var rowCounter = 0;

        $(document).on("click", ".btn_create", function (event) {
            event.preventDefault();

            var dayId = parseInt($(this).attr("day-id")); // Get day ID
            var currentTimestamp = Date.now(); // Generate unique timestamp
            var reminderIndex = $(this).closest(".taf-form").find(".taf-row").length + 1; // Reminder index for the day

            // Increment row counter for unique IDs
            rowCounter++;

            // Build new row for the reminder
            var newRow = `
        <div class="taf-row">
            <input type="hidden" name="campaign[${dayId}][campaignDetail][id][]" value="${reminderIndex}">
            <input type="hidden" name="campaign[${dayId}][timestamp][]" value="${currentTimestamp}">
            <input type="hidden" name="campaign[${dayId}][days][]" value="${dayId}" class="form-control">
            <div class="taf-compaign">
                <h5 class="m-0">Reminder ${reminderIndex}</h5>
                <div class="btn-delete campaign_detail_id_for_delete" data-campaignDetailID="${reminderIndex}">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </div>
            </div>
            <div class="taf-header">
                <div class="left-col">
                    <div class="left_col_select">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <span>Send email at </span>
                        <div class="form-group">
                            <input type="time" name="campaign[${dayId}][time][]" class="form-control set_time" required>
                        </div>
                    </div>
                    <div class="radio_boxs" style="display: flex; align-items: center;">
                        <span>Message Type</span>
                        <select class="form-control dynamic_message_type" name="campaign[${dayId}][message_type][]">
                            <option value="phone">Phone</option>
                            <option value="email">Email</option>
                        </select>
                    </div>
                </div>
                <div class="radio_boxs dynamic_email_template_div" style="display: none;">
                    <span>Select Email Template</span>
                    <select class="form-control select2" data-placeholder="Select Template" name="campaign[${dayId}][email_template_id][]">
                        @foreach($emailTemplates as $emailTemplate)
            newRow += '<option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title ?? "" }}</option>';
                        @endforeach
            </select>
        </div>
    </div>
    <div class="form-group compaign_email_fields">
        <label for="formSubject">Subject</label>
        <input type="text" class="form-control subject_mail" name="campaign[${dayId}][subject][]" placeholder="Type here" required>
            </div>
            <div class="form-group compaign_email_fields">
                <label>Attachments</label>
                <div class="dropzone attachmentDropzone data_id" data-dropzone-id="${dayId}" data-reminder-id="${reminderIndex}">
                    <div class="fallback">
                        <input type="file" multiple accept="image/*" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="formNote">Note</label>
                <textarea class="form-control note_description subject_description" name="campaign[${dayId}][message][]" rows="4" placeholder="Enter message here..." required></textarea>
            </div>
        </div>`;

            // Append the new row to the form
            $(this).closest(".taf-form").append(newRow);

            // Initialize CKEditor for the new note field
            $(".note_description").not(":has(+ .ck-editor)").each(function () {
                ClassicEditor.create(this)
                    .then(editor => {
                        $(this).data("editor-instance", editor);
                        editor.model.document.on("change:data", () => {
                            $(this).val(editor.getData()).trigger("keyup");
                        });
                    })
                    .catch(error => console.error("Error initializing CKEditor:", error));
            });

            // Initialize Dropzone for the newly added reminder
            var dropzoneContainer = $(this).closest(".taf-form").find(`.dropzone[data-reminder-id="${reminderIndex}"]`);
            initializeDropzone(dropzoneContainer);
        });

// Initialize Dropzone
        function initializeDropzone(container) {
            Dropzone.autoDiscover = false;

            var attachmentDropzone = [];
            new Dropzone(container[0], {
                url: "{{ route('upload_email_attachment') }}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                maxFiles: 5,
                acceptedFiles: "image/*",
                removedfile: function (file) {
                    let image_name = $(file._removeLink).attr("image_name");
                    attachmentDropzone = attachmentDropzone.filter(value => value !== image_name);
                    file.previewElement.remove();

                    // Optional: Make an AJAX request to remove the file from the server
                    $.ajax({
                        type: "GET",
                        url: "{{ route('remove_email_attachment') }}",
                        data: { image_name },
                        success: function (response) {
                            console.log("File removed successfully.");
                        },
                        error: function (error) {
                            console.error("Error removing file:", error);
                        }
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    attachmentDropzone.push(response);

                    // Append hidden input for the attachment
                    const hiddenInput = $('<input>')
                        .attr("type", "hidden")
                        .attr("name", `campaign[${container.data("dropzone-id")}][reminders][${container.data("reminder-id")}][mail_attachment][]`)
                        .val(response);
                    container.append(hiddenInput);
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
            });
        }

// Show/hide email template dropdown based on message type
        $(document).on("change", ".dynamic_message_type", function () {
            var selectedValue = $(this).val();
            if (selectedValue === "email") {
                $(this).closest(".taf-row").find(".dynamic_email_template_div").show();
            } else {
                $(this).closest(".taf-row").find(".dynamic_email_template_div").hide();
            }
        });


        //Add More
        $(".add_more_btn").on("click", function() {
            var numClonesInput = $(".custom_filter_box input");
            var numClones = parseInt($(numClonesInput).val());
            if (!isNaN(numClones) && numClones > 0) {
                var lastTabNumber = parseInt($("#taf-tabs .nav-tabs li").last().find(".day_num").text().match(/\d+/)[0]);
                for (var i = 0; i < numClones; i++) {
                    var newTabNumber = lastTabNumber + 1;
                    var newTabId = "tab" + newTabNumber;
                    var currentTimestamp = Date.now();
                    var newNavTab = '<li> <a href="#' + newTabId + '" data-toggle="tab" class="tab-link"> <span class="day_num"> Day ' + newTabNumber + '</span> <span> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span> </a> </li>';
                    var newTabPane =
                        '<div class="tab-pane " id="' + newTabId + '">' +
                        '<div class="taf-form"> ' +
                        '<div class="taf-row"> ' +
                        '<input type="hidden" name="campaign[' + newTabNumber +'][timestamp][]" value="' + currentTimestamp + '">' +
                        '<input type="hidden" class="tab_pane_hidden" name="campaign[' + newTabNumber + '][days][]" value="' + newTabNumber + '">' +
                        '<h3 class="text-center">Day ' +newTabNumber+ '</h3>' +
                        '<div class="taf-compaign">' +
                        '<h5 class="m-0">Reminder 1 </h5>'+
                        '<div class="btn-create"> ' +
                        '<button type="button" day-id="' + newTabNumber + '" class="btn_create btn"><i class="fa fa-plus" style="color:#fff;"></i></button> ' +
                        '</div> ' +
                        '</div> ' +
                        '<div class="taf-header"> ' +
                        '<div class="left-col"> ' +
                        '<div class="left_col_select"> ' +
                        '<i class="fa fa-envelope-o" aria-hidden="true"></i>' +
                        '<span>Send email at </span> ' +
                        '<div class="form-group"> ' +
                        '<input type="time" name="campaign[' + newTabNumber + '][time][]" class="form-control email_time set_time" required> ' +
                        '</div> ' +
                        '</div> ' +
                        '<div class="radio_boxs">' +
                        '<span>Message Type</span> ' +
                        '<select class="form-control more_message_type" name="campaign[' + newTabNumber + '][message_type][]"> ' +
                        '<option value="phone">Phone</option> ' +
                        '<option value="email">Email</option> ' +
                        '</select> ' +
                        '</div> ' +
                        '</div> ' +
                        '<div class="radio_boxs more_days_email_template_div" style="display: none;">' +
                        '<label for="formEmailTemplate">Select Email Template</label>' +
                        '<select class="form-control select2" data-placeholder="Select Template" name="campaign[' + newTabNumber + '][email_template][]">' ;
                    @foreach($emailTemplates as $emailTemplate)
                        newTabPane += '<option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title ?? "" }}</option>';
                    @endforeach
                        newTabPane += '</select>' +
                        '</div>' +
                        '<div class="right-col d-none"> ' +
                        '<div class="btn-delete campaign_detail_id_for_delete" data-campaignDetailID="00"> ' +
                        '<i class="fa fa-trash-o" aria-hidden="true"></i> ' +
                        '</div> ' +
                        '</div> ' +
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
                        '<div class="form-group"> ' +
                        '<label for="formNote">Note</label> ' +
                        '<textarea class="form-control note_description subject_description" id="formNote" name="campaign[' + newTabNumber + '][message][]" rows="4" placeholder="Hi [First Name]! This is [User First Name] with [Detail Company Name]. I am reaching out to you today to confirm you received our estimate, if you have an questions or concern, please feel free to contact our office."></textarea> ' +
                        '</div>  ' +
                        '</div> ' +
                        '</div>  ' +
                        '</div>';
                    $("#taf-tabs .nav-tabs").append(newNavTab);
                    $("#taf-tabs .tab-content").append(newTabPane);
                    lastTabNumber = newTabNumber;
                    $('.email_time').last().rules('add', {
                        required: true,
                        messages: {
                            required: "<span class='text-danger fs-4'>Please choose the time</span>"
                        }
                    });


                    var dropzoneContainer = $('#tab'+newTabNumber).find('.taf-form .dropzone[data-attachment-id="' +newTabNumber+ '"]');
                    initializeDropzone(dropzoneContainer);

                    $(document).on('change', '.more_message_type', function() {
                        var selectedValue = $(this).val();
                        if (selectedValue === 'email') {
                            $(this).closest('.taf-row').find('.more_days_email_template_div').show();
                        } else {
                            $(this).closest('.taf-row').find('.more_days_email_template_div').hide();
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
            $(".custom_filter_box").fadeOut(300); // Adjust the duration (in milliseconds) for desired speed
        });
    });



$(document).ready(function() {
    $(".campaign-form").validate({
        rules: {
            name: {
                required: true,
            },
            stage_id: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "<span class='text-danger fs-4'>Please enter the campaign name</span>",
            },
            stage_id: {
                required: "<span class='text-danger fs-4'>Please select the lead</span>",
            },
        },
        submitHandler: function(form) {
        }
    });
    $(document).ready(function() {
        // $(window).on('beforeunload', function() {
        //     if ($(".campaign-form").valid()) {
        //         event.preventDefault();
        //         return 'Are you sure you want to leave? You have unsaved changes.';
        //     }
        // });
        let isFormSubmitting = false;
        $(window).on('beforeunload', function(event) {
            if (!isFormSubmitting) {
                // Show a confirmation dialog
                var confirmationMessage = 'Are you sure you want to leave? You have unsaved changes.';
                (event || window.event).returnValue = confirmationMessage; // Cross-browser compatibility
                return confirmationMessage;
            }
        });
        $(document).on('click','#submit_btn',function(e){
            isFormSubmitting = true;
            $(".campaign-form").submit();
        });
        $('form').on('submit_failed', function(event) {
            isFormSubmitting = false;
        });
        {{--$(document).ready(function() {--}}
        {{--    // $('.note_description').each(function () {--}}
        {{--    //     const textarea = $(this);--}}
        {{--    //     if (!textarea.data("editor-instance")) {--}}
        {{--    //         ClassicEditor.create(this)--}}
        {{--    //             .then(editor => {--}}
        {{--    //                 // Store the editor instance in the data attribute to prevent re-initialization--}}
        {{--    //                 textarea.data("editor-instance", editor);--}}
        {{--    //--}}
        {{--    //                 // Listen for content changes in CKEditor--}}
        {{--    //                 editor.model.document.on('change:data', () => {--}}
        {{--    //                     const content = editor.getData();--}}
        {{--    //                     textarea.val(content); // Update the textarea value--}}
        {{--    //                     textarea.trigger('keyup'); // Trigger keyup for AJAX call--}}
        {{--    //                 });--}}
        {{--    //             })--}}
        {{--    //             .catch(error => {--}}
        {{--    //                 console.error("Error initializing CKEditor:", error);--}}
        {{--    //             });--}}
        {{--    //     }--}}
        {{--    // });--}}
        {{--    var debouncedAjaxCall = _.debounce(function() {--}}
        {{--        if ($(".campaign-form").valid()) {--}}
        {{--            html_this = $(this)--}}
        {{--            var formData = new FormData($('#campaign_form')[0]);--}}
        {{--            var selectedStatus = $('#formSelect').val();--}}
        {{--            formData.append('status', selectedStatus);--}}
        {{--            formData.append('play_or_resume', '1');--}}
        {{--            $.ajax({--}}
        {{--                url: "{{ route('store_campaign') }}",--}}
        {{--                type: 'POST',--}}
        {{--                data: formData,--}}
        {{--                processData: false,--}}
        {{--                contentType: false,--}}
        {{--                success: function(response) {--}}
        {{--                    console.log('Response:', response);--}}
        {{--                    if (response.is_valid == true){--}}
        {{--                        $('#campaign_id').val(response.campaign_id);--}}
        {{--                        $(html_this).closest('.taf-row').find('.campaign_detail_id_for_delete').attr('data-campaignDetailID',response.campaignDetail_id)--}}
        {{--                    } else {--}}
        {{--                        $('#campaign_id').val(response.campaign_id);--}}
        {{--                    }--}}
        {{--                },--}}
        {{--                error: function(jqXHR, textStatus, errorThrown) {--}}
        {{--                    console.log('Error:', textStatus, errorThrown);--}}
        {{--                }--}}
        {{--            });--}}
        {{--        }--}}
        {{--    }, 1000); // 1000 milliseconds = 1 second--}}
        {{--    // $(document).on('keyup', ".campaign_name, .campaign_stage, .message_type, .send_email_time, .subject_mail, .subject_description, .status", debouncedAjaxCall);--}}
        {{--    $(document).on('keyup', '.campaign_name, .campaign_stage, .message_type, .send_email_time, .subject_mail, .note_description, .subject_description, .status', function (event) {--}}
        {{--        debouncedAjaxCall(event); // Pass the event to the debounced function--}}
        {{--    });--}}
        {{--});--}}
        $(document).ready(function () {
            var debouncedAjaxCall = _.debounce(function () {
                if ($(".campaign-form").valid()) {
                    var formData = new FormData($('#campaign_form')[0]);
                    // $('.note_description').each(function () {
                    //     var editor = $(this).data("editor-instance");
                    //     if (editor) {
                    //         formData.append($(this).attr('name'), editor.getData());
                    //     }
                    // });
                    var selectedStatus = $('#formSelect').val();
                    formData.append('status', selectedStatus);
                    formData.append('play_or_resume', '1');

                    $.ajax({
                        url: "{{ route('store_campaign') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            console.log('Response:', response);
                            if (response.is_valid === true) {
                                $('#campaign_id').val(response.campaign_id);
                                $('.taf-row').find('.campaign_detail_id_for_delete').attr('data-campaignDetailID', response.campaignDetail_id);
                            } else {
                                $('#campaign_id').val(response.campaign_id);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log('Error:', textStatus, errorThrown);
                        }
                    });
                }
            }, 1000); // 1000 milliseconds = 1 second

            // Trigger AJAX call on keyup
            $(document).on('keyup', '.campaign_name, .campaign_stage, .message_type, .send_email_time, .subject_mail, .note_description, .subject_description, .status', function (event) {
                debouncedAjaxCall(event);
            });
        });


        $(document).on('click', '.btn-delete', function (event) {
            event.preventDefault();
            var campaignDetailID = $(this).attr('data-campaignDetailID');
            var clickedButton = $(this);
            if (clickedButton.closest('.taf-row').find('input, textarea').filter(function() {
                return $(this).val() !== '';
            }).length === 0) {
                clickedButton.closest('.taf-row').remove();
            } else {
                $.ajax({
                    url: "/delete_campaignDetail/" + campaignDetailID,
                    type: 'GET',
                    data: { id: campaignDetailID },
                    success: function(response) {
                        clickedButton.closest('.taf-row').remove();
                        console.log('Delete Response:', response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Delete Error:', textStatus, errorThrown);
                        alert('An error occurred while deleting the record.');
                    }
                });
            }
        });

    });

    function submitForm() {
        if ($(".campaign-form").valid()) { // Check if the form is valid
            var formData = new FormData($('#campaign_form')[0]);
            $.ajax({
                url: "{{ route('store_campaign') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.is_valid) { //Updated condition to check for truthiness.
                        $('#campaign_id').val(response.campaign_id);

                    } else {
                        $('#campaign_id').val(response.campaign_id);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Error:', textStatus, errorThrown);
                }
            });
        };
    };

    $(document).on("click", "#submit_btn", function() {
        if ($(".campaign-form").valid()) {
            showConfirmationDialog();
        } else {
            // There are validation errors, do not show the confirmation dialog
        }
    });

    // function showConfirmationDialog() {
    //     swal({
    //         title: 'Are You Sure You Want To Submit The Form?',
    //         icon: "warning",
    //         buttons: ["Cancel", "Yes!"],
    //     }).then(function(confirm) {
    //         if (confirm) {
    //             submitForm();
    //             var selectedStatus = $('#formSelect').val();
    //             swal("Form Submitted!", "Your form has been successfully submitted.", "success").then(function() {
    //                 if (selectedStatus === '1') {
    //                     window.location.href = '/campaign/campaign?campaign_type=active';
    //                 } else if (selectedStatus === '0') {
    //                     window.location.href = '/campaign/campaign?campaign_type=inactive';
    //                 }
    //             });
    //         }
    //     });
    // }
    function showConfirmationDialog() {
        Swal.fire({
            title: 'Are You Sure You Want To Submit The Form?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'Cancel',
        }).then(function(result) {
            if (result.isConfirmed) {
                submitForm();
                var selectedStatus = $('#formSelect').val();
                Swal.fire({
                    title: 'Form Submitted!',
                    text: 'Your form has been successfully submitted.',
                    icon: 'success',
                }).then(function() {
                    if (selectedStatus === '1') {
                        window.location.href = '/campaign/campaign?campaign_type=active';
                    } else if (selectedStatus === '0') {
                        window.location.href = '/campaign/campaign?campaign_type=inactive';
                    }
                });
            }
        });
    }

});
    {{--$(document).ready(function () {--}}
    {{--    var attachmentDropzone = [];--}}
    {{--    Dropzone.autoDiscover = false;--}}
    {{--    $(".attachmentDropzone").dropzone({--}}
    {{--        url: "{{route('upload_email_attachment')}}",--}}
    {{--        addRemoveLinks: true,--}}
    {{--        dictRemoveFileConfirmation: "Are you sure?",--}}
    {{--        maxFiles: 5,--}}
    {{--        removedfile: function (file) {--}}
    {{--            image_name = $(file._removeLink).attr('image_name')--}}
    {{--            id = $(file._removeLink).attr('id')--}}

    {{--            if (id == 'undefined') {--}}
    {{--                id = 0;--}}
    {{--            }--}}
    {{--            console.log(image_name);--}}
    {{--            attachmentDropzone = jQuery.grep(attachmentDropzone, function (value) {--}}
    {{--                return value != image_name;--}}
    {{--            });--}}
    {{--            $('#email_attachment').val(attachmentDropzone);--}}
    {{--            file.previewElement.remove();--}}
    {{--            $.ajax({--}}
    {{--                type: 'get',--}}
    {{--                url: "{{ route('remove_email_attachment') }}",--}}
    {{--                data: { image_name: image_name, id: id },--}}
    {{--                async: false,--}}
    {{--                success: function (result) {--}}
    {{--                    $('#product_div').html(result);--}}
    {{--                }--}}
    {{--            });--}}
    {{--        },--}}
    {{--        sending: function (file, xhr, formData) {--}}
    {{--            formData.append("_token", "{{ csrf_token() }}");--}}
    {{--        },--}}
    {{--        success: function (file, response) {--}}
    {{--            var day = $('#camp_day').attr('drop-day-id');--}}
    {{--            file.previewElement.classList.add("dz-success");--}}
    {{--            attachmentDropzone.push(response);--}}
    {{--            const hiddenInput = $('<input>')--}}
    {{--                .attr('type', 'hidden')--}}
    {{--                .attr('name', `campaign[${day}][mail_image][]`)--}}
    {{--                .val(response);--}}
    {{--            $('.attachmentDropzone').append(hiddenInput);--}}
    {{--            $('#email_attachments').val(attachmentDropzone.join(','));--}}
    {{--            $(file._removeLink).attr('image_name', response);--}}
    {{--        },--}}
    {{--        error: function (file, response) {--}}
    {{--            file.previewElement.classList.add("dz-error");--}}
    {{--        },--}}
    {{--        init: function () {--}}
    {{--            dropzone = this;--}}
    {{--            //customize by unaiz dont remove--}}
    {{--            this.on("maxfilesexceeded", function (file) {--}}
    {{--                this.removeFile(file);--}}
    {{--                swal.fire("File Limit exceeded!", "ERROR");--}}
    {{--            });--}}
    {{--            //customize by unaiz dont remove--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}
    $(document).ready(function () {
        Dropzone.autoDiscover = false;

        // Initialize all existing dropzones
        $(".attachmentDropzone").each(function () {
            initializeDropzone($(this));
        });

        function initializeDropzone(container) {
            let day = container.attr("drop-day-id"); // Get the specific day ID
            let reminderIndex = container.attr("drop-reminder-index"); // Get the specific reminder index

            let attachmentDropzone = []; // Array to store uploaded file references

            container.dropzone({
                url: "{{ route('upload_email_attachment') }}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                maxFiles: 5,
                acceptedFiles: "image/*",
                removedfile: function (file) {
                    let image_name = $(file._removeLink).attr("image_name");
                    attachmentDropzone = attachmentDropzone.filter(value => value !== image_name);

                    // Remove file preview from Dropzone
                    file.previewElement.remove();

                    // Optional: Make AJAX call to remove file from the server
                    $.ajax({
                        type: "GET",
                        url: "{{ route('remove_email_attachment') }}",
                        data: { image_name },
                        success: function () {
                            console.log("File removed successfully.");
                        },
                        error: function (error) {
                            console.error("Error removing file:", error);
                        },
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    attachmentDropzone.push(response);

                    // Append hidden input for the uploaded file
                    let hiddenInput = $('<input>')
                        .attr("type", "hidden")
                        .attr(
                            "name",
                            `campaign[${day}][reminders][${reminderIndex}][mail_attachment][]`
                        )
                        .val(response);
                    container.append(hiddenInput);
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        Swal.fire("File Limit exceeded!", "ERROR", "error");
                    });
                },
            });
        }

        // Initialize Dropzone dynamically when a new reminder is added
        $(document).on("click", ".btn_create", function () {
            let reminderContainer = $(this)
                .closest(".taf-form")
                .find(".attachmentDropzone")
                .last();
            initializeDropzone(reminderContainer);
        });
    });

//Toggle Attribute
$(document).ready(function() {
    toggleRequiredAttribute();
    $('.taf-row .message_type, .taf-row .dynamic_message_type').on('change', function() {
        toggleRequiredAttribute();
    });
    function toggleRequiredAttribute() {
        if ($('.taf-row .message_type').val() === 'phone') {
            $('.compaign_email_fields input').removeAttr('required');
        } else {
            $('.compaign_email_fields input').attr('required', 'required');
        }
    }
});

$(document).ready(function() {
    //Active Class on SideBar
    $('#taf-tabs').on('click', '.left-scroll .nav-tabs li', function(e) {
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
});
$(document).ready(function() {
    $('.template_folder').on('change', function() {
        var id = $(this).find('option:selected').attr('email-template');
        $.ajax({
            url: "{{ route('select_email_template') }}",
            type: 'get',
            data: {
                id: id
            },
            success: function(response) {
                if (response.success) {

                    $('#emailTemplateSelect').empty();
                    $('#emailTemplateSelect').append('<option value=""></option>');

                    $.each(response.template, function(index, template) {
                        $('#emailTemplateSelect').append(
                            '<option value="' + template.id + '">' + template.title + '</option>'
                        );
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error:', textStatus, errorThrown);
            }
        });
    });
});
</script>
@endpush
