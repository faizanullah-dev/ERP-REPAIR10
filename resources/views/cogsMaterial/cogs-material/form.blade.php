<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
            <input required class="form-control" name="name" type="text" id="name" placeholder="Enter COGS Material Name" value="{{ $cogsmaterial->name??''}}" >
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
            <select class="form-control custom_modal_select2 " name="status" >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

{{--<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="text" id="status" value="{{ $cogsmaterial->status??''}}" >
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ $cogsmaterial->user_id??''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>--}}

    <div class="col-md-12">
        <div class="form-group mb-0">
            <input class="btn btn-green d-block mx-auto" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>