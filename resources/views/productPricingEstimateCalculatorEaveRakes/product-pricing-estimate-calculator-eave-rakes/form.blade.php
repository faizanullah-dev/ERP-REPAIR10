<div class="form-group {{ $errors->has('product_pricing_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="product_pricing_estimate_calculator_id" class="col-md-4 control-label">{{ 'Product Pricing Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_pricing_estimate_calculator_id" type="text" id="product_pricing_estimate_calculator_id" value="{{ $productpricingestimatecalculatoreaverake->product_pricing_estimate_calculator_id??''}}" >
        {!! $errors->first('product_pricing_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('eave') ? 'has-error' : ''}}">
    <label for="eave" class="col-md-4 control-label">{{ 'Eave' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="eave" type="text" id="eave" value="{{ $productpricingestimatecalculatoreaverake->eave??''}}" >
        {!! $errors->first('eave', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rakes') ? 'has-error' : ''}}">
    <label for="rakes" class="col-md-4 control-label">{{ 'Rakes' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="rakes" type="text" id="rakes" value="{{ $productpricingestimatecalculatoreaverake->rakes??''}}" >
        {!! $errors->first('rakes', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('eave_final_rakes') ? 'has-error' : ''}}">
    <label for="eave_final_rakes" class="col-md-4 control-label">{{ 'Eave Final Rakes' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="eave_final_rakes" type="text" id="eave_final_rakes" value="{{ $productpricingestimatecalculatoreaverake->eave_final_rakes??''}}" >
        {!! $errors->first('eave_final_rakes', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('eave_final_rakes_total') ? 'has-error' : ''}}">
    <label for="eave_final_rakes_total" class="col-md-4 control-label">{{ 'Eave Final Rakes Total' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="eave_final_rakes_total" type="text" id="eave_final_rakes_total" value="{{ $productpricingestimatecalculatoreaverake->eave_final_rakes_total??''}}" >
        {!! $errors->first('eave_final_rakes_total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
