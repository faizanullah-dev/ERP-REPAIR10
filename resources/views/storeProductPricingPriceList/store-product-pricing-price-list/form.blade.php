<div class="form-group {{ $errors->has('produc_pricing_calculator_id') ? 'has-error' : ''}}">
    <label for="produc_pricing_calculator_id" class="col-md-4 control-label">{{ 'Produc Pricing Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="produc_pricing_calculator_id" type="text" id="produc_pricing_calculator_id" value="{{ $storeproductpricingpricelist->produc_pricing_calculator_id??''}}" >
        {!! $errors->first('produc_pricing_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $storeproductpricingpricelist->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="col-md-4 control-label">{{ 'Quantity' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="quantity" type="text" id="quantity" value="{{ $storeproductpricingpricelist->quantity??''}}" >
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="text" id="price" value="{{ $storeproductpricingpricelist->price??''}}" >
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ext_price') ? 'has-error' : ''}}">
    <label for="ext_price" class="col-md-4 control-label">{{ 'Ext Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="ext_price" type="text" id="ext_price" value="{{ $storeproductpricingpricelist->ext_price??''}}" >
        {!! $errors->first('ext_price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
