<div class="form-group {{ $errors->has('email_template_id') ? 'has-error' : ''}}">
    <label for="email_template_id" class="col-md-4 control-label">{{ 'Email Template Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="email_template_id" type="text" id="email_template_id" value="{{ $emailtemplateattachment->email_template_id??''}}" >
        {!! $errors->first('email_template_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $emailtemplateattachment->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
