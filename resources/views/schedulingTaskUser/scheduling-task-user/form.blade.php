<div class="form-group {{ $errors->has('scheduling_task_id') ? 'has-error' : ''}}">
    <label for="scheduling_task_id" class="col-md-4 control-label">{{ 'Scheduling Task Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="scheduling_task_id" type="text" id="scheduling_task_id" value="{{ $schedulingtaskuser->scheduling_task_id??''}}" >
        {!! $errors->first('scheduling_task_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $schedulingtaskuser->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
