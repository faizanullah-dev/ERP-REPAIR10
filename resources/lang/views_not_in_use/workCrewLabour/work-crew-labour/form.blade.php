<div class="form-group {{ $errors->has('work_crew_id') ? 'has-error' : ''}}">
    <label for="work_crew_id" class="col-md-4 control-label">{{ 'Work Crew Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="work_crew_id" type="text" id="work_crew_id" value="{{ $workcrewlabour->work_crew_id??''}}" >
        {!! $errors->first('work_crew_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $workcrewlabour->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
