<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $schedulingtask->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('color_id') ? 'has-error' : ''}}">
    <label for="color_id" class="col-md-4 control-label">{{ 'Color Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="color_id" type="text" id="color_id" value="{{ $schedulingtask->color_id??''}}" >
        {!! $errors->first('color_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="col-md-4 control-label">{{ 'Start Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="start_date" type="text" id="start_date" value="{{ $schedulingtask->start_date??''}}" >
        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="col-md-4 control-label">{{ 'End Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="end_date" type="text" id="end_date" value="{{ $schedulingtask->end_date??''}}" >
        {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="description" type="text" id="description" value="{{ $schedulingtask->description??''}}" >
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
