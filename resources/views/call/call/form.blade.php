<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="col-md-4 control-label">{{ 'Phone' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="phone" type="text" id="phone" value="{{ $call->phone??''}}" >
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lead_id" type="text" id="lead_id" value="{{ $call->lead_id??''}}" >
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('notes') ? 'has-error' : ''}}">
    <label for="notes" class="col-md-4 control-label">{{ 'Notes' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="notes" type="text" id="notes" value="{{ $call->notes??''}}" >
        {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
    <label for="time" class="col-md-4 control-label">{{ 'Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="time" type="text" id="time" value="{{ $call->time??''}}" >
        {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="date" type="text" id="date" value="{{ $call->date??''}}" >
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('duraiton') ? 'has-error' : ''}}">
    <label for="duraiton" class="col-md-4 control-label">{{ 'Duraiton' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="duraiton" type="text" id="duraiton" value="{{ $call->duraiton??''}}" >
        {!! $errors->first('duraiton', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
