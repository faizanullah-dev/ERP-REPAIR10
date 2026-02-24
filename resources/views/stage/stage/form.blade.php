<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class=" control-label">{{ 'Name' }} *</label>
            <input class="form-control" name="name" type="text" id="name" value="{{ $stage->name??''}}" placeholder="Enter Stage Name">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    {{--<div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">--}}
        {{--<label for="position" class="col-md-4 control-label">{{ 'Position' }}</label>--}}
        {{--<div class="col-md-6">--}}
            {{--<input class="form-control" name="position" type="text" id="position" value="{{ $stage->position??''}}" >--}}
            {{--{!! $errors->first('position', '<p class="help-block">:message</p>') !!}--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class=" control-label">{{ 'Status' }}</label>
            <select class="form-control" name="status" id="status" required>
                {{--<option value="1" @if(isset($stage) && $stage->status == 1) selected @endif>Active</option>
                <option value="0" @if(isset($stage) && $stage->status == 0) selected @endif>InActive</option>--}}
                
                <option value="1" @if(optional($stage)->status == 1) selected @endif>Active</option>
                <option value="0" @if(optional($stage)->status == 0) selected @endif>InActive</option>
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0 flex-row align-items-center {{ $errors->has('colour_id') ? 'has-error' : ''}}">
            <label for="colour_id" class=" control-label mb-0">{{ 'Colour' }}</label>
            <input class="form-control" name="colour_id" type="color" value="{{$stage->colour_id??''}}" placeholder="Enter Name">
            {!! $errors->first('colour_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-8 d-flex align-items-end justify-content-end">
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
            $('#stage,#stage_edit_form').validate({
                rules: {
                    name: {
                        required: true,
                        noSpace: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter name.",
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