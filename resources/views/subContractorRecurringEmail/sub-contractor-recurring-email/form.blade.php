<div class="form-group {{ $errors->has('email_template_id') ? 'has-error' : ''}}">
    <label for="email_template_id" class="col-md-4 control-label">{{ 'Email Template Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="email_template_id" type="text" id="email_template_id" value="{{ $subcontractorrecurringemail->email_template_id??''}}" >
        {!! $errors->first('email_template_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('subcontractor_id') ? 'has-error' : ''}}">
    <label for="subcontractor_id" class="col-md-4 control-label">{{ 'Subcontractor Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="subcontractor_id" type="text" id="subcontractor_id" value="{{ $subcontractorrecurringemail->subcontractor_id??''}}" >
        {!! $errors->first('subcontractor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('insurance_type') ? 'has-error' : ''}}">
    <label for="insurance_type" class="col-md-4 control-label">{{ 'Insurance Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="insurance_type" type="text" id="insurance_type" value="{{ $subcontractorrecurringemail->insurance_type??''}}" >
        {!! $errors->first('insurance_type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('no_of_days_before') ? 'has-error' : ''}}">
    <label for="no_of_days_before" class="col-md-4 control-label">{{ 'No Of Days Before' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="no_of_days_before" type="text" id="no_of_days_before" value="{{ $subcontractorrecurringemail->no_of_days_before??''}}" >
        {!! $errors->first('no_of_days_before', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('same_agency') ? 'has-error' : ''}}">
    <label for="same_agency" class="col-md-4 control-label">{{ 'Same Agency' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="same_agency" type="text" id="same_agency" value="{{ $subcontractorrecurringemail->same_agency??''}}" >
        {!! $errors->first('same_agency', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('policy_expiry_date') ? 'has-error' : ''}}">
    <label for="policy_expiry_date" class="col-md-4 control-label">{{ 'Policy Expiry Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="policy_expiry_date" type="text" id="policy_expiry_date" value="{{ $subcontractorrecurringemail->policy_expiry_date??''}}" >
        {!! $errors->first('policy_expiry_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
