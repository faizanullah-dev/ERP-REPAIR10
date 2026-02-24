<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lead_id" type="text" id="lead_id" value="{{ $workforcehour->lead_id??''}}" >
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('task_id') ? 'has-error' : ''}}">
    <label for="task_id" class="col-md-4 control-label">{{ 'Task Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="task_id" type="text" id="task_id" value="{{ $workforcehour->task_id??''}}" >
        {!! $errors->first('task_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $workforcehour->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
    <label for="time" class="col-md-4 control-label">{{ 'Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="time" type="text" id="time" value="{{ $workforcehour->time??''}}" >
        {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
