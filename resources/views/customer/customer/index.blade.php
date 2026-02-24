@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
                <div class="white-box lead_lead_page my_lead_parent">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box-header">
                                <div class="white-box-header-left">
                                    <h3 class="box-title">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer ') }}</h3>
                                </div>
                                <div class="white-box-header-right">
                                    @can('add-'.str_slug('Customer'))
                                        <a class="btn blue_btn" href="{{ url('/customer/customer/create') }}">Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer') }}<i class="icon-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="logoBtn_drop_wrapper ">
                                <div class="logobtn_left_box button_logo">
                                    <button type="button" class="btn borderRadius delete_inbox_email green_btn" data-notification-id="" id="btn-delete-multiple" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"> <span class="fa fa-trash-o"></span> </button>
                                    <button type="button" class="btn green_btn borderRadius add_job_note_modal_btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"> <span class="fa fa-envelope"></span> </button>
{{--                                    <a href="{{url('user_view')}}" class="btn border_btns borderRadius">View Cards</a>--}}
{{--                                    <a href="{{url('lead_card_view?lead_card_view_status=unarchive')}}" class="btn border_btns borderRadius">Leads</a>--}}
{{--                                    <a href="{{url('appointment/appointment')}}" class="btn border_btns borderRadius">Appointments</a>--}}
{{--                                    <a href="{{url('lead_card_view?lead_type=won')}}" class="btn border_btns borderRadius">Sold</a>--}}
                                </div>
                                <div class="logobtn_right_box customer_right_logo_btn">
                                   <button type="button" class="btn green_btn  exportToExcel" data-bs-toggle="tooltip" data-bs-placement="top" title="Export to Excel">
                                       <i class="fa-solid fa-file-excel"></i>
                                   </button>
                                    <div class="view_type_box" >
                                        <a href="{{ url('user_view') }}" class="btn green_btn {{ Request::is('lead_card_view') ? 'active' : '' }}"><img class="img-fluid" src="{{ asset('/website/images').'/cards-blank.svg' }} " ></a>
                                        <a href="{{ url('customer/customer') }}" class="btn green_btn {{ Request::is('customer/customer') ? 'active' : '' }}"><i class="fa-solid fa-list"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form method="get" action="{{url('customer/customer')}}" id="filter-form">
                                <div class="  filter_inputs_btns_wrapper form-group">
                                    <input type="hidden" name="customer_filter" value="yes">
                                    @php
                                        if (request()->get('duration_starts') && request()->get('duration_ends')) {
                                            $yearEstimation = (object) [
                                                'year' => request()->get('duration_starts')
                                            ];
                                            $durationEnds = request()->get('duration_ends');
                                        } else {
                                            $durationEnds = now()->endOfYear()->format('Y-m-d');
                                        }
                                    @endphp
                                    <div class=" filter_inputs_parent">
                                        <label for="duration_starts" class="form-label input_labels p-18">To </label>
                                        <input class="form-control clr_input_fields borderRadius"  name="duration_starts" value="{{ request()->get('duration_starts') ?? $yearEstimation->year . '-01-01' }}" type="date" id="duration_starts" required placeholder="Enter duration_starts"  >
                                    </div>
                                    <div class="filter_inputs_parent">
                                        <label for="duration_ends" class="form-label input_labels p-18">From </label>
                                        <input class="form-control clr_input_fields borderRadius" name="duration_ends" type="date" value="{{ request()->get('duration_ends') ?? $yearEstimation->year . '-12-31' }}" id="duration_ends" required placeholder="duration_ends to_date"  >
                                    </div>
                                    <div class="   filter_inputs_parent filter_btns_parent">
                                        <div class="reset_apply_btn">
                                            <button type="submit" class="btn blue_btn ">Apply <i class="fa-solid fa-check"></i></button>
                                            <a href="{{ url('customer/customer') }}" class="btn gray_btn ">Reset <img class="img-fluid" src="{{ asset('/website/images').'/recycle.svg' }} " ></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="myTable">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="custom_checkbox">
                                                <input class="noti_check" type="checkbox"  name="notify_check" id="notify_check" >
                                                <label for="notify_check"></label>
                                            </div>
                                        </th>
{{--                                        <th> Category </th>--}}
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Referral Source </th>
                                        <th>Status</th>
                                        <th> Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customer as $item)
                                        <tr class="customer-check">
                                            <td>
                                                <div class="custom_checkbox">
                                                    <input class="noti_check noti_checks" type="checkbox" id="notify_check_{{ $item->id }}" data-customerCheck-id="{{ $item->id }}">
                                                    <label for="notify_check_{{ $item->id }}"></label>
                                                </div>
                                            </td>
{{--                                            <td>{{ str_limit($item->profile->category->name??"Not Available",10) }}</td>--}}
                                            <td>{{ $item->first_name.' '.$item->last_name??"Not Available" }}</td>
                                            <td>{{ $item->email??"Not Available" }}</td>
                                            <td>{{ $item->referralSource->name??"Not Available" }}</td>
                                            <td>
                                                <div class="lead_check">
                                                    <div class="status_btn">
                                                        <label for="status-{{ $item->id }}">
                                                            <a href="#" class="toggle-status"
                                                               data-id="{{ $item->id }}"
                                                               data-status="{{ $item->status }}">
                                                                <badge class="badge {{ $item->status == 1 ? 'badge-success' : 'badge-secondary' }}">
                                                                    {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                                                </badge>
                                                            </a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="btn_td">
                                                @can('view-'.str_slug('Customer'))
                                                    <a href="{{ url('/customer/customer/' . $item->id) }}"
                                                       title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer') }}">
                                                        <button class="btn view_btn btn-sm">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </a>
                                                @endcan
                                                @can('edit-'.str_slug('Customer'))
                                                    <a href="{{ url('/customer/customer/' . $item->id . '/edit') }}"
                                                       title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer') }}">
                                                        <button class="btn edit_btn btn-sm">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </button>
                                                    </a>
                                                @endcan
                                                @can('delete-'.str_slug('Customer'))
                                                    <form method="POST"
                                                          action="{{ url('/customer/customer' . '/' . $item->id) }}"
                                                          accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="button" class="btn delete_btn btn-sm"
                                                                title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer') }}"
                                                                onclick="showDeleteConfirmation(this)">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--                        <div class="pagination-wrapper"> {!! $customer->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="addEmails" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Emails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal emailValidate" method="get" id="email_form" action="{{ route('send_email_to_users') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailTemplateSelect" class="form-label input_labels">Select Email Template <span class="text-danger">*</span></label>
                                    <select class="form-control clr_input_fields borderRadius select2 email_template" id="emailTemplateSelect" name="email_template_id">
                                        <option value="" selected>None</option>
                                        @foreach($emailTemplates as $emailTemplate)
                                            <option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject" class="form-label input_labels">Subject <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form-control subject_mail" placeholder="Enter Subject" id="subject" required>
                                </div>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Attachments *</label>--}}
{{--                                    --}}{{--                                    <div class="input_fields_wrap_right">--}}
{{--                                    --}}{{--                                        <div class="custom_add_inputs">--}}
{{--                                    --}}{{--                                            <input type="file" name="mail_attachment[]" class="form-control" />--}}
{{--                                    --}}{{--                                            <button class="btn remove_button" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>--}}
{{--                                    --}}{{--                                        </div>--}}
{{--                                    --}}{{--                                        <div class="inner_btn">--}}
{{--                                    --}}{{--                                            <button class="add_field_button btn btn-warning" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>--}}
{{--                                    --}}{{--                                            <div id="imageContainer"></div>--}}
{{--                                    --}}{{--                                        </div>--}}
{{--                                    --}}{{--                                    </div>--}}
{{--                                    <div id="attachmentDropzone" class="dropzone"></div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                    <label for="images" class="control-label">{{ 'Attachments' }} <span class="text-danger">*</span></label>
                                    <div action="#" id="attachmentDropzone" class="dropzone">
                                        <div class="fallback">
                                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                                        </div>

                                    </div>
                            </div>
{{--                                <input type="file" name="mail_attachment[]" id="email_attachment">--}}
{{--                                <input type="hidden" name="mail_attachment[]" id="email_attachments">--}}
                            </div>
                            <div id="imageContainer"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mailDescription" class="input_labels control-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control subject_description" rows="5" name="description" id="mailDescription"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel <i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <button class="btn green_btn borderRadius add_task_modal_btn" type="submit">Submit <i class="fa-solid fa-check"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    <div class="modal" id="addAnnouncement" tabindex="-1" aria-hidden="true">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title" id="addJob">Annoucement</h5>--}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    <form class="form-horizontal" method="get" id="announcement_form" action="{{route('annoucement_assign_to_users')}}" enctype="multipart/form-data">--}}
    {{--                    <form class="form-horizontal announcementValidation" method="POST" id="announcement_form" action="{{route('annoucement_assign_to_staff')}}" enctype="multipart/form-data">--}}
    {{--                        @csrf--}}
    {{--                        <div class="modal-body">--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-md-12">--}}
    {{--                                    <div class="form-group">--}}
    {{--                                        <label for="recipient-name" class="input_labels control-label">Description:</label>--}}
    {{--                                        <textarea class="form-control" rows="5" name="description" type="textarea" id="announcmentDescription" required></textarea>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}

    {{--                                    <div class="form-group">--}}
    {{--                                        <div class="d-flex justify-content-center">--}}
    {{--                                        <button class="btn green_btn borderRadius add_task_modal_btn" type="submit">Submit</button>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

@endsection

@push('js')
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        let ckeditorInstance;
        $(document).ready(function() {
            ClassicEditor
                .create(document.querySelector('#mailDescription'))
                .then(editor => {
                    ckeditorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        });
        $(document).ready(function () {
            // let editor;
            // if (typeof ClassicEditor !== "undefined") {
            //     ClassicEditor
            //         .create(document.querySelector('#mailDescription'))
            //         .then(newEditor => {
            //             editor = newEditor;
            //             editor.model.document.on('change:data', function() {
            //                 $('#email_form').valid();
            //             });
            //         })
            //         .catch(error => {
            //             console.error(error);
            //         });
            // } else {
            //     console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            // }
            // $.validator.addMethod("editorRequired", function(value, element) {
            //     if (editor) {
            //         var editorContent = editor.getData().trim();
            //         return editorContent.length !== 0;
            //     }
            //     return false;
            // }, "Description is required.");
            $('#email_form').validate({
                ignore: [],
                rules: {
                    // email_template_id: {
                    //     required: true
                    // },
                    subject: {
                        required: true
                    },
                    // description: {
                    //     editorRequired: true
                    // }
                },
                messages: {
                    // email_template_id: {
                    //     required: "Email Template is required."
                    // },
                    subject: {
                        required: "Subject is required."
                    },
                    // description: {
                    //     editorRequired: "Description is required."
                    // }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });


        $(document).ready(function () {
            var attachmentDropzone = [];
            Dropzone.autoDiscover = false;
            $("#attachmentDropzone").dropzone({
                url: "{{route('upload_email_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                maxFiles: 5,
                removedfile: function (file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if (id == 'undefined') {
                        id = 0;
                    }
                    console.log(image_name);
                    attachmentDropzone = jQuery.grep(attachmentDropzone, function (value) {
                        return value != image_name;
                    });
                    $('#email_attachment').val(attachmentDropzone);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_email_attachment') }}",
                        data: { image_name: image_name, id: id },
                        async: false,
                        success: function (result) {
                            $('#product_div').html(result);
                        }
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    attachmentDropzone.push(response);
                    const hiddenInput = $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'mail_attachments[]') // Use an array name to handle multiple files
                        .val(response);
                    $('#attachmentDropzone').append(hiddenInput);
                    $('#email_attachments').val(attachmentDropzone.join(','));

                    $(file._removeLink).attr('image_name', response);
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!", "ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
        });

        // $(document).ready(function () {
        //     CKEDITOR.replace('announcmentDescription');
        // });

        $(document).ready(function () {
            $('#notify_check').change(function () {
                if (this.checked) {
                    $('.noti_checks').prop('checked', true);
                } else {
                    $('.noti_checks').prop('checked', false);
                }
            });
        });
        $(document).ready(function () {
            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [0]
                }]
            });
        });

        $(document).on('click', '#btn-delete-multiple', function (event) {
            event.preventDefault();
            var selectedStaffCount = $('.noti_checks:checked').length;
            if (selectedStaffCount === 0) {
                Swal.fire('Warning!', 'Please select at least one customer  to delete.', 'warning');
                return;
            }
            showConfirmationDialog();
        });

        function showConfirmationDialog() {
            Swal.fire({
                title: 'Are You Sure You Want To Delete The Customer?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    deleteSelectedCustomers();
                }
            });
        }
        function deleteSelectedCustomers() {
            selectedCustomerIDs = [];
            $('.noti_checks:checked').each(function () {
                selectedCustomerIDs.push($(this).attr('data-customerCheck-id'));

            });

            $.ajax({
                url: "{{ route('customer_multiple_delete') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    ids: selectedCustomerIDs
                },
                success: function (response) {
                    selectedCustomerIDs.forEach(function (id) {
                        $('.noti_checks[data-customerCheck-id="' + id + '"]').closest('.customer-check').remove();
                    });
                    if (response == "success") {
                        Swal.fire({
                            title: "Selected Customer Deleted Successfully",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        });
                    }
                    console.log('Delete IDS:', selectedCustomerIDs);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Delete Error:', textStatus, errorThrown);
                }
            });
        }


        // $(document).ready(function () {
        //     var phone_count = 1;
        //     $(".input_fields_wrap_right .add_field_button").click(function () {
        //         var tr = '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" value=""/> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';
        //         var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
        //         if (rowCount >= 1 && rowCount <= 4) {
        //             $('.input_fields_wrap_right').prepend("<div class='custom_add_inputs'>" + tr + "</div>");
        //         }
        //         phone_count++;
        //     });
        //
        //     $(".input_fields_wrap_right").on('click', '.remove_button', function () {
        //         var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
        //         if (rowCount > 1) {
        //             $(this).closest('.input_fields_wrap_right .custom_add_inputs').remove();
        //         }
        //     });
        // });
        $(document).on('click','.add_job_note_modal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-customerCheck-id');
                user_ids.push(contact_id);
                $('#email_form').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select customer first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addEmails').modal('show');
            }
        })

        //  $(document).on('click','.add_assign_annoucement',function(e){
        //     e.preventDefault();
        //     var user_ids = [];
        //     $('.noti_checks:checked').each(function(){
        //         var contact_id = $(this).attr('data-customerCheck-id');
        //         user_ids.push(contact_id);
        //         $('#announcement_form').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
        //     });
        //     if (user_ids.length === 0) {
        //         Swal.fire({
        //             title: 'please select customer first',
        //             text: '',
        //             icon: 'info',
        //             confirmButtonColor: '#3085d6',
        //             confirmButtonText: 'Ok',
        //             timer: 5000,
        //         });
        //     } else {
        //         $('#addAnnouncement').modal('show');
        //     }
        // })


        $(document).ready(function() {
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "This field is required");
            $('.announcementValidation').validate({
                ignore: [],
                rules: {
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    description: {
                        ckrequired: "Description required."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(document).ready(function() {
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "This field is required");
            $('.emailValidate').validate({
                ignore: [],
                rules: {
                    subject: {
                        required: true
                    },
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    subject: {
                        required: "Subject required."
                    },
                    description: {
                        ckrequired: "Description required."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });
        /* $(document).on('change', '.email_template', function() {
             var templateId = $(this).val();
             $.ajax({
                 url: '/getCampaignEmailTemplate/' + templateId,
                 type: 'GET',
                 success: function(response) {
                     console.log(response);
                     $('.subject_mail').val(response.subject);
                     if (CKEDITOR.instances.mailDescription) {
                         CKEDITOR.instances.mailDescription.setData(response.note);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error(xhr.responseText);
                 }
             });
         });*/

        $(document).on('change', '.email_template', function() {
            var templateId = $(this).val();
            $('#attachmentDropzone ').html('')
            $.ajax({
                url: '/getCampaignEmailTemplate/' + templateId,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    $('.subject_mail').val(response.subject);
                    if (ckeditorInstance) {
                        ckeditorInstance.setData(response.note);
                    }
                    // Clear the image container
                    $('#imageContainer').empty();
                    if (response.images.length > 0) {
                        response.images.forEach(function(image) {
                            var img = $('<img>', {
                                src: image.url,
                                height: 100,
                                width: 100,
                                alt: 'Image for ' + image.name
                            });
                            $('#attachmentDropzone ').append(`<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
                                            <div class="dz-image">
                                                <img data-dz-thumbnail="" alt="laptop.png" src="`+image.url+`">
                                            </div>
                                            <div class="dz-details">
<!--                                                <div class="dz-size">-->
<!--                                                    <span data-dz-size="">-->
<!--                                                        <strong>0.4</strong> MB</span>-->
<!--                                                </div>-->
                                                <div class="dz-filename">
                                                    <span data-dz-name="">`+image.name+`</span>
                                                </div>
                                            </div>
                                            <div class="dz-progress">
                                                <span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span>
                                            </div>
                                            <div class="dz-error-message"><span data-dz-errormessage=""></span>
                                            </div>  <div class="dz-success-mark">
                                                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Check</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>      </g>    </svg>  </div>  <div class="dz-error-mark">    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>
                                            </div>
                                            <input type="hidden" name="mail_attachments[]" value="`+image.name+`">
<!--                                            <a class="dz-remove" href="javascript:undefined;" data-dz-remove="" image_name="`+image.name+`">Remove file</a>-->
                                        </div>`);

                            // $('#imageContainer').append(img);
                        });
                    } else {
                        $('#imageContainer').append('<p>No images available for this template.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        $(document).ready(function () {
            $(document).on('click', '.exportToExcel', function () {
                $('.preloader').fadeIn();
                $('body').css('overflow-y', 'hidden');

                $.ajax({
                    url: "{{ url('customers/export') }}",
                    method: 'GET',
                    data: {
                        customer_filter: '{{ request()->customer_filter }}',
                        duration_starts: '{{ request()->duration_starts }}',
                        duration_ends: '{{ request()->duration_ends }}'
                    },
                    success: function (data) {
                        console.log(data);
                        const customers = data.map(customer => ({
                            'Customer Name': (customer.first_name + ' ' + customer.last_name) || 'Not Available',
                            'Customer Number': customer.created_at
                                ? 'R' + new Date(customer.created_at).toISOString().slice(2, 10).replace(/-/g, '')
                                : 'Not Available',
                            'Email': customer.email || 'Not Available',
                            'Created At': customer.created_at
                                ? new Date(customer.created_at).toISOString().slice(0, 10)
                                : 'Not Available',
                            'Phone Number': customer.profile?.phone || 'Not Available',
                            'Category': customer.profile?.category?.name || 'Not Available',
                            'Address': customer.profile?.address || 'Not Available',
                            'City': customer.profile?.city || 'Not Available',
                            'State': customer.profile?.state || 'Not Available',
                            'Zip': customer.profile?.zip || 'Not Available',
                            'Total Won Jobs': customer.customerLeads || '0',
                            'Total Won Job Price': customer.total_job_price != null ? `$${Number(customer.total_job_price).toFixed(2)}` : '0'
                        }));

                        const ws = XLSX.utils.json_to_sheet(customers);
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, 'Customers');

                        const headers = [
                            'Customer Name', 'Customer Number', 'Email', 'Created At', 'Phone Number',
                            'Category', 'Address', 'City', 'State', 'Zip', 'Total Won Jobs', 'Total Won Job Price'
                        ];
                        XLSX.utils.sheet_add_aoa(ws, [headers], { origin: 'A1' });

                        XLSX.writeFile(wb, 'customers_export.xlsx');

                        $('.preloader').fadeOut();
                        $('body').css('overflow-y', 'auto');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching customer data:', error);
                        alert('Failed to export customers. Please try again.');
                        $('.preloader').fadeOut();
                        $('body').css('overflow-y', 'auto');
                    }
                });
            });
        });


    </script>

    <script>
        $(document).on('click', '.toggle-status', function(e) {
            e.preventDefault();

            let button = $(this);
            let userId = button.data('id');
            let currentStatus = button.data('status');
            let newStatus = currentStatus == 1 ? 2 : 1;

            // Call the SweetAlert confirmation
            confirmAndDisable(button, userId, newStatus, currentStatus);
        });

        function confirmAndDisable(link, userId, newStatus, currentStatus) {
            // SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change the status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Disable the link after confirmation
                    link.addClass('disabled');

                    // Perform the AJAX request to update the status
                    $.ajax({
                        url: "{{ url('update-user-status') }}/" + userId,
                        method: 'POST',
                        data: {
                            status: newStatus,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if(response.success) {
                                link.data('status', newStatus);
                                let badge = link.find('.badge');
                                if(newStatus == 1) {
                                    badge.removeClass('badge-secondary').addClass('badge-success').text('Active');
                                } else {
                                    badge.removeClass('badge-success').addClass('badge-secondary').text('Inactive');
                                }
                            } else {
                                alert('Failed to update status.');
                            }
                            link.removeClass('disabled'); // Re-enable the link
                        },
                        error: function() {
                            alert('Error occurred while updating status.');
                            link.removeClass('disabled'); // Re-enable the link
                        }
                    });
                }
            });
        }


    </script>
@endpush
