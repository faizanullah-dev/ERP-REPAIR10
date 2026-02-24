<div class="form-group {{ $errors->has('document_id') ? 'has-error' : ''}}">
    <label for="document_id" class="col-md-4 control-label">{{ 'Document Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="document_id" type="text" id="document_id" value="{{ $photoanddocumentattachment->document_id??''}}" >
        {!! $errors->first('document_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $photoanddocumentattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
