<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
            <input class="form-control" name="name" type="text" id="name" value="{{ $emailtemplatefolder->name??''}}" placeholder="Enter Folder Name..." required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class=" control-label">{{ 'Status' }}</label>
            <select class="form-control" name="status" id="status" required>
                <option value="1" @if(optional($emailtemplatefolder)->status == 1) selected @endif>Active</option>
                <option value="0" @if(optional($emailtemplatefolder)->status == 0) selected @endif>InActive</option>
                {{--<option value="1">Active</option>--}}
                {{--<option value="0">InActive</option>--}}
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-0">
            <input class="btn btn-green d-block mx-auto" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>