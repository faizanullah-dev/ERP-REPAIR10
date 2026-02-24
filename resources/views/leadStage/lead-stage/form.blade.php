<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lead_id" type="text" id="lead_id" value="{{ $leadstage->lead_id??''}}" >
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('stage_id') ? 'has-error' : ''}}">
    <label for="stage_id" class="col-md-4 control-label">{{ 'Stage Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="stage_id" type="text" id="stage_id" value="{{ $leadstage->stage_id??''}}" >
        {!! $errors->first('stage_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
