<div class="form-group {{ $errors->has('invoice_id') ? 'has-error' : ''}}">
    <label for="invoice_id" class="col-md-4 control-label">{{ 'Invoice Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="invoice_id" type="text" id="invoice_id" value="{{ $subcontractorreceiveable->invoice_id??''}}" >
        {!! $errors->first('invoice_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lead_id" type="text" id="lead_id" value="{{ $subcontractorreceiveable->lead_id??''}}" >
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">
    <label for="payment_type" class="col-md-4 control-label">{{ 'Payment Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="payment_type" type="text" id="payment_type" value="{{ $subcontractorreceiveable->payment_type??''}}" >
        {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="date" type="text" id="date" value="{{ $subcontractorreceiveable->date??''}}" >
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="col-md-4 control-label">{{ 'Amount' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="amount" type="text" id="amount" value="{{ $subcontractorreceiveable->amount??''}}" >
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('created_by') ? 'has-error' : ''}}">
    <label for="created_by" class="col-md-4 control-label">{{ 'Created By' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="created_by" type="text" id="created_by" value="{{ $subcontractorreceiveable->created_by??''}}" >
        {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
