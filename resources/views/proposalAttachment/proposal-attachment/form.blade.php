<div class="form-group {{ $errors->has('proposal_id') ? 'has-error' : ''}}">
    <label for="proposal_id" class="col-md-4 control-label">{{ 'Proposal Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="proposal_id" type="text" id="proposal_id" value="{{ $proposalattachment->proposal_id??''}}" >
        {!! $errors->first('proposal_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $proposalattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
