<div class="form-group {{ $errors->has('product_price_calculator_id') ? 'has-error' : ''}}">
    <label for="product_price_calculator_id" class="col-md-4 control-label">{{ 'Product Price Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_price_calculator_id" type="text" id="product_price_calculator_id" value="{{ $productpriceskylight->product_price_calculator_id??''}}" >
        {!! $errors->first('product_price_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
    <label for="size" class="col-md-4 control-label">{{ 'Size' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="size" type="text" id="size" value="{{ $productpriceskylight->size??''}}" >
        {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('qunatity') ? 'has-error' : ''}}">
    <label for="qunatity" class="col-md-4 control-label">{{ 'Qunatity' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="qunatity" type="text" id="qunatity" value="{{ $productpriceskylight->qunatity??''}}" >
        {!! $errors->first('qunatity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="text" id="price" value="{{ $productpriceskylight->price??''}}" >
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
