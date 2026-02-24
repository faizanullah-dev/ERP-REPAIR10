<div class="form-group {{ $errors->has('chimney_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="chimney_estimate_calculator_id" class="col-md-4 control-label">{{ 'Chimney Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="chimney_estimate_calculator_id" type="text" id="chimney_estimate_calculator_id" value="{{ $storechimneyestimatecalculatorchimney->chimney_estimate_calculator_id??''}}" >
        {!! $errors->first('chimney_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
