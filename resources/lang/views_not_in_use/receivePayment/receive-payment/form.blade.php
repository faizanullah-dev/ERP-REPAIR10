<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead' }}</label>
    <div class="col-md-6">
        <select class="form-control custom_modal_select2 borderRadius" name="lead_id" id="lead_id" required>
            @if(!empty($leadExist))
                @foreach($leads as $lead)
                    <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                @endforeach
            @else
            @foreach($leads as $lead)
                <option value="{{$lead->id}}" @if(isset($receivepayment)  && $lead->id == $receivepayment->lead_id) selected @endif >{{$lead->title}}</option>
            @endforeach
            @endif
        </select>
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">
    <label for="payment_type" class="col-md-4 control-label">{{ 'Payment Type' }}</label>
    <div class="col-md-6">
        <select class="form-control custom_modal_select2 borderRadius" name="payment_type" id="payment_type" required>
            @foreach($paymenttypes as $paymenttype)
           <option value="{{$paymenttype->id}}" @if(isset($receivepayment) && $paymenttype->id == $receivepayment->payment_type) selected @endif>{{ $paymenttype->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('Reference_number') ? 'has-error' : ''}}">
    <label for="Reference_number" class="col-md-4 control-label">{{ 'Reference Number' }}</label>
    <div class="col-md-6">
        <input class="form-control" placeholder="Enter reference number" name="Reference_number" type="text" id="Reference_number" value="{{ $receivepayment->Reference_number??''}}" required>
        {!! $errors->first('Reference_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="date" type="date" min="2023-05-18" id="date" value="{{ $receivepayment->date??''}}" >
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="col-md-4 control-label">{{ 'Amount' }}</label>
    <div class="col-md-6">
        <input class="form-control" placeholder="Enter amount" name="amount" type="text" id="amount" value="{{ $receivepayment->amount??''}}" required>
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
