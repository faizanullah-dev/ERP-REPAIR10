<div class="form-group {{ $errors->has('customer_type_id') ? 'has-error' : ''}}">
    <label for="customer_type_id" class="col-md-4 control-label">{{ 'Customer Type' }}</label>
    <div class="col-md-6">
        {{-- <input class="form-control" name="customer_type_id" type="number" id="customer_type_id" value="{{ $customer->customer_type_id??''}}" required> --}}
        @foreach($customerTypes as $key=>$customerType)
            <div class="mb-3">
                <input type="radio" class="form-check-input" name="customer_type_id" id="customer_type_id{{$key}}" value="{{$customerType->id}}" @if(isset($customer->customer_type_id) && $customer->customer_type_id== $customerType->id) checked @endif>
                <label for="customer_type_id{{$key}}" class="form-label input_labels p-18">{{$customerType->name}}</label>
            </div>
        @endforeach
        {!! $errors->first('customer_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('salesman_id') ? 'has-error' : ''}}">
    <label for="salesman_id" class="col-md-4 control-label">{{ 'Salesman' }}</label>
    <div class="col-md-6">
        {{-- <input class="form-control" name="salesman_id" type="number" id="salesman_id" value="{{ $customer->salesman_id??''}}" required> --}}
        <select class="form-control select2" name="salesman_id" id="salesman_id">
            <option value="">None</option>
            @foreach($saleMen as $key=>$saleMan)
                <option value="{{ $saleMan->id??''}}" @if(isset($customer->salesman_id) && $customer->salesman_id==$saleMan->id) selected @endif>{{ $saleMan->first_name.' '.$saleMan->last_name??''}}</option>
            @endforeach
        </select>
        {!! $errors->first('salesman_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('referral_source_id') ? 'has-error' : ''}}">
    <label for="referral_source_id" class="col-md-4 control-label">{{ 'Referral Source' }}</label>
    <div class="col-md-6">
        {{-- <input class="form-control" name="referral_source_id" type="number" id="referral_source_id" value="{{ $customer->referral_source_id??''}}" required> --}}
        <select class="form-control select2" name="referral_source_id" id="referral_source_id">
            <option value="">None</option>
            @foreach($referralSources as $key=>$referralSource)
                <option value="{{$referralSource->id}}" @if(isset($customer->referral_source_id) && $customer->referral_source_id==$referralSource->id) selected @endif>{{$referralSource->name}}</option>
            @endforeach
        </select>
        {!! $errors->first('referral_source_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('call_center_representative_id') ? 'has-error' : ''}}">
    <label for="call_center_representative_id" class="col-md-4 control-label">{{ 'Call Center Representative' }}</label>
    <div class="col-md-6">
        {{-- <input class="form-control" name="call_center_representative_id" type="number" id="call_center_representative_id" value="{{ $customer->call_center_representative_id??''}}" > --}}
        <select class="form-control select2" name="call_center_representative_id" id="call_center_representative_id">
            <option value="{{ $customer->call_center_representative_id??''}}" >None</option>
        </select>
        {!! $errors->first('call_center_representative_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
    <label for="first_name" class="col-md-4 control-label">{{ 'First Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="first_name" type="text" id="first_name" value="{{ $customer->first_name??''}}" required>
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
    <label for="last_name" class="col-md-4 control-label">{{ 'Last Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="last_name" type="text" id="last_name" value="{{ $customer->last_name??''}}" required>
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
    <label for="company" class="col-md-4 control-label">{{ 'Company' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="company" type="text" id="company" value="{{ $customer->company??''}}" >
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondary_first_name') ? 'has-error' : ''}}">
    <label for="secondary_first_name" class="col-md-4 control-label">{{ 'Secondary First Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="secondary_first_name" type="text" id="secondary_first_name" value="{{ $customer->secondary_first_name??''}}" >
        {!! $errors->first('secondary_first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondary_last_name') ? 'has-error' : ''}}">
    <label for="secondary_last_name" class="col-md-4 control-label">{{ 'Secondary Last Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="secondary_last_name" type="text" id="secondary_last_name" value="{{ $customer->secondary_last_name??''}}" >
        {!! $errors->first('secondary_last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('referred_by_note') ? 'has-error' : ''}}">
    <label for="referred_by_note" class="col-md-4 control-label">{{ 'Referred By Note' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="referred_by_note" type="text" id="referred_by_note" value="{{ $customer->referred_by_note??''}}" >
        {!! $errors->first('referred_by_note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('custom') ? 'has-error' : ''}}">
    <label for="custom" class="col-md-4 control-label">{{ 'Custom' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="custom" type="text" id="custom" value="{{ $customer->custom??''}}" required>
        {!! $errors->first('custom', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('customer_note') ? 'has-error' : ''}}">
    <label for="customer_note" class="col-md-4 control-label">{{ 'Customer Note' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="customer_note" type="textarea" id="customer_note" >{{ $customer->customer_note??''}}</textarea>
        {!! $errors->first('customer_note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        {{-- <input class="form-control" name="status" type="text" id="status" value="{{ $customer->status??''}}" > --}}
        <select class="form-control select2" name="status" id="status">
            <option value="1" @if(isset($customer->status) && $customer->status== 1) selected @endif>Active</option>
            <option value="0" @if(isset($customer->status) && $customer->status== 0) selected @endif>Inactive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
