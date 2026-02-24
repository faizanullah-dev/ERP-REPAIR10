<div class="form-group {{ $errors->has('notification_name') ? 'has-error' : ''}}">
    <label for="notification_name" class="col-md-4 control-label">{{ 'Notification Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="notification_name" type="text" id="notification_name" value="{{ $notification->notification_name??''}}" >
        {!! $errors->first('notification_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="col-md-4 control-label">{{ 'Title' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="title" type="text" id="title" value="{{ $notification->title??''}}" >
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
    <label for="time" class="col-md-4 control-label">{{ 'Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="time" type="text" id="time" value="{{ $notification->time??''}}" >
        {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
