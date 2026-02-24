@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <style>
        label.error { color: red; font-size: 12px; margin-top: 5px; }
    </style>
@endpush

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
            <label for="assign_to_user_id" class="control-label">{{ 'TEAMS' }}</label>
            <select class="custom_modal_select2 form-control  borderRadius" multiple name="assign_announcement_user_id[]" id="user_id" >
                @foreach ($teams as $team)
                    <option value="{{$team->id}}" @if(isset($announcement->getAnnouncementUser) && in_array($team->id, $announcement->getAnnouncementUser->pluck('team_id')->toArray())) selected @endif> {{$team->name??""}}</option>
                @endforeach
            </select>
            {!! $errors->first('team_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('announcement') ? 'has-error' : ''}}">
            <label for="description" class="control-label">{{ 'Description' }}</label>
            <textarea class="form-control" rows="5" name="description" type="textarea" id="description">
            @if(isset($announcement->description)){{ strip_tags($announcement->description) }}@endif
        </textarea>
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>




    <div class="col-md-12">
        <div class="form-group mb-0">
            <input class="btn btn-green d-block mx-auto" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js" defer></script>
{{--<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>--}}
<script>
    $(document).ready(function() {
        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length !== 0;
        }, "Spaces are not allowed.");
        let editor;
        if (typeof ClassicEditor !== "undefined") {
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
        } else {
            console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
        }
        $.validator.addMethod("taskDescription", function(value, element) {
            if (editor) {
                var editorContent = editor.getData().trim();
                return editorContent.length !== 0;
            }
            return false;
        }, "Description is required.");

        $('#announcement_form,#announcement_edit_form').validate({
            ignore: [],
            rules: {
                description: {
                    taskDescription: true
                },
                'assign_announcement_user_id[]':{required:true}
            },
            messages: {
                description: {
                    taskDescription: "Description field is required"
                },
                'assign_announcement_user_id[]':{required:"Please select Team first."}
            },
            errorPlacement: function(error, element) {
                if (element.is("select") || element.is("textarea")) {
                    error.insertAfter(element);
                } else {
                    error.insertBefore(element);
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endpush
