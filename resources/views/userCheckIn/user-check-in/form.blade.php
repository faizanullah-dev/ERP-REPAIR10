<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $usercheckin->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="date" type="text" id="date" value="{{ $usercheckin->date??''}}" >
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('check_in') ? 'has-error' : ''}}">
    <label for="check_in" class="col-md-4 control-label">{{ 'Check In' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="check_in" type="text" id="check_in" value="{{ $usercheckin->check_in??''}}" >
        {!! $errors->first('check_in', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('check_out') ? 'has-error' : ''}}">
    <label for="check_out" class="col-md-4 control-label">{{ 'Check Out' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="check_out" type="text" id="check_out" value="{{ $usercheckin->check_out??''}}" >
        {!! $errors->first('check_out', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('total_hours') ? 'has-error' : ''}}">
    <label for="total_hours" class="col-md-4 control-label">{{ 'Total Hours' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="total_hours" type="text" id="total_hours" value="{{ $usercheckin->total_hours??''}}" >
        {!! $errors->first('total_hours', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
