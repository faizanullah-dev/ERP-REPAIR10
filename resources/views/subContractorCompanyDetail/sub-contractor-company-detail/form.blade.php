<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $subcontractorcompanydetail->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="col-md-4 control-label">{{ 'Address' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="address" type="textarea" id="address" >{{ $subcontractorcompanydetail->address??''}}</textarea>
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    <label for="city" class="col-md-4 control-label">{{ 'City' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="city" type="text" id="city" value="{{ $subcontractorcompanydetail->city??''}}" >
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    <label for="state" class="col-md-4 control-label">{{ 'State' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="state" type="text" id="state" value="{{ $subcontractorcompanydetail->state??''}}" >
        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('zip_code') ? 'has-error' : ''}}">
    <label for="zip_code" class="col-md-4 control-label">{{ 'Zip Code' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="zip_code" type="text" id="zip_code" value="{{ $subcontractorcompanydetail->zip_code??''}}" >
        {!! $errors->first('zip_code', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="col-md-4 control-label">{{ 'Phone' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="phone" type="text" id="phone" value="{{ $subcontractorcompanydetail->phone??''}}" >
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="email" type="text" id="email" value="{{ $subcontractorcompanydetail->email??''}}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('corporation') ? 'has-error' : ''}}">
    <label for="corporation" class="col-md-4 control-label">{{ 'Corporation' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="corporation" type="text" id="corporation" value="{{ $subcontractorcompanydetail->corporation??''}}" >
        {!! $errors->first('corporation', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('trades') ? 'has-error' : ''}}">
    <label for="trades" class="col-md-4 control-label">{{ 'Trades' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="trades" type="text" id="trades" value="{{ $subcontractorcompanydetail->trades??''}}" >
        {!! $errors->first('trades', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
    <label for="website" class="col-md-4 control-label">{{ 'Website' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="website" type="text" id="website" value="{{ $subcontractorcompanydetail->website??''}}" >
        {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
