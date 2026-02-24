<div class="form-group {{ $errors->has('staff_id') ? 'has-error' : ''}}">
    <label for="staff_id" class="col-md-4 control-label">{{ 'Staff Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="staff_id" type="text" id="staff_id" value="{{ $stafffinance->staff_id??''}}" >
        {!! $errors->first('staff_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('staff_position') ? 'has-error' : ''}}">
    <label for="staff_position" class="col-md-4 control-label">{{ 'Staff Position' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="staff_position" type="text" id="staff_position" value="{{ $stafffinance->staff_position??''}}" >
        {!! $errors->first('staff_position', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('staff_compensation') ? 'has-error' : ''}}">
    <label for="staff_compensation" class="col-md-4 control-label">{{ 'Staff Compensation' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="staff_compensation" type="text" id="staff_compensation" value="{{ $stafffinance->staff_compensation??''}}" >
        {!! $errors->first('staff_compensation', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('position_record') ? 'has-error' : ''}}">
    <label for="position_record" class="col-md-4 control-label">{{ 'Position Record' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="position_record" type="text" id="position_record" value="{{ $stafffinance->position_record??''}}" >
        {!! $errors->first('position_record', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('compensation_record') ? 'has-error' : ''}}">
    <label for="compensation_record" class="col-md-4 control-label">{{ 'Compensation Record' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="compensation_record" type="text" id="compensation_record" value="{{ $stafffinance->compensation_record??''}}" >
        {!! $errors->first('compensation_record', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
