<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="description" type="text" id="description" value="{{ $emailbranding->description??''}}" >
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $emailbranding->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
    <label for="designation" class="col-md-4 control-label">{{ 'Designation' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="designation" type="text" id="designation" value="{{ $emailbranding->designation??''}}" >
        {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="col-md-4 control-label">{{ 'Phone' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="phone" type="text" id="phone" value="{{ $emailbranding->phone??''}}" >
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="email" type="text" id="email" value="{{ $emailbranding->email??''}}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
    <label for="website" class="col-md-4 control-label">{{ 'Website' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="website" type="text" id="website" value="{{ $emailbranding->website??''}}" >
        {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="col-md-4 control-label">{{ 'Address' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="address" type="text" id="address" value="{{ $emailbranding->address??''}}" >
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
    <label for="logo" class="col-md-4 control-label">{{ 'Logo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="logo" type="text" id="logo" value="{{ $emailbranding->logo??''}}" >
        {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('logo_position') ? 'has-error' : ''}}">
    <label for="logo_position" class="col-md-4 control-label">{{ 'Logo Position' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="logo_position" type="text" id="logo_position" value="{{ $emailbranding->logo_position??''}}" >
        {!! $errors->first('logo_position', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('logo_alignment') ? 'has-error' : ''}}">
    <label for="logo_alignment" class="col-md-4 control-label">{{ 'Logo Alignment' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="logo_alignment" type="text" id="logo_alignment" value="{{ $emailbranding->logo_alignment??''}}" >
        {!! $errors->first('logo_alignment', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('logo_background') ? 'has-error' : ''}}">
    <label for="logo_background" class="col-md-4 control-label">{{ 'Logo Background' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="logo_background" type="text" id="logo_background" value="{{ $emailbranding->logo_background??''}}" >
        {!! $errors->first('logo_background', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('social_link_one') ? 'has-error' : ''}}">
    <label for="social_link_one" class="col-md-4 control-label">{{ 'Social Link One' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="social_link_one" type="text" id="social_link_one" value="{{ $emailbranding->social_link_one??''}}" >
        {!! $errors->first('social_link_one', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('social_link_two') ? 'has-error' : ''}}">
    <label for="social_link_two" class="col-md-4 control-label">{{ 'Social Link Two' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="social_link_two" type="text" id="social_link_two" value="{{ $emailbranding->social_link_two??''}}" >
        {!! $errors->first('social_link_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('social_link_three') ? 'has-error' : ''}}">
    <label for="social_link_three" class="col-md-4 control-label">{{ 'Social Link Three' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="social_link_three" type="text" id="social_link_three" value="{{ $emailbranding->social_link_three??''}}" >
        {!! $errors->first('social_link_three', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('social_link_four') ? 'has-error' : ''}}">
    <label for="social_link_four" class="col-md-4 control-label">{{ 'Social Link Four' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="social_link_four" type="text" id="social_link_four" value="{{ $emailbranding->social_link_four??''}}" >
        {!! $errors->first('social_link_four', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
