<div class="form-group {{ $errors->has('product_pricing_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="product_pricing_estimate_calculator_id" class="col-md-4 control-label">{{ 'Product Pricing Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_pricing_estimate_calculator_id" type="text" id="product_pricing_estimate_calculator_id" value="{{ $productpricingestimatecalculatorlabel->product_pricing_estimate_calculator_id??''}}" >
        {!! $errors->first('product_pricing_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('section') ? 'has-error' : ''}}">
    <label for="section" class="col-md-4 control-label">{{ 'Section' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="section" type="text" id="section" value="{{ $productpricingestimatecalculatorlabel->section??''}}" >
        {!! $errors->first('section', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $productpricingestimatecalculatorlabel->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <label for="value" class="col-md-4 control-label">{{ 'Value' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="value" type="text" id="value" value="{{ $productpricingestimatecalculatorlabel->value??''}}" >
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
