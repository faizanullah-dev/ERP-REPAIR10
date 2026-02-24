<div class="form-group {{ $errors->has('product_pricing_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="product_pricing_estimate_calculator_id" class="col-md-4 control-label">{{ 'Product Pricing Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_pricing_estimate_calculator_id" type="text" id="product_pricing_estimate_calculator_id" value="{{ $productpricingestimatecalculatorflatarea->product_pricing_estimate_calculator_id??''}}" >
        {!! $errors->first('product_pricing_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('eave') ? 'has-error' : ''}}">
    <label for="eave" class="col-md-4 control-label">{{ 'Eave' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="eave" type="text" id="eave" value="{{ $productpricingestimatecalculatorflatarea->eave??''}}" >
        {!! $errors->first('eave', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rakes') ? 'has-error' : ''}}">
    <label for="rakes" class="col-md-4 control-label">{{ 'Rakes' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="rakes" type="text" id="rakes" value="{{ $productpricingestimatecalculatorflatarea->rakes??''}}" >
        {!! $errors->first('rakes', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('eave_rakes_total') ? 'has-error' : ''}}">
    <label for="eave_rakes_total" class="col-md-4 control-label">{{ 'Eave Rakes Total' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="eave_rakes_total" type="text" id="eave_rakes_total" value="{{ $productpricingestimatecalculatorflatarea->eave_rakes_total??''}}" >
        {!! $errors->first('eave_rakes_total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
