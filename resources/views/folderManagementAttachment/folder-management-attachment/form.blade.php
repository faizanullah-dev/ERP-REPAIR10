<div class="form-group {{ $errors->has('folder_management_id') ? 'has-error' : ''}}">
    <label for="folder_management_id" class="col-md-4 control-label">{{ 'Folder Management Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="folder_management_id" type="text" id="folder_management_id" value="{{ $foldermanagementattachment->folder_management_id??''}}" >
        {!! $errors->first('folder_management_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $foldermanagementattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
