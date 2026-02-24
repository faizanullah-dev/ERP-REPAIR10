<input class="form-control" name="user_id" type="hidden" id="user_id" value="{{ auth()->user()->id??''}}">
<div class="form-group {{ $errors->has('mail_host') ? 'has-error' : ''}}">
    <label for="mail_host" class="col-md-4 control-label">{{ 'Mail Host' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="mail_host" type="text" id="mail_host" value="{{ $usersmailboxconfiguration->mail_host??''}}" >
        {!! $errors->first('mail_host', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mail_port') ? 'has-error' : ''}}">
    <label for="mail_port" class="col-md-4 control-label">{{ 'Mail Port' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="mail_port" type="text" id="mail_port" value="{{ $usersmailboxconfiguration->mail_port??''}}" >
        {!! $errors->first('mail_port', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mail_encryption_type') ? 'has-error' : ''}}">
    <label for="mail_encryption_type" class="col-md-4 control-label">{{ 'Mail Encryption Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="mail_encryption_type" type="text" id="mail_encryption_type" value="{{ $usersmailboxconfiguration->mail_encryption_type??''}}" >
        {!! $errors->first('mail_encryption_type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mail_username') ? 'has-error' : ''}}">
    <label for="mail_username" class="col-md-4 control-label">{{ 'Mail Username' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="mail_username" type="textarea" id="mail_username" >{{ $usersmailboxconfiguration->mail_username??''}}</textarea>
        {!! $errors->first('mail_username', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="col-md-4 control-label">{{ 'Password' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="password" type="text" id="password" value="{{ $usersmailboxconfiguration->password??''}}" >
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mail_protocol') ? 'has-error' : ''}}">
    <label for="mail_protocol" class="col-md-4 control-label">{{ 'Mail Protocol' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="mail_protocol" type="text" id="mail_protocol" value="{{ $usersmailboxconfiguration->mail_protocol??''}}" >
        {!! $errors->first('mail_protocol', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="text" id="status" value="{{ $usersmailboxconfiguration->status??''}}" >
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
