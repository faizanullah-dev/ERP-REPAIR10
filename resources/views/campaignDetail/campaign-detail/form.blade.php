<div class="form-group {{ $errors->has('day') ? 'has-error' : ''}}">
    <label for="day" class="col-md-4 control-label">{{ 'Day' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="day" type="text" id="day" value="{{ $campaigndetail->day??''}}" >
        {!! $errors->first('day', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
    <label for="time" class="col-md-4 control-label">{{ 'Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="time" type="text" id="time" value="{{ $campaigndetail->time??''}}" >
        {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('message_type') ? 'has-error' : ''}}">
    <label for="message_type" class="col-md-4 control-label">{{ 'Message Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="message_type" type="text" id="message_type" value="{{ $campaigndetail->message_type??''}}" >
        {!! $errors->first('message_type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    <label for="subject" class="col-md-4 control-label">{{ 'Subject' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="subject" type="textarea" id="subject" >{{ $campaigndetail->subject??''}}</textarea>
        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="col-md-4 control-label">{{ 'Message' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="message" type="textarea" id="message" >{{ $campaigndetail->message??''}}</textarea>
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('campaign_id') ? 'has-error' : ''}}">
    <label for="campaign_id" class="col-md-4 control-label">{{ 'Campaign Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="campaign_id" type="text" id="campaign_id" value="{{ $campaigndetail->campaign_id??''}}" >
        {!! $errors->first('campaign_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
