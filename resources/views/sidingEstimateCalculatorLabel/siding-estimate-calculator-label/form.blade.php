<div class="form-group {{ $errors->has('siding_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="siding_estimate_calculator_id" class="col-md-4 control-label">{{ 'Siding Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="siding_estimate_calculator_id" type="text" id="siding_estimate_calculator_id" value="{{ $sidingestimatecalculatorlabel->siding_estimate_calculator_id??''}}" >
        {!! $errors->first('siding_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('section') ? 'has-error' : ''}}">
    <label for="section" class="col-md-4 control-label">{{ 'Section' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="section" type="text" id="section" value="{{ $sidingestimatecalculatorlabel->section??''}}" >
        {!! $errors->first('section', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $sidingestimatecalculatorlabel->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <label for="value" class="col-md-4 control-label">{{ 'Value' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="value" type="text" id="value" value="{{ $sidingestimatecalculatorlabel->value??''}}" >
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
