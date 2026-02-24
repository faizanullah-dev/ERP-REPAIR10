<div class="form-group {{ $errors->has('siding_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="siding_estimate_calculator_id" class="col-md-4 control-label">{{ 'Siding Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="siding_estimate_calculator_id" type="text" id="siding_estimate_calculator_id" value="{{ $sidingestimatecalculatorguttersdownspout->siding_estimate_calculator_id??''}}" >
        {!! $errors->first('siding_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('section') ? 'has-error' : ''}}">
    <label for="section" class="col-md-4 control-label">{{ 'Section' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="section" type="text" id="section" value="{{ $sidingestimatecalculatorguttersdownspout->section??''}}" >
        {!! $errors->first('section', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gutters') ? 'has-error' : ''}}">
    <label for="gutters" class="col-md-4 control-label">{{ 'Gutters' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="gutters" type="text" id="gutters" value="{{ $sidingestimatecalculatorguttersdownspout->gutters??''}}" >
        {!! $errors->first('gutters', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('guards') ? 'has-error' : ''}}">
    <label for="guards" class="col-md-4 control-label">{{ 'Guards' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="guards" type="text" id="guards" value="{{ $sidingestimatecalculatorguttersdownspout->guards??''}}" >
        {!! $errors->first('guards', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('downspouts') ? 'has-error' : ''}}">
    <label for="downspouts" class="col-md-4 control-label">{{ 'Downspouts' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="downspouts" type="text" id="downspouts" value="{{ $sidingestimatecalculatorguttersdownspout->downspouts??''}}" >
        {!! $errors->first('downspouts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
