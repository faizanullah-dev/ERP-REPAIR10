<div class="form-group {{ $errors->has('invoice_unique_id') ? 'has-error' : ''}}">
    <label for="invoice_unique_id" class="col-md-4 control-label">{{ 'Invoice Unique Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="invoice_unique_id" type="text" id="invoice_unique_id" value="{{ $subcontractorinvoice->invoice_unique_id??''}}" >
        {!! $errors->first('invoice_unique_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lead_id" type="text" id="lead_id" value="{{ $subcontractorinvoice->lead_id??''}}" >
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('job_id') ? 'has-error' : ''}}">
    <label for="job_id" class="col-md-4 control-label">{{ 'Job Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="job_id" type="text" id="job_id" value="{{ $subcontractorinvoice->job_id??''}}" >
        {!! $errors->first('job_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('subcontractor_id') ? 'has-error' : ''}}">
    <label for="subcontractor_id" class="col-md-4 control-label">{{ 'Subcontractor Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="subcontractor_id" type="text" id="subcontractor_id" value="{{ $subcontractorinvoice->subcontractor_id??''}}" >
        {!! $errors->first('subcontractor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="col-md-4 control-label">{{ 'Address' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="address" type="text" id="address" value="{{ $subcontractorinvoice->address??''}}" >
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sub_total') ? 'has-error' : ''}}">
    <label for="sub_total" class="col-md-4 control-label">{{ 'Sub Total' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sub_total" type="text" id="sub_total" value="{{ $subcontractorinvoice->sub_total??''}}" >
        {!! $errors->first('sub_total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tax') ? 'has-error' : ''}}">
    <label for="tax" class="col-md-4 control-label">{{ 'Tax' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="tax" type="text" id="tax" value="{{ $subcontractorinvoice->tax??''}}" >
        {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="col-md-4 control-label">{{ 'Total' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="total" type="text" id="total" value="{{ $subcontractorinvoice->total??''}}" >
        {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('created_by') ? 'has-error' : ''}}">
    <label for="created_by" class="col-md-4 control-label">{{ 'Created By' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="created_by" type="text" id="created_by" value="{{ $subcontractorinvoice->created_by??''}}" >
        {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="text" id="status" value="{{ $subcontractorinvoice->status??''}}" >
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('payment_status') ? 'has-error' : ''}}">
    <label for="payment_status" class="col-md-4 control-label">{{ 'Payment Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="payment_status" type="text" id="payment_status" value="{{ $subcontractorinvoice->payment_status??''}}" >
        {!! $errors->first('payment_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
