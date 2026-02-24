<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $stage->name??''}}" placeholder="Enter Name">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('colour_id') ? 'has-error' : ''}}">
    <label for="colour_id" class="col-md-4 control-label">{{ 'Colour' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="colour_id" type="color" value="{{$stage->colour_id??''}}" placeholder="Enter Name">
        {!! $errors->first('colour_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">--}}
    {{--<label for="position" class="col-md-4 control-label">{{ 'Position' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="position" type="text" id="position" value="{{ $stage->position??''}}" >--}}
        {{--{!! $errors->first('position', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status" required>
            <option value="1" @if(isset($stage) && $stage->status == 1) selected @endif>Active</option>
            <option value="0" @if(isset($stage) && $stage->status == 0) selected @endif>InActive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
