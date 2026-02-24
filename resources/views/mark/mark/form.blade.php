<div class="row">
    <input type="hidden" name="created_by" value="{{ auth()->id() }}">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Name' }}</label>
            <input class="form-control" name="name" placeholder="Enter mark name" type="text" id="name" value="{{ $mark->name??''}}" required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class="control-label">{{ 'Status' }}</label>
            <select class="form-control  custom_modal_select2 borderRadius" name="status" id="status" required>
                {{--<option value="1" @if(isset($mark) && $mark->status == 1) selected @endif>Active</option>
                <option value="0" @if(isset($mark) && $mark->status == 0) selected @endif>InActive</option>--}}

                <option value="1" @if(optional($mark)->status == 1) selected @endif>Active</option>
                <option value="0" @if(optional($mark)->status == 0) selected @endif>InActive</option>
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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

    <script>
        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Spaces are not allowed.");
            $('#markValidate').validate({
                rules: {
                    name: {
                        required: true,
                        noSpace: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter mark name.",
                        noSpace: "Spaces are not allowed."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

    </script>
@endpush
