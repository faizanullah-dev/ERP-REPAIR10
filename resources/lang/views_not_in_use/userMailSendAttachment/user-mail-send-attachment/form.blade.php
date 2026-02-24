<div class="form-group {{ $errors->has('user_mail_send_id') ? 'has-error' : ''}}">
    <label for="user_mail_send_id" class="col-md-4 control-label">{{ 'User Mail Send Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_mail_send_id" type="text" id="user_mail_send_id" value="{{ $usermailsendattachment->user_mail_send_id??''}}" >
        {!! $errors->first('user_mail_send_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $usermailsendattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
