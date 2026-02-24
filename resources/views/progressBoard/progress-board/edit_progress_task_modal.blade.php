
<div class="offcanvas-header">
    <h5 id="editOffcanvasRightLabel">Edit Task</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <form method="POST" action="{{ route('update_progress_task') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="assign_to_lead_id" id="task_lead_id">
        <input type="hidden" name="progress_name" id="progress_name">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title" class="form-label input_labels">Title</label>
                    <input class="form-control clr_input_fields borderRadius" type="text" id="title" name="title" value="{{ $task->title??"" }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mt-5">
                    <label for="high_priority" class="form-label input_labels ">Priority</label>
                    <div class="form-check form-check-inline mt-3">
                        @foreach($priorities as $key => $priority)
                            <input class="mx-3" type="radio" name="priority_id" id="priority{{ $key }}" value="{{ $priority->id }}"
                                   {{ isset($task) && $task->priority_id == $priority->id ? 'checked' : '' }}>
                            <label class="form-check-label fs-4" for="priority{{ $key }}">{{ $priority->name }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mt-5">
                    <label for="assign_to_user_id" class="form-label input_labels">Assign To User</label>
                    <select class="form-control clr_input_fields borderRadius select2" multiple name="assign_to_user_id[]" id="assign_to_user_id" required>
                        @foreach($taskUsers as $user)
                            <option value="{{$user->id}}" @if(isset($task) && in_array($user->id, $task->getTaskAssignUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="assign_to_lead_id" class="form-label input_labels">Assign To Team</label>
                    <select class="form-control clr_input_fields select2 borderRadius" name="assign_to_team_id" id="assign_to_team_id">
                        @foreach($teams as $team)
                            <option value="{{$team->id}}" @if(isset($task) && $team->id == $task->assign_to_team_id) selected @endif>{{$team->name}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('assign_to_team_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="due_date" class="form-label input_labels ">Due Date</label>
                    <input class="form-control clr_input_fields borderRadius" id="due_date" type="date" name="due_date" value="{{ $task->due_date }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="checkbox" name="link_to_job" id="link_to_job">
                    <label for="link_to_job" class="form-label input_labels ">Link To Job</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="note" class="form-label input_labels ">Note</label>
                    <textarea id="description" class="form-control clr_input_fields borderRadius" name="description">{!! $task->description??"" !!} }</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="images" class="form-label input_labels">Attachments</label>
                    <div action="#" id="editTaskDropzone" class="dropzone">
                        <div class="fallback">
                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                        </div>
                    </div>
                </div>
                <input type="hidden" name="task_attachment" id="edit_task_attachment">
            </div>
            <div class="canvas_footer">
                <div class="footer_left">
                    <a href="javascript:void(0)" class="text-primary">Select Template</a>
                </div>
                <div class="footer_right">
                    <button type="submit" class="btn green_btn">Create</button>
                    <button type="button" class="btn secondary_btn text-reset" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        var sum = 0;
        var task_attachment_arr = [];
        Dropzone.autoDiscover = false;
        $("#editTaskDropzone").dropzone({
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
                $('#edit_task_attachment').val(task_attachment_arr);
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
                $('#edit_task_attachment').val(task_attachment_arr);
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
</script>