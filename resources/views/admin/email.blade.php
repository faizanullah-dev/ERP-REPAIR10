@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
@endpush


@section('content')
    <section class="target_table pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-headerr user_email">
                        <h5 class="">Email </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card email_links borderRadius20 box-shadow-card border-0">
                                    <div class="card-body">
                                        <div class="heading_check">
                                            <h3>Users</h3>
                                            <div class="chk_field">
                                                <input class="email_checkbox checkAll form-check-input" id="checkAll" type="checkbox"  name="checkAll" >
                                                <label for="checkAll">Select All</label>
                                            </div>
                                        </div>
                                        <input type="text" id="customerSearch" class="customersssSearch" placeholder="Search customers...">
                                        <ul class="nav username_and_checks user_mail_nav_scroll nav-pills flex-column mb-sm-auto mb-0 mt-5 align-items-center align-items-sm-start" id="menu">
                                            @forelse($customers as $customer)
                                                <li class="nav-item search_customer_for_search active-link">
                                                    <div class="chk_field">
                                                        <input class="email_checkbox checksingle customer_checked form-check-input" type="checkbox" customer-id="{{$customer->id}}" name="checked_customers" value="{{$customer->id??''}}">
                                                    </div>
                                                    <div href="" class="nav-link align-middle px-0">
                                                        <div class="user_icon">
                                                            <i class="fa-solid fa-user" style="color: #afafaf;"></i>
                                                        </div>
                                                        <span class="ms-1 d-none d-sm-inline user_name">{{$customer->name??''}}</span>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="nav-item active-link">
                                                    <div href="" class="nav-link align-middle px-0">
                                                        <div class="user_icon">
                                                            <i class="fa-solid fa-user" style="color: #afafaf;"></i>
                                                        </div>
                                                        <span class="ms-1 d-none d-sm-inline user_name">NO CUSTOMERS FOUND</span>
                                                    </div>
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inbox_section">
                                    <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                                        <div class="card-headerr middle_card_header ">
                                            <div class="left_menu_inbox">
                                                <div class="chk_field mr-2">
                                                    <input class="check_all_template form-check-input" type="checkbox">
                                                </div>
                                                <button type="button" class="btn btn-light delete_selected_email" data-action="delete-trash">
                                                    <span class="fa fa-trash"></span>
                                                </button>
                                            </div>
                                            <div class="inbox_with_icon">
                                                <i class="fa fa-home" aria-hidden="true"></i>
                                                <h4 class="mb-0">EMAIL TEMPLATE</h4>
                                            </div>
                                            <div class="right_menu">
                                                <button type="button" class="btn green_btn borderRadius add_task_modal_btn" data-bs-toggle="modal" data-bs-target="#createMailkModal">
                                                <i class="fa-solid fa-plus" style="color: #ffffff;"></i> Create
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body middle_card_body ">
                                            <div class="primary_general_tabs">
                                                <div class="myTabContent tab-content">
                                                    <div id="button2" class="buttonContent">
                                                        @forelse($emailTemplate as $key => $email)
                                                            <div class="single_msg inbox_msg click_email_template">
                                                                <div class="chk_field">
                                                                    <input class="check_all_email_template form-check-input" type="checkbox"  email-template-id="{{$email->id}}" name="checked_emails" value="{{$email->id??""}}">
                                                                </div>
                                                                <div class="inbox_detail_wrapper"  data-email-id="{{ $email->id }}">
                                                                    <div class="user_icon">
                                                                        <i class="fa-solid fa-file-invoice"></i>
                                                                    </div>
                                                                    <div class="inbox_detail">
                                                                        <p class="p-16 msg_title">{{$email->title??'Not Available'}}</p>
                                                                        <p class="p-12">{{$email->subject??'Not Available'}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div class="single_msg" >
                                                            <div class="inbox_detail_wrapper">
                                                                <div class="user_icon">
                                                                    <i class="fa-solid fa-file-invoice"></i>
                                                                </div>
                                                                <div class="inbox_detail">
                                                                    <p class="p-16 msg_title">No Emails Found</p>
                                                                </div>
                                                            </div>
                                                    </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="content_column">
                                    <div class="white-box">
                                        <div class="heading_btn_wrapper" >

                                        <h3>Create New Message </h3>
                                            <a href="{{url('userMailSend/user-mail-send')}}" class="btn m-0 green_btn_description green_btn borderRadius add_task_modal_btn" >
                                               Reset
                                            </a>
                                    </div>
                                        <form class="form-horizontal email_send" id="email_send" method="post" action="{{route('email_send')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label" for="subject">CC</label>
                                                        <input type="email" name="email_cc" id="email_cc" class="form-control"  placeholder="CC"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label" for="subject">BCC</label>
                                                        <input type="email" name="email_bcc" id="email_bcc" class="form-control"  placeholder="BCC"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label" for="subject">Subject</label>
                                                        <input type="text" name="subject" id="subject" class="form-control" required placeholder="Type here"/>
                                                        <input type="hidden" name="template_id" id="template_id" class="form-control"  placeholder="Type here"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 custom_attachment">
                                                    <div class="form-group">
                                                        <label class="control-label">Attachments *</label>
                                                        <div class="input_fields_wrap_right">
                                                            <div class="custom_add_inputs">
                                                                {{--<div class="col-md-11 p-0">--}}
                                                                    <input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" value=""/>
                                                                {{--</div>--}}
                                                                <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>
                                                            </div>
                                                            <button class="add_field_button btn green_btn" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="form-group template_attachment">
                                                        <label class="col-md-2 control-label" for="attachments-container">Attachments</label>
                                                        <div id="attachments-container" class="attachments-container">
                                                        </div>
                                                    </div>
                                                <div class="col-md-12  ">
                                                    <div class="form-group  tex_area_parent ">
                                                        <label class="col-md-2 control-label" for="description">Message</label>
                                                        <textarea type="text" name="message" id="description" rows="10" class="form-control p-5" required placeholder="Type here"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="message_btn mb-3">
                                                            <button type="submit" class="btn-button green_btn_description borderRadius border-0 mail_send_msg">Send Message  <span><i class="fa fa-paper-plane-o" aria-hidden="true"></i></span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- ====================modal================================modal================================modal============ -->
                            <div class="modal fade createMailkModal a-btn-light" id="createMailkModal"  tabindex="-1"  aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" >Create New Email Template </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ url('/emailTemplate/email-template') }}" accept-charset="UTF-8"
                                                  class="form-horizontal" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input name="email_template" value="1" type="hidden">
                                                @include ('emailTemplate.email-template.form')
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- ====================modal================================modal================================modal============ -->
                            <div class="">
                                {{$emailTemplate->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("ckrequired", function(value, element) {
            var id = $(element).attr('id');
            var editorInstance = CKEDITOR.instances[id];
            return !!(editorInstance && editorInstance.getData().length);
        }, "Message field is required");

        $("#email_send").validate({
            ignore: [],
            rules: {
                subject: {
                    required: true
                },
                message: {
                    ckrequired: true
                }
            },//ends rules..
            messages: {
                subject: {
                    required: "subject field is required"
                },
                message: {
                    ckrequired: "Message field is required"
                }
            }//ends messages
        });
    });
    $(".check_all_email").change(function () {
        $(".email_checkbox").prop('checked', $(this).prop("checked"));
    });
    $(".check_all_template").change(function () {
        $(".check_all_email_template").prop('checked', $(this).prop("checked"));
    });
    $(".email_checkbox").change(function () {
        if($(".email_checkbox").length==$(".email_checkbox:checked").length)
            $(".check_all_email").prop('checked', true);
        else
            $(".check_all_email").prop('checked', false);
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
    $(document).ready(function(){
        var phone_count = 1;
        $(".input_fields_wrap_right .add_field_button").click(function(){
            var tr = '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" value=""/> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';
            var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
            if (rowCount >= 1 && rowCount<=4){
                $('.input_fields_wrap_right').prepend("<div class='custom_add_inputs'>" + tr + "</div>");
            }
            phone_count++;
        });
        $(".input_fields_wrap_right").on('click', '.remove_button', function () {
            var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
            if (rowCount > 1){
                $(this).closest('.input_fields_wrap_right .custom_add_inputs').remove();
            }
        });
    });
    $(document).on('click', '.delete_selected_email', function (e) {
      event.preventDefault();
        var emailTemplateId = $('.check_all_email_template:checked').length;

        if (emailTemplateId === 0) {
          Swal.fire('Warning!', 'Please select at least one Email Template to delete.', 'warning');
           return;
        }
        var emailTemplateIDs = [];
        $('.check_all_email_template:checked').each(function () {
            emailTemplateIDs.push($(this).attr('email-template-id'));
        });

        function showConfirmationDialog() {
            Swal.fire({
                title: 'Are You Sure You Want To Delete The Email Template?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete_email_template') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            ids: emailTemplateIDs
                        },

                        success: function (result) {
                            if (result.status === true) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: result.message, // Message from the server
                                    icon: 'success',
                                    timer: 2000,
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'FAIL REQUEST!',
                                    text:   result.message, // Message from the server
                                    icon: 'fail',
                                    timer: 2000,
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        },

                        error: function (e) {
                            console.log(e.status);
                        }
                    });
                }
            });
        }
        showConfirmationDialog();
    });
    $('.template_attachment').hide();
    $(document).ready(function(){
        ClassicEditor.create(document.querySelector('#description'))
            .then(editor => {
                window.editorInstance = editor;
            })
            .catch(error => {
                console.error("Error initializing CKEditor 5:", error);
            });

        $('.click_email_template .inbox_detail_wrapper').on('click', function() {
            var email_id = $(this).data('email-id');
            $.ajax({
                url: '{{url("get_email_template")}}/' + email_id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('.custom_attachment').hide();
                    $('.template_attachment').show();
                    console.log(response); // Debugging
                    if (response && response.attachments) {
                        $('#subject').val(response.subject);
                        $('#template_id').val(response.id);
                        if (window.editorInstance) {
                            window.editorInstance.setData(response.body);
                        } else {
                            console.error("CKEditor 5 instance is not initialized.");
                        }
                        $('#attachments-container').empty();
                        if (response.attachments.length === 0) {
                            $('#attachments-container').append('<span>There are no attachments in this template</span>');
                        } else{
                                response.attachments.forEach(function(attachment){
                                var filepath = attachment.filepath;
                                var fileExtension = filepath.split('.').pop().toLowerCase();
                                var imgSrc;
                                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                                    imgSrc = filepath;
                                } else if (fileExtension === 'pdf') {
                                    imgSrc = '{{ asset("/website/images/pdf.png") }}';
                                } else if (['doc', 'docx', 'txt'].includes(fileExtension)) {
                                    imgSrc = '{{ asset("/website/images/Word-Logo.png") }}';
                                } else {
                                    imgSrc = '{{ asset("/website/images/image.png") }}';
                                }//end if.
                                var img = $('<img>').attr('src', imgSrc).attr('alt', 'Attachment').css({ maxWidth: '100px', maxHeight: '100px' });
                                var link = $('<a>').attr('href', filepath).append(img);
                                $('#attachments-container').append(link);
                            });//end forEach.
                        }//end else if..
                    }//end if
                },//end success.
            });//end ajax.
        });//end click.
    });//end ready.


    $(document).ready(function() {
        $('#email_send').on('submit', function(e) {
            var user_ids = [];
            $('.customer_checked:checked').each(function() {
                var contact_id = $(this).attr('customer-id');
                user_ids.push(contact_id);
                $('#email_send').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                e.preventDefault();
                Swal.fire({
                    title: 'Please select Customer first',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('input[name="user_ids[]"]').remove();
                $.each(user_ids, function(index, value) {
                    $('#email_send').append($('<input>', { type: 'hidden', name: 'user_ids[]', value: value }));
                });
            }
        });
    });
    $(document).ready(function() {
        $("#customerSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".search_customer_for_search").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)//ends toggle
            });//end filter
        });
    });
  $(document).ready(function() {
    $('#checkAll').click(function() {
      $('.checksingle').prop('checked', this.checked);
    });
    $('.checksingle').click(function() {
      $('#checkAll').prop('checked', $('.checksingle:checked').length === $('.checksingle').length);
    });
  });
</script>
@endpush
