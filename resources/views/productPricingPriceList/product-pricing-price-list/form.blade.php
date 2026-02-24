<div class="form-group {{ $errors->has('product_pricing_calculator_id') ? 'has-error' : ''}}">
    <label for="product_pricing_calculator_id" class="col-md-4 control-label">{{ 'Product Pricing Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_pricing_calculator_id" type="text" id="product_pricing_calculator_id" value="{{ $productpricingpricelist->product_pricing_calculator_id??''}}" >
        {!! $errors->first('product_pricing_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('estimated_total') ? 'has-error' : ''}}">
    <label for="estimated_total" class="col-md-4 control-label">{{ 'Estimated Total' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="estimated_total" type="text" id="estimated_total" value="{{ $productpricingpricelist->estimated_total??''}}" >
        {!! $errors->first('estimated_total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
