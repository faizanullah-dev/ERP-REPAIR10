<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $positionblock->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('insurance_rate') ? 'has-error' : ''}}">
    <label for="insurance_rate" class="col-md-4 control-label">{{ 'Insurance Rate' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="insurance_rate" type="text" id="insurance_rate" value="{{ $positionblock->insurance_rate??''}}" >
        {!! $errors->first('insurance_rate', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pay_rate_weekly') ? 'has-error' : ''}}">
    <label for="pay_rate_weekly" class="col-md-4 control-label">{{ 'Pay Rate Weekly' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pay_rate_weekly" type="text" id="pay_rate_weekly" value="{{ $positionblock->pay_rate_weekly??''}}" >
        {!! $errors->first('pay_rate_weekly', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('total_yearly_pay') ? 'has-error' : ''}}">
    <label for="total_yearly_pay" class="col-md-4 control-label">{{ 'Total Yearly Pay' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="total_yearly_pay" type="text" id="total_yearly_pay" value="{{ $positionblock->total_yearly_pay??''}}" >
        {!! $errors->first('total_yearly_pay', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cost_of_insurance') ? 'has-error' : ''}}">
    <label for="cost_of_insurance" class="col-md-4 control-label">{{ 'Cost Of Insurance' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="cost_of_insurance" type="text" id="cost_of_insurance" value="{{ $positionblock->cost_of_insurance??''}}" >
        {!! $errors->first('cost_of_insurance', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
