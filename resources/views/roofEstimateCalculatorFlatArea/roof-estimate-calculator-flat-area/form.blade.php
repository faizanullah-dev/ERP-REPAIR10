<div class="form-group {{ $errors->has('section') ? 'has-error' : ''}}">
    <label for="section" class="col-md-4 control-label">{{ 'Section' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="section" type="text" id="section" value="{{ $roofestimatecalculatorflatarea->section??''}}" >
        {!! $errors->first('section', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('eave') ? 'has-error' : ''}}">
    <label for="eave" class="col-md-4 control-label">{{ 'Eave' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="eave" type="text" id="eave" value="{{ $roofestimatecalculatorflatarea->eave??''}}" >
        {!! $errors->first('eave', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rakes') ? 'has-error' : ''}}">
    <label for="rakes" class="col-md-4 control-label">{{ 'Rakes' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="rakes" type="text" id="rakes" value="{{ $roofestimatecalculatorflatarea->rakes??''}}" >
        {!! $errors->first('rakes', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('calculate_final_value_flat_area') ? 'has-error' : ''}}">
    <label for="calculate_final_value_flat_area" class="col-md-4 control-label">{{ 'Calculate Final Value Flat Area' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="calculate_final_value_flat_area" type="text" id="calculate_final_value_flat_area" value="{{ $roofestimatecalculatorflatarea->calculate_final_value_flat_area??''}}" >
        {!! $errors->first('calculate_final_value_flat_area', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('roof_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="roof_estimate_calculator_id" class="col-md-4 control-label">{{ 'Roof Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="roof_estimate_calculator_id" type="text" id="roof_estimate_calculator_id" value="{{ $roofestimatecalculatorflatarea->roof_estimate_calculator_id??''}}" >
        {!! $errors->first('roof_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
