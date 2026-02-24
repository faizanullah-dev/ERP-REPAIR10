<div class="col-md-12">
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}*</label>

        <input class="form-control" name="name" type="text" id="name" value="{{ $referralsource->name??''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-12">
    <div class="form-group ">

    <label for="name" class="col-md-4 control-label">{{ 'Status' }}</label>

        {{--<input class="form-control" name="name" type="text" id="name" value="{{ $referralsource->name??''}}" required>--}}
        {{--{!! $errors->first('name', '<p class="help-block">:message</p>') !!}--}}
        <select class="form-control" value="{{ $referralsource->status??''}}" name="status" id="">
            <option value="1" @if(isset($referralsource) && $referralsource->status=='1') selected @endif>Active</option>
            <option value="0" @if(isset($referralsource) && $referralsource->status=='0') selected @endif>Inactive</option>
        </select>
    </div>
</div>



<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
