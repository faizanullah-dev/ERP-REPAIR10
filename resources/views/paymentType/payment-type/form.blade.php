<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
            <input class="form-control" name="name" type="text" placeholder="Enter payment type name" id="name" value="{{ $paymenttype->name??''}}" required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
            <select class="form-control  custom_modal_select2 borderRadius" name="status" id="status" required>
                {{--<option value="1" @if(isset($paymenttype) && $paymenttype->status == 1) selected @endif>Active</option>--}}
                {{--<option value="0" @if(isset($paymenttype) && $paymenttype->status == 0) selected @endif>InActive</option>--}}

                <option value="1" @if(optional($paymenttype)->status == 1) selected @endif>Active</option>
                <option value="0" @if(optional($paymenttype)->status == 0) selected @endif>InActive</option>
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
