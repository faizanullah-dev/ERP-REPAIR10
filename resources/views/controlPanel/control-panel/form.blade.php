<div class="form-group {{ $errors->has('module') ? 'has-error' : ''}}">
    <label for="module" class="col-md-4 control-label">{{ 'Module' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="module" type="text" id="module" value="{{ $controlpanel->module??''}}" >
        {!! $errors->first('module', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="text" id="status" value="{{ $controlpanel->status??''}}" >
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
