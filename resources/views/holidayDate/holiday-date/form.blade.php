<div class="form-group {{ $errors->has('holiday_id') ? 'has-error' : ''}}">
    <label for="holiday_id" class="col-md-4 control-label">{{ 'Holiday Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="holiday_id" type="text" id="holiday_id" value="{{ $holidaydate->holiday_id??''}}" >
        {!! $errors->first('holiday_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="date" type="text" id="date" value="{{ $holidaydate->date??''}}" >
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
