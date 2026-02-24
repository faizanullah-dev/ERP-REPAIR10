<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lead_id" type="text" id="lead_id" value="{{ $leadmail->lead_id??''}}" >
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $leadmail->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    <label for="subject" class="col-md-4 control-label">{{ 'Subject' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="subject" type="text" id="subject" value="{{ $leadmail->subject??''}}" >
        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('from') ? 'has-error' : ''}}">
    <label for="from" class="col-md-4 control-label">{{ 'From' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="from" type="text" id="from" value="{{ $leadmail->from??''}}" >
        {!! $errors->first('from', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('to') ? 'has-error' : ''}}">
    <label for="to" class="col-md-4 control-label">{{ 'To' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="to" type="text" id="to" value="{{ $leadmail->to??''}}" >
        {!! $errors->first('to', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cc') ? 'has-error' : ''}}">
    <label for="cc" class="col-md-4 control-label">{{ 'Cc' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="cc" type="text" id="cc" value="{{ $leadmail->cc??''}}" >
        {!! $errors->first('cc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('bcc') ? 'has-error' : ''}}">
    <label for="bcc" class="col-md-4 control-label">{{ 'Bcc' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="bcc" type="text" id="bcc" value="{{ $leadmail->bcc??''}}" >
        {!! $errors->first('bcc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="col-md-4 control-label">{{ 'Message' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="message" type="text" id="message" value="{{ $leadmail->message??''}}" >
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="date" type="text" id="date" value="{{ $leadmail->date??''}}" >
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mail_attachment') ? 'has-error' : ''}}">
    <label for="mail_attachment" class="col-md-4 control-label">{{ 'Mail Attachment' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="mail_attachment" type="text" id="mail_attachment" value="{{ $leadmail->mail_attachment??''}}" >
        {!! $errors->first('mail_attachment', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
