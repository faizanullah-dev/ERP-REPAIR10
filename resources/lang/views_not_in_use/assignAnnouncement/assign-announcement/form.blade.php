<div class="form-group {{ $errors->has('announcement_id') ? 'has-error' : ''}}">
    <label for="announcement_id" class="col-md-4 control-label">{{ 'Announcement Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="announcement_id" type="text" id="announcement_id" value="{{ $assignannouncement->announcement_id??''}}" >
        {!! $errors->first('announcement_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $assignannouncement->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
