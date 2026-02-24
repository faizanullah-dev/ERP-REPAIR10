<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="col-md-4 control-label">{{ 'Customer Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="customer_id" type="number" id="customer_id" value="{{ $customerphone->customer_id??''}}" required>
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('phone_type_id') ? 'has-error' : ''}}">
    <label for="phone_type_id" class="col-md-4 control-label">{{ 'Phone Type Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="phone_type_id" type="number" id="phone_type_id" value="{{ $customerphone->phone_type_id??''}}" required>
        {!! $errors->first('phone_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="col-md-4 control-label">{{ 'Phone' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="phone" type="number" id="phone" value="{{ $customerphone->phone??''}}" required>
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('extension') ? 'has-error' : ''}}">
    <label for="extension" class="col-md-4 control-label">{{ 'Extension' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="extension" type="text" id="extension" value="{{ $customerphone->extension??''}}" >
        {!! $errors->first('extension', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
