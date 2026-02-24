<div class="form-group {{ $errors->has('product_pricing_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="product_pricing_estimate_calculator_id" class="col-md-4 control-label">{{ 'Product Pricing Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_pricing_estimate_calculator_id" type="text" id="product_pricing_estimate_calculator_id" value="{{ $productpricingestimatecalculatordownspout->product_pricing_estimate_calculator_id??''}}" >
        {!! $errors->first('product_pricing_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gutters') ? 'has-error' : ''}}">
    <label for="gutters" class="col-md-4 control-label">{{ 'Gutters' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="gutters" type="text" id="gutters" value="{{ $productpricingestimatecalculatordownspout->gutters??''}}" >
        {!! $errors->first('gutters', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('downspouts') ? 'has-error' : ''}}">
    <label for="downspouts" class="col-md-4 control-label">{{ 'Downspouts' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="downspouts" type="text" id="downspouts" value="{{ $productpricingestimatecalculatordownspout->downspouts??''}}" >
        {!! $errors->first('downspouts', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('guards') ? 'has-error' : ''}}">
    <label for="guards" class="col-md-4 control-label">{{ 'Guards' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="guards" type="text" id="guards" value="{{ $productpricingestimatecalculatordownspout->guards??''}}" >
        {!! $errors->first('guards', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
