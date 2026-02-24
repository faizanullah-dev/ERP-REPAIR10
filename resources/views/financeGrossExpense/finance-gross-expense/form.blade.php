<div class="form-group {{ $errors->has('finance_sheet_id') ? 'has-error' : ''}}">
    <label for="finance_sheet_id" class="col-md-4 control-label">{{ 'Finance Sheet Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="finance_sheet_id" type="text" id="finance_sheet_id" value="{{ $financegrossexpense->finance_sheet_id??''}}" >
        {!! $errors->first('finance_sheet_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
