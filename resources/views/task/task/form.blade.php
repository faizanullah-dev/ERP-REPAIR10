@push('css')
{{--<link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />--}}
@endpush

<section class="task_form">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                    <label for="title" class="control-label">{{ 'Title' }} <span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="Enter title" name="title" type="text" id="title" value="{{ $task->title??''}}" required>
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                    <label for="assign_to_user_id" class="control-label">{{ 'Assign To User' }} <span class="text-danger">*</span></label>
                    <select class="form-control custom_modal_select2 borderRadius "  name="assign_to_user_id[]" id="assign_to_user_id"  data-placeholder="Select User" required>
                        @foreach($taskUsers as $user)
                            <option value="{{$user->id}}" @if(isset($task) && in_array($user->id, $task->getTaskAssignUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}} </option>
                        @endforeach
                    </select>
                    {!! $errors->first('assign_to_user_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-check form-check-inline required_error custom_radio_button">
                        <label for="priority_id" class="control-label w-100">{{ 'Priority' }}<span class="text-danger">*</span> </label>
                        @foreach($priorities as $key => $priority)
                            <input class="form-check-input" type="radio" name="priority_id" id="priority{{ $key }}" value="{{ $priority->id }}" @if((!old('priority_id') && isset($task) && $task->priority_id == $priority->id) || (old('priority_id') == $priority->id)) checked  @endif required>
                            <label class="form-check-label fs-4" for="priority{{ $key }}">{{ $priority->name }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"> Send Email </label>
                    <div class="form-check form-check-custom form_check_bottom">
                        <input class="form-check-input" type="checkbox" name="send_email" id="send_email"  />
                        <label class="form-check-label" for="send_email">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('due_date') ? 'has-error' : ''}}">
                    <label for="due_date" class="control-label">{{ 'Due Date' }} </label>
                    <input class="form-control" name="due_date" type="date" id="due_date"   value="{{ $task->due_date ?? date('Y-m-d') }}" required>
                    {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
                    <label for="assign_to_lead_id" class="control-label">{{ 'Assign To Lead ' }} </label>
                    <select class="form-control    borderRadius assign_lead_readonly" name="assign_to_lead_id" id="assign_to_lead_id" required>
                        @if(!empty($leadExist))
                            @foreach($leads as $lead)
                                <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                            @endforeach
                        @else
                            @foreach($leads as $lead)
                                <option value="{{$lead->id}}" @if(isset($task) && $lead->id == $task->assign_to_lead_id) selected @endif>{{$lead->title}}</option>
                            @endforeach
                        @endif
                    </select>
                    {!! $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('assign_to_team_id') ? 'has-error' : ''}}">
                    <label for="assign_to_lead_id" class="control-label">{{ 'Assign To Team ' }} </label>
                    <select class="form-control  borderRadius custom_modal_select2 add_task_select_modal assign_to_lead_id" name="assign_to_team_id" id="" data-placeholder="Select Team">
                        <option value="">Select Team</option>
                            @foreach($teams as $team)
                                <option value="{{$team->id}}" @if(isset($task) && $team->id == $task->assign_to_team_id) selected @endif>{{$team->name}}</option>
                            @endforeach
                    </select>
                    {!! $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"> Notify on complete  </label>
                    <div class="form-check form-check-custom form_check_bottom">
                        <input class="form-check-input" type="checkbox" name="" id=""  />
                        <label class="form-check-label" for=""> Yes</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group  {{ $errors->has('images') ? 'has-error' : ''}}">
                    <label for="images" class="control-label">{{ 'Images/Documents' }} <span class="text-danger">*</span></label>
                    <div action="#" id="taskDropzone" class="dropzone">
                        <div class="fallback">
                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                        </div>
                    </div>
                </div>
                <input type="hidden" name="task_attachment" id="task_attachment">

            </div>
            <div class="col-md-12">
                <div class="error_positioned_parent">
                <div class="form-group w-100  {{ $errors->has('description') ? 'has-error' : ''}}">
                    <label for="description" class="control-label">{{ 'Description' }} </label>
                    <textarea class="form-control" rows="5" name="description" type="textarea" id="description-task" >{{ $task->description??''}}</textarea>
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-0 text-center">
                    <input class="btn btn-green task_submit_modal_btn" type="submit" value="{{ $submitButtonText??'Create' }}">
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
{{--    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>--}}

    {{--<script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>--}}
{{--<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>--}}
    <script type="text/javascript">

        $(document).ready(function () {



            // Add custom method to check for spaces
            // $.validator.addMethod("noSpace", function(value, element) {
            //     return value.trim().length !== 0;
            // }, "Spaces are not allowed.");

            // Initialize CKEditor
            let editor;
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector('#description-task'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            }

            // Custom validation for CKEditor
            $.validator.addMethod("taskDescription", function(value, element) {
                if (editor) {
                    var editorContent = editor.getData().trim();
                    return editorContent.length !== 0;
                }
                return false;
            }, "Description is required.");

            // Validate form
            // $('#task-form').validate({
            //     ignore: [],
            //     rules: {
            //         title: {
            //             required: true,
            //             noSpace: true
            //         },
            //         'assign_to_user_id[]': {
            //             required: true,
            //             minlength: 1  // at least one user must be selected
            //         },
            //         priority_id: {
            //             required: true
            //         },
            //         assign_to_lead_id: {
            //             required: true
            //         },
            //         // assign_to_team_id: {
            // //             required: true
            // //         },
            //         // description: {
            //         //     taskDescription: true
            //         // }
            //     },
            //     messages: {
            //         title: {
            //             required: "Please enter Title.",
            //             noSpace: "Spaces are not allowed."
            //         },
            //         'assign_to_user_id[]': {
            //             required: "Please select at least one user.",
            //             minlength: "Please select at least one user."
            //         },
            //         priority_id: {
            //             required: "Please select Priority First."
            //         },
            //         assign_to_lead_id: {
            //             required: "Please Assign Lead."
            //         },
            //         // assign_to_team_id: {
            //         //     required: "Please Assign Team."
            // //         },
            //         // description: {
            //         //     taskDescription: "Message field is required"
            // //         }
            //     },
            //     errorPlacement: function(error, element) {
            //         if (element.hasClass('select2')) {
            //             // place error after select2 container
            //             error.insertAfter(element.next('.select2-container'));
            //         } else {
            //             error.insertAfter(element);
            //         }
            //     },
            //     submitHandler: function(form) {
            //         form.submit();
            //     }
            // });

            // Dropzone
            var sum = 0;
            var task_attachment_arr = [];
            Dropzone.autoDiscover = false;
            var dropzone = new Dropzone("#taskDropzone", {
                url: "{{route('upload_task_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                maxFiles: 5,
                acceptedFiles: "image/*",
                removedfile: function (file) {
                    image_name = $(file._removeLink).attr('image_name');
                    id = $(file._removeLink).attr('id');
                    if (id == 'undefined') {
                        id = 0;
                    }
                    console.log(image_name);
                    task_attachment_arr = jQuery.grep(task_attachment_arr, function (value) {
                        return value != image_name;
                    });
                    $('#task_attachment').val(task_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_task_attachment') }}",
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
                    task_attachment_arr.push(response);
                    $('#task_attachment').val(task_attachment_arr);
                    $(file._removeLink).attr('image_name', response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!", "ERROR");
                    });

                    @if (isset($task -> images) && $task -> images != null)
                    @foreach($task -> images as $attachment)
                    var file = {
                        name: "{{ explode('.',$attachment->name)[1]}}",
                        size: "{{ filesize(public_path().'/website/'.@$attachment->name) }}",
                        status: Dropzone.ADDED,
                        accepted: true
                    };
                    dropzone.emit("addedfile", file);
                    @if (isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif', 'x-shockwave-flash']))
                    dropzone.emit("thumbnail", file, "{{ asset('/website').'/'.$attachment->name }}");
                    @elseif(isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['pdf']))
                    dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/pdf.png' }}");
                    @elseif(isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['doc', 'docx']))
                    dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
                    @else
                    dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
                    @endif
                    dropzone.emit("complete", file);
                    $(file._removeLink).attr('id', '{{ $attachment->id }}');
                    $(file._removeLink).attr('image_name', '{{ $attachment->name}}');
                    dropzone.files.push(file);
                    @endforeach
                    @endif
                }
            });
        });

        // Submit form from modal
        $(document).on('click', '.task_submit_modal_btn', function (e) {
            e.preventDefault();
            if ($('#task-form').valid()) {
                $('#task-form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });
    </script>

@endpush
