<div class="form-group {{ $errors->has('template_id') ? 'has-error' : ''}}">
    <label for="template_id" class="col-md-4 control-label">{{ 'Template Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="template_id" type="text" id="template_id" value="{{ $productlisttemplate->template_id??''}}" >
        {!! $errors->first('template_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="col-md-4 control-label">{{ 'Product Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_id" type="text" id="product_id" value="{{ $productlisttemplate->product_id??''}}" >
        {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
