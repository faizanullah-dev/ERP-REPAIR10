<div class="form-group {{ $errors->has('template_id') ? 'has-error' : ''}}">
    <label for="template_id" class="col-md-4 control-label">{{ 'Template Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="template_id" type="text" id="template_id" value="{{ $proposaltemplateattachment->template_id??''}}" >
        {!! $errors->first('template_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $proposaltemplateattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('is_primary') ? 'has-error' : ''}}">
    <label for="is_primary" class="col-md-4 control-label">{{ 'Is Primary' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="is_primary" type="text" id="is_primary" value="{{ $proposaltemplateattachment->is_primary??''}}" >
        {!! $errors->first('is_primary', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
