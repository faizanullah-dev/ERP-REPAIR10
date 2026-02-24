<div class="form-group {{ $errors->has('invoice_id') ? 'has-error' : ''}}">
    <label for="invoice_id" class="col-md-4 control-label">{{ 'Invoice Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="invoice_id" type="text" id="invoice_id" value="{{ $invoiceattachment->invoice_id??''}}" >
        {!! $errors->first('invoice_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activity_name') ? 'has-error' : ''}}">
    <label for="activity_name" class="col-md-4 control-label">{{ 'Activity Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="activity_name" type="text" id="activity_name" value="{{ $invoiceattachment->activity_name??''}}" >
        {!! $errors->first('activity_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="col-md-4 control-label">{{ 'Category Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="category_id" type="text" id="category_id" value="{{ $invoiceattachment->category_id??''}}" >
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="col-md-4 control-label">{{ 'Quantity' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="quantity" type="text" id="quantity" value="{{ $invoiceattachment->quantity??''}}" >
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rate') ? 'has-error' : ''}}">
    <label for="rate" class="col-md-4 control-label">{{ 'Rate' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="rate" type="text" id="rate" value="{{ $invoiceattachment->rate??''}}" >
        {!! $errors->first('rate', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="col-md-4 control-label">{{ 'Amount' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="amount" type="text" id="amount" value="{{ $invoiceattachment->amount??''}}" >
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
