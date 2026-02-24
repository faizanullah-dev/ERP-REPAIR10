<div class="form-group {{ $errors->has('roof') ? 'has-error' : ''}}">
    <label for="roof" class="col-md-4 control-label">{{ 'Roof' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="roof" type="text" id="roof" value="{{ $calculatorbasevalue->roof??''}}" >
        {!! $errors->first('roof', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('siding') ? 'has-error' : ''}}">
    <label for="siding" class="col-md-4 control-label">{{ 'Siding' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="siding" type="text" id="siding" value="{{ $calculatorbasevalue->siding??''}}" >
        {!! $errors->first('siding', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('chimney') ? 'has-error' : ''}}">
    <label for="chimney" class="col-md-4 control-label">{{ 'Chimney' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="chimney" type="text" id="chimney" value="{{ $calculatorbasevalue->chimney??''}}" >
        {!! $errors->first('chimney', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
