<div class="form-group {{ $errors->has('progress_board_id') ? 'has-error' : ''}}">
    <label for="progress_board_id" class="col-md-4 control-label">{{ 'Progress Board Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="progress_board_id" type="text" id="progress_board_id" value="{{ $progressboardcategory->progress_board_id??''}}" >
        {!! $errors->first('progress_board_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="col-md-4 control-label">{{ 'Category Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="category_id" type="text" id="category_id" value="{{ $progressboardcategory->category_id??''}}" >
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
