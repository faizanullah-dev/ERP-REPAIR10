<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Task</h4>
            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/task/task/' . $task->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="task-edit-form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
{{--                @include ('task.task.form', ['submitButtonText' => 'Update'])--}}
                <section class="task_form">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                    <label for="title" class="col-md-4 control-label">{{ 'Title' }}</label>
                                    <input class="form-control" placeholder="Enter title" name="title" type="text" id="title" value="{{ $task->title??''}}" required>
                                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                    <label for="recipient-name" class="input_labels control-label">Priority:</label>
                                    <div class="form-check form-check-inline mt-3">
                                        @foreach($priorities as $key => $priority)
                                            <input class="mx-3" type="radio" name="priority_id" id="priority{{ $key }}" value="{{ $priority->id }}" @if((!old('priority_id') && isset($task) && $task->priority_id == $priority->id) || (old('priority_id') == $priority->id)) checked  @endif>
                                            <label class="form-check-label fs-4" for="priority{{ $key }}">{{ $priority->name }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                                    <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Assign To User' }}</label>
                                    <select class="form-control clr_input_fields borderRadius select2 assign_to_user_id" multiple="multiple" name="assign_to_user_id[]" id="assign_to_user_id" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" @if(isset($task) && in_array($user->id, $task->getTaskAssignUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}} </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('assign_to_user_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('due_date') ? 'has-error' : ''}}">
                                    <label for="due_date" class="col-md-4 control-label">{{ 'Due Date' }}</label>
                                    <input class="form-control" name="due_date" type="date" id="due_date" value="{{ $task->due_date??''}}" required>
                                    {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
                                    <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Lead ' }}</label>
                                    <select class="form-control clr_input_fields select2 borderRadius" name="assign_to_lead_id" id="assign_to_lead_id">
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

                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('assign_to_team_id') ? 'has-error' : ''}}">
                                    <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Team ' }}</label>
                                    <select class="form-control clr_input_fields select2 borderRadius" name="assign_to_team_id" id="assign_to_lead_id">
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}" @if(isset($task) && $team->id == $task->assign_to_team_id) selected @endif>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                    <label for="images" class="control-label">{{ 'Images/Documents' }}</label>
                                    <div action="#" id="EdittaskDropzone" class="dropzone">
                                        <div class="fallback">
                                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                    <label for="description" class="col-md-12 control-label">{{ 'Description' }}</label>
                                    <textarea class="form-control"  name="description" type="textarea" id="add_description">{!! $task->description??''!!}</textarea>
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <input type="hidden" name="task_attachment" id="task_attachment">
                            <div class="form-group">
                                <div class="d-flex justify-content-center save col-md-offset-4 col-md-4">
                                    <input class="btn btn-primary" type="submit" value="Update">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <script type="text/javascript">
                    $(document).ready(function () {
                        ['#add_description'].forEach(selector => {
                            ClassicEditor.create(document.querySelector(selector)).catch(console.error);
                        });
                    });
                    $(document).ready(function () {
                        $('.js-example-basic-multiple').select2();
                    });
                    $(document).ready(function () {
                        var sum = 0;
                        var task_attachment_arr = [];
                        Dropzone.autoDiscover = false;
                        $("#EdittaskDropzone").dropzone({
                            url: "{{route('upload_task_attachment')}}",
                            addRemoveLinks: true,
                            dictRemoveFileConfirmation: "Are you sure?",
                            //customize by unaiz dont remove
                            maxFiles: 5,
                            //customize by unaiz dont remove
                            removedfile: function (file) {
                                image_name = $(file._removeLink).attr('image_name')
                                id = $(file._removeLink).attr('id')

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
                            init: function () {  // start of getting existing imahes
                                dropzone = this;
                                //customize by unaiz dont remove
                                this.on("maxfilesexceeded", function (file) {
                                    this.removeFile(file);
                                    swal.fire("File Limit exceeded!", "ERROR");
                                });
                                //customize by unaiz dont remove
                            }
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
                        $(file._removeLink).attr('id', '{{ $attachment->id }}')
                        $(file._removeLink).attr('image_name', '{{ $attachment->name}}')
                        dropzone.files.push(file);
                        @endforeach
                        @endif

                    });

                    $(document).ready(function() {
                        // $.validator.addMethod("noSpace", function(value, element) {
                        //     return value.indexOf(" ") < 0;
                        // }, "Spaces are not allowed.");

                        $.validator.addMethod("taskDescription", function(value, element) {
                            if (editor) {
                                var editorContent = editor.getData().trim();
                                return editorContent.length !== 0;
                            }
                            return false;
                        }, "Description is required.");

                        $('#task-edit-form').validate({
                            ignore: [],
                            rules: {
                                title: {
                                    required: true,
                                    noSpace: true
                                },
                                'assign_to_user_id[]': {
                                    required: true
                                },
                                priority_id: {
                                    required: true
                                },
                                assign_to_lead_id: {
                                    required: true
                                },
                                assign_to_team_id: {
                                    required: true
                                },
                                description: {
                                    required:true,
                                    // taskDescription: true
                                }
                            },
                            messages: {
                                title: {
                                    required: "Please enter Title.",
                                    noSpace: "Spaces are not allowed."
                                },
                                'assign_to_user_id[]': {
                                    required: "Please Assign First."
                                },
                                priority_id: {
                                    required: "Please select Priority First."
                                },
                                assign_to_lead_id: {
                                    required: "Please Assign Lead."
                                },
                                assign_to_team_id: {
                                    required: "Please Assign Team."
                                },
                                description: {
                                    required: "Message field is required"
                                }
                            },
                            submitHandler: function(form) {
                                console.log("Form is valid! Submitting...");
                                form.submit();
                            },
                            invalidHandler: function(event, validator) {
                                console.log("Form is invalid! Preventing submission.");
                                event.preventDefault();
                            }
                        });

                        $('#task-edit-form').on('submit', function(event) {
                            if (!$(this).valid()) {
                                event.preventDefault();
                                console.log("Preventing form submission because it is invalid.");
                            }
                        });
                    });
                    {{--Testing--}}
                </script>
            </form>
        </div>
    </div>
</div>

