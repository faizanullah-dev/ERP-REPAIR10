<div class="form-group {{ $errors->has('follow_up_call_note_id') ? 'has-error' : ''}}">
    <label for="follow_up_call_note_id" class="col-md-4 control-label">{{ 'Follow Up Call Note Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="follow_up_call_note_id" type="text" id="follow_up_call_note_id" value="{{ $followupcallnotesuser->follow_up_call_note_id??''}}" >
        {!! $errors->first('follow_up_call_note_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $followupcallnotesuser->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
