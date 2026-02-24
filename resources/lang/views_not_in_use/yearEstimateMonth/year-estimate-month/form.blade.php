<div class="form-group {{ $errors->has('year_estimation_id') ? 'has-error' : ''}}">
    <label for="year_estimation_id" class="col-md-4 control-label">{{ 'Year Estimation Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="year_estimation_id" type="text" id="year_estimation_id" value="{{ $yearestimatemonth->year_estimation_id??''}}" >
        {!! $errors->first('year_estimation_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $yearestimatemonth->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('percentage') ? 'has-error' : ''}}">
    <label for="percentage" class="col-md-4 control-label">{{ 'Percentage' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="percentage" type="text" id="percentage" value="{{ $yearestimatemonth->percentage??''}}" >
        {!! $errors->first('percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="col-md-4 control-label">{{ 'Amount' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="amount" type="text" id="amount" value="{{ $yearestimatemonth->amount??''}}" >
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('month_required_leads') ? 'has-error' : ''}}">
    <label for="month_required_leads" class="col-md-4 control-label">{{ 'Month Required Leads' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="month_required_leads" type="text" id="month_required_leads" value="{{ $yearestimatemonth->month_required_leads??''}}" >
        {!! $errors->first('month_required_leads', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('month_needed_leads') ? 'has-error' : ''}}">
    <label for="month_needed_leads" class="col-md-4 control-label">{{ 'Month Needed Leads' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="month_needed_leads" type="text" id="month_needed_leads" value="{{ $yearestimatemonth->month_needed_leads??''}}" >
        {!! $errors->first('month_needed_leads', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('extra_leads') ? 'has-error' : ''}}">
    <label for="extra_leads" class="col-md-4 control-label">{{ 'Extra Leads' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="extra_leads" type="text" id="extra_leads" value="{{ $yearestimatemonth->extra_leads??''}}" >
        {!! $errors->first('extra_leads', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('extra_amount') ? 'has-error' : ''}}">
    <label for="extra_amount" class="col-md-4 control-label">{{ 'Extra Amount' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="extra_amount" type="text" id="extra_amount" value="{{ $yearestimatemonth->extra_amount??''}}" >
        {!! $errors->first('extra_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="text" id="status" value="{{ $yearestimatemonth->status??''}}" >
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
