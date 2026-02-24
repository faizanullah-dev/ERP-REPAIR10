<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" {{--rows="10"--}} name="description" type="textarea" id="description">{{ $termandcondition->description??''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <select name="status" id="status">
        <option value="" selected>Select Status</option>
        <option value="1" >Active</option>
        <option value="0" >Inactive</option>
    </select>
</div>

</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}" onclick="this.disabled = true; this.form.submit();">
    </div>
</div>
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        $('#term_and_condition_form,#term_and_condition_create').validate({
            ignore: [],
            rules: {
                description: {
                    taskDescription: true
                },
                status:{required:true}
            },
            messages: {
                description: {
                    taskDescription: "Description field is required"
                },
                status:{required:"Status is required"}
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endpush
