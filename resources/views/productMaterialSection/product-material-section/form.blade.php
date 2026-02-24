<div class="form-group {{ $errors->has('material_list_id') ? 'has-error' : ''}}">
    <label for="material_list_id" class="col-md-4 control-label">{{ 'Material List Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="material_list_id" type="text" id="material_list_id" value="{{ $productmaterialsection->material_list_id??''}}" >
        {!! $errors->first('material_list_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
