@push('css')
<link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endpush
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">

    <label for="title" class="col-md-4 control-label">{{ 'Title' }}</label>
    <div class="col-md-6">
        <input class="form-control" placeholder="Enter title" name="title" type="text" id="title" value="{{ $task->title??''}}" required>
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        <div class="form-check form-check-inline">
            @foreach($priorities as $key => $priority)
                <input class="mx-3" type="radio" name="priority_id" id="priority{{ $key }}" value="{{ $priority->id }}"
                       @if(!old('priority_id') && $key === 0)
                       checked
                       @elseif(old('priority_id') == $priority->id)
                       checked
                        @endif>
                <label class="form-check-label fs-4" for="priority{{ $key }}">{{ $priority->name }}</label>
            @endforeach
        </div>

    </div>
</div>
<div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
    <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Assign To User' }}</label>
    <div class="col-md-6">
        {{--<select class="form-control clr_input_fields select2 borderRadius js-example-basic-multiple" name="assign_to_user_id" id="assign_to_user_id">--}}
        <select class="form-control clr_input_fields borderRadius select2" multiple name="assign_to_user_id[]" id="assign_to_user_id" required>
        @foreach($users as $user)
                <option value="{{$user->id}}" @if(isset($task) && in_array($user->id, $task->getTaskAssignUser->pluck('user_id')->toArray())) selected @endif>{{$user->name??""}}</option>
            @endforeach
        </select>
        {!! $errors->first('assign_to_user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assign_to_team_id') ? 'has-error' : ''}}">
    <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Team ' }}</label>
    <div class="col-md-6">

        <select class="form-control clr_input_fields select2 borderRadius" name="assign_to_team_id" id="assign_to_team_id">
            @foreach($teams as $team)
                <option value="{{$team->id}}" @if(isset($task)  && $team->id == $task->assign_to_team_id) selected @endif >{{$team->name}}</option>
            @endforeach
        </select>
        {!! $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('due_date') ? 'has-error' : ''}}">
    <label for="due_date" class="col-md-4 control-label">{{ 'Due Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="due_date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" type="date" id="due_date" value="{{ $task->due_date??''}}" >
        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
    <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Lead ' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields select2 borderRadius" name="assign_to_lead_id" id="assign_to_lead_id">
            @if(!empty($leadExist))
                @foreach($leads as $lead)
                    <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                @endforeach
            @else
            @foreach($leads as $lead)
                <option value="{{$lead->id}}" @if(isset($task)  && $lead->id == $task->assign_to_lead_id) selected @endif >{{$lead->title}}</option>
            @endforeach
         @endif
        </select>
        {!! $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ $task->description??''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="col-md-12">
    <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
        <label for="images" class="control-label">{{ 'Images' }}</label>
        <div action="#" id="dropzone" class="dropzone col-md-6">
            <div class="fallback">
                <input name="images" id="images" type="file" multiple accept="image/*" required />
            </div>
        </div>
    </div>
    <input type="hidden" name="task_attachment" id="task_attachment">
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>

@push('js')
<script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $(document).ready(function () {
        var sum = 0;
        var task_attachment_arr = [];
        Dropzone.autoDiscover = false;
        $("#dropzone").dropzone({
            url: "{{route('upload_task_attachment')}}",
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
                task_attachment_arr = jQuery.grep(task_attachment_arr, function(value) {
                    return value != image_name;
                });
                $('#task_attachment').val(task_attachment_arr);
                file.previewElement.remove();
                $.ajax({
                    type: 'get',
                    url: "{{ route('remove_task_attachment') }}",
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
                task_attachment_arr.push(response);
                $('#task_attachment').val(task_attachment_arr);
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
                @if(isset($task->images) && $task->images != null)
                @foreach ($task->images as $attachment)
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
@endpush