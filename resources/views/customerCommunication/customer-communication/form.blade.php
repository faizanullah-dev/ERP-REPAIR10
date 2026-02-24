<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $customercommunication->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    <label for="subject" class="col-md-4 control-label">{{ 'Subject' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="subject" type="text" id="subject" value="{{ $customercommunication->subject??''}}" >
        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('from') ? 'has-error' : ''}}">
    <label for="from" class="col-md-4 control-label">{{ 'From' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="from" type="text" id="from" value="{{ $customercommunication->from??''}}" >
        {!! $errors->first('from', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('to') ? 'has-error' : ''}}">
    <label for="to" class="col-md-4 control-label">{{ 'To' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="to" type="text" id="to" value="{{ $customercommunication->to??''}}" >
        {!! $errors->first('to', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cc') ? 'has-error' : ''}}">
    <label for="cc" class="col-md-4 control-label">{{ 'Cc' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="cc" type="text" id="cc" value="{{ $customercommunication->cc??''}}" >
        {!! $errors->first('cc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="col-md-4 control-label">{{ 'Message' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="message" type="text" id="message" value="{{ $customercommunication->message??''}}" >
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="col-md-4 control-label">{{ 'Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="type" type="text" id="type" value="{{ $customercommunication->type??''}}" >
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
