<div class="form-group {{ $errors->has('appointment_id') ? 'has-error' : ''}}">
    <label for="appointment_id" class="col-md-4 control-label">{{ 'Appointment Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="appointment_id" type="text" id="appointment_id" value="{{ $appointmentattachment->appointment_id??''}}" >
        {!! $errors->first('appointment_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $appointmentattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="col-md-4 control-label">{{ 'Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="type" type="text" id="type" value="{{ $appointmentattachment->type??''}}" >
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
    <label for="url" class="col-md-4 control-label">{{ 'Url' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="url" type="text" id="url" value="{{ $appointmentattachment->url??''}}" >
        {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="text" id="status" value="{{ $appointmentattachment->status??''}}" >
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
