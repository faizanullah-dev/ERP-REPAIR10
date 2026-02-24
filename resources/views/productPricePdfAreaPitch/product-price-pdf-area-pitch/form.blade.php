<div class="form-group {{ $errors->has('product_price_pdf_measurement_id') ? 'has-error' : ''}}">
    <label for="product_price_pdf_measurement_id" class="col-md-4 control-label">{{ 'Product Price Pdf Measurement Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_price_pdf_measurement_id" type="text" id="product_price_pdf_measurement_id" value="{{ $productpricepdfareapitch->product_price_pdf_measurement_id??''}}" >
        {!! $errors->first('product_price_pdf_measurement_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $productpricepdfareapitch->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <label for="value" class="col-md-4 control-label">{{ 'Value' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="value" type="text" id="value" value="{{ $productpricepdfareapitch->value??''}}" >
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
