<div class="form-group {{ $errors->has('roof_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="roof_estimate_calculator_id" class="col-md-4 control-label">{{ 'Roof Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="roof_estimate_calculator_id" type="text" id="roof_estimate_calculator_id" value="{{ $roofestimateskylight->roof_estimate_calculator_id??''}}" >
        {!! $errors->first('roof_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
    <label for="size" class="col-md-4 control-label">{{ 'Size' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="size" type="text" id="size" value="{{ $roofestimateskylight->size??''}}" >
        {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="col-md-4 control-label">{{ 'Quantity' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="quantity" type="text" id="quantity" value="{{ $roofestimateskylight->quantity??''}}" >
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="text" id="price" value="{{ $roofestimateskylight->price??''}}" >
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
