<div class="form-group {{ $errors->has('campaign_detail_id') ? 'has-error' : ''}}">
    <label for="campaign_detail_id" class="col-md-4 control-label">{{ 'Campaign Detail Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="campaign_detail_id" type="text" id="campaign_detail_id" value="{{ $campaignattachment->campaign_detail_id??''}}" >
        {!! $errors->first('campaign_detail_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $campaignattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
