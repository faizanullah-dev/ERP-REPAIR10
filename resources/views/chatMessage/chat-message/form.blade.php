<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lead_id" type="text" id="lead_id" value="{{ $chatmessage->lead_id??''}}" >
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sender_type') ? 'has-error' : ''}}">
    <label for="sender_type" class="col-md-4 control-label">{{ 'Sender Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sender_type" type="text" id="sender_type" value="{{ $chatmessage->sender_type??''}}" >
        {!! $errors->first('sender_type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="col-md-4 control-label">{{ 'Message' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="message" type="text" id="message" value="{{ $chatmessage->message??''}}" >
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
