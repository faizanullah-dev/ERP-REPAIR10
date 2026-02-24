<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" {{--rows="10"--}} name="description" type="textarea" id="description">{{ $termandcondition->description??''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">--}}
    {{--<label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="status" type="text" id="status" value="{{ $termandcondition->status??''}}" >--}}
        {{--{!! $errors->first('status', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
    </script>
@endpush