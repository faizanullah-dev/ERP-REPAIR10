<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ $usersmailboxessent->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('configuration_email') ? 'has-error' : ''}}">
    <label for="configuration_email" class="col-md-4 control-label">{{ 'Configuration Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="configuration_email" type="text" id="configuration_email" value="{{ $usersmailboxessent->configuration_email??''}}" >
        {!! $errors->first('configuration_email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('uid') ? 'has-error' : ''}}">
    <label for="uid" class="col-md-4 control-label">{{ 'Uid' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="uid" type="text" id="uid" value="{{ $usersmailboxessent->uid??''}}" >
        {!! $errors->first('uid', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    <label for="subject" class="col-md-4 control-label">{{ 'Subject' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="subject" type="textarea" id="subject" >{{ $usersmailboxessent->subject??''}}</textarea>
        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('from') ? 'has-error' : ''}}">
    <label for="from" class="col-md-4 control-label">{{ 'From' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="from" type="textarea" id="from" >{{ $usersmailboxessent->from??''}}</textarea>
        {!! $errors->first('from', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('to') ? 'has-error' : ''}}">
    <label for="to" class="col-md-4 control-label">{{ 'To' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="to" type="textarea" id="to" >{{ $usersmailboxessent->to??''}}</textarea>
        {!! $errors->first('to', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cc') ? 'has-error' : ''}}">
    <label for="cc" class="col-md-4 control-label">{{ 'Cc' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="cc" type="textarea" id="cc" >{{ $usersmailboxessent->cc??''}}</textarea>
        {!! $errors->first('cc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('bcc') ? 'has-error' : ''}}">
    <label for="bcc" class="col-md-4 control-label">{{ 'Bcc' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="bcc" type="textarea" id="bcc" >{{ $usersmailboxessent->bcc??''}}</textarea>
        {!! $errors->first('bcc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="col-md-4 control-label">{{ 'Message' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="message" type="textarea" id="message" >{{ $usersmailboxessent->message??''}}</textarea>
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="date" type="textarea" id="date" >{{ $usersmailboxessent->date??''}}</textarea>
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mail_attachment') ? 'has-error' : ''}}">
    <label for="mail_attachment" class="col-md-4 control-label">{{ 'Mail Attachment' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="mail_attachment" type="textarea" id="mail_attachment" >{{ $usersmailboxessent->mail_attachment??''}}</textarea>
        {!! $errors->first('mail_attachment', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
