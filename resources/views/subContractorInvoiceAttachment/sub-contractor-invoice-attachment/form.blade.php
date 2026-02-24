<div class="form-group {{ $errors->has('invoice_id') ? 'has-error' : ''}}">
    <label for="invoice_id" class="col-md-4 control-label">{{ 'Invoice Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="invoice_id" type="text" id="invoice_id" value="{{ $subcontractorinvoiceattachment->invoice_id??''}}" >
        {!! $errors->first('invoice_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
    <label for="product_name" class="col-md-4 control-label">{{ 'Product Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_name" type="text" id="product_name" value="{{ $subcontractorinvoiceattachment->product_name??''}}" >
        {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="col-md-4 control-label">{{ 'Quantity' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="quantity" type="text" id="quantity" value="{{ $subcontractorinvoiceattachment->quantity??''}}" >
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rate') ? 'has-error' : ''}}">
    <label for="rate" class="col-md-4 control-label">{{ 'Rate' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="rate" type="text" id="rate" value="{{ $subcontractorinvoiceattachment->rate??''}}" >
        {!! $errors->first('rate', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tax') ? 'has-error' : ''}}">
    <label for="tax" class="col-md-4 control-label">{{ 'Tax' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="tax" type="text" id="tax" value="{{ $subcontractorinvoiceattachment->tax??''}}" >
        {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="col-md-4 control-label">{{ 'Total' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="total" type="text" id="total" value="{{ $subcontractorinvoiceattachment->total??''}}" >
        {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
