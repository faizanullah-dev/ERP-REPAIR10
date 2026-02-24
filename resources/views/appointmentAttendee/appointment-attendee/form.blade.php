<div class="form-group {{ $errors->has('appointment_id') ? 'has-error' : ''}}">
    <label for="appointment_id" class="col-md-4 control-label">{{ 'Appointment Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="appointment_id" type="text" id="appointment_id" value="{{ $appointmentattendee->appointment_id??''}}" >
        {!! $errors->first('appointment_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attendees_id') ? 'has-error' : ''}}">
    <label for="attendees_id" class="col-md-4 control-label">{{ 'Attendees Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="attendees_id" type="text" id="attendees_id" value="{{ $appointmentattendee->attendees_id??''}}" >
        {!! $errors->first('attendees_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
