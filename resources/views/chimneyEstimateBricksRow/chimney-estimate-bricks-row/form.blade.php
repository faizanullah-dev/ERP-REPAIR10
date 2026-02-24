<div class="form-group {{ $errors->has('chimney_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="chimney_estimate_calculator_id" class="col-md-4 control-label">{{ 'Chimney Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="chimney_estimate_calculator_id" type="text" id="chimney_estimate_calculator_id" value="{{ $chimneyestimatebricksrow->chimney_estimate_calculator_id??''}}" >
        {!! $errors->first('chimney_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('section') ? 'has-error' : ''}}">
    <label for="section" class="col-md-4 control-label">{{ 'Section' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="section" type="text" id="section" value="{{ $chimneyestimatebricksrow->section??''}}" >
        {!! $errors->first('section', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('bricks') ? 'has-error' : ''}}">
    <label for="bricks" class="col-md-4 control-label">{{ 'Bricks' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="bricks" type="text" id="bricks" value="{{ $chimneyestimatebricksrow->bricks??''}}" >
        {!! $errors->first('bricks', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rows') ? 'has-error' : ''}}">
    <label for="rows" class="col-md-4 control-label">{{ 'Rows' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="rows" type="text" id="rows" value="{{ $chimneyestimatebricksrow->rows??''}}" >
        {!! $errors->first('rows', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('total_bricks_rows') ? 'has-error' : ''}}">
    <label for="total_bricks_rows" class="col-md-4 control-label">{{ 'Total Bricks Rows' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="total_bricks_rows" type="text" id="total_bricks_rows" value="{{ $chimneyestimatebricksrow->total_bricks_rows??''}}" >
        {!! $errors->first('total_bricks_rows', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
