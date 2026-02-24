<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name'}} *</label>
    <div class="col-md-6">
        <input class="form-control" placeholder="Enter name" name="name" type="text" id="name" value="{{ $category->name??''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status">
            <option value="1" @if(isset($category) && $category->status=='1') selected @endif>Active</option>
            <option value="0" @if(isset($category) && $category->status=='0') selected @endif>Inactive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
