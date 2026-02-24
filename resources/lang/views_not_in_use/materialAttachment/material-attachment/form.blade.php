<div class="form-group {{ $errors->has('material_id') ? 'has-error' : ''}}">
    <label for="material_id" class="col-md-4 control-label">{{ 'Material Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="material_id" type="text" id="material_id" value="{{ $materialattachment->material_id??''}}" >
        {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $materialattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
