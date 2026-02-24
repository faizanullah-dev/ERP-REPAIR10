<div class="form-group {{ $errors->has('advertisement_id') ? 'has-error' : ''}}">
    <label for="advertisement_id" class="col-md-4 control-label">{{ 'Advertisement Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="advertisement_id" type="text" id="advertisement_id" value="{{ $monthlyadvertisement->advertisement_id??''}}" >
        {!! $errors->first('advertisement_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('referral_source_id') ? 'has-error' : ''}}">
    <label for="referral_source_id" class="col-md-4 control-label">{{ 'Referral Source Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="referral_source_id" type="text" id="referral_source_id" value="{{ $monthlyadvertisement->referral_source_id??''}}" >
        {!! $errors->first('referral_source_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="text" id="price" value="{{ $monthlyadvertisement->price??''}}" >
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
