<div class="form-group {{ $errors->has('side_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="side_estimate_calculator_id" class="col-md-4 control-label">{{ 'Side Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="side_estimate_calculator_id" type="text" id="side_estimate_calculator_id" value="{{ $storesideestimatereplacement->side_estimate_calculator_id??''}}" >
        {!! $errors->first('side_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
