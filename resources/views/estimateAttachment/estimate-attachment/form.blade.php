<div class="form-group {{ $errors->has('estimate_id') ? 'has-error' : ''}}">
    <label for="estimate_id" class="col-md-4 control-label">{{ 'Estimate Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="estimate_id" type="text" id="estimate_id" value="{{ $estimateattachment->estimate_id??''}}" >
        {!! $errors->first('estimate_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $estimateattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
