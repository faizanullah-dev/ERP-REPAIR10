<div class="form-group {{ $errors->has('task_id') ? 'has-error' : ''}}">
    <label for="task_id" class="col-md-4 control-label">{{ 'Task Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="task_id" type="text" id="task_id" value="{{ $taskassignuser->task_id??''}}" >
        {!! $errors->first('task_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $taskassignuser->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
