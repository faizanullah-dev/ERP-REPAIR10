<div class="form-group {{ $errors->has('chat_bot_room_id') ? 'has-error' : ''}}">
    <label for="chat_bot_room_id" class="col-md-4 control-label">{{ 'Chat Bot Room Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="chat_bot_room_id" type="text" id="chat_bot_room_id" value="{{ $chatbotmessage->chat_bot_room_id??''}}" >
        {!! $errors->first('chat_bot_room_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sender') ? 'has-error' : ''}}">
    <label for="sender" class="col-md-4 control-label">{{ 'Sender' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sender" type="text" id="sender" value="{{ $chatbotmessage->sender??''}}" >
        {!! $errors->first('sender', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="col-md-4 control-label">{{ 'Message' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="message" type="textarea" id="message" >{{ $chatbotmessage->message??''}}</textarea>
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
