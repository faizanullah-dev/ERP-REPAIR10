<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
            <input class="form-control" name="name" type="text" id="name" value="{{ $customertype->name??''}}" required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-0">
            <input class="btn btn-primary mx-auto" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>