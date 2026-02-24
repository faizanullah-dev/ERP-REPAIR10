<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lead_id" type="text" id="lead_id" value="{{ $subcontractorproposal->lead_id??''}}" >
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('proposal_id') ? 'has-error' : ''}}">
    <label for="proposal_id" class="col-md-4 control-label">{{ 'Proposal Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="proposal_id" type="text" id="proposal_id" value="{{ $subcontractorproposal->proposal_id??''}}" >
        {!! $errors->first('proposal_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sub_contractor_id') ? 'has-error' : ''}}">
    <label for="sub_contractor_id" class="col-md-4 control-label">{{ 'Sub Contractor Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sub_contractor_id" type="text" id="sub_contractor_id" value="{{ $subcontractorproposal->sub_contractor_id??''}}" >
        {!! $errors->first('sub_contractor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="text" id="status" value="{{ $subcontractorproposal->status??''}}" >
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
