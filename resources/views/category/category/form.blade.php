<div class="row">
      <div class="col-md-12">
          <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
              <label for="name" class="control-label">{{ 'Name' }} *</label>
              <input class="form-control" name="name" placeholder="Enter Category Name" type="text" id="name" value="@if(isset($category->name)){{ $category->name??''}}@endif" required>
              {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          </div>
          <input type="hidden" name="created_by" value="{{ auth()->id() }}">
      </div>

      <div class="col-md-12">
          <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
              <label for="status" class="control-label">{{ 'Status' }}</label>
              <select class="form-control" name="status">
                {{--<option value="1" @if(isset($category) && $category->status=='1') selected @endif>Active</option>--}}
                {{--<option value="0" @if(isset($category) && $category->status=='0') selected @endif>Inactive</option>--}}

                <option value="1" @if(isset($category->status) && $category->status == 1) selected @endif>Active</option>
                <option value="0" @if(isset($category->status) && $category->status == 0) selected @endif>InActive</option>
                {{--<option value="1">Active</option>--}}
                {{--<option value="0">Inactive</option>--}}
              </select>
              {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
          </div>
      </div>


    <div class="col-md-4">
        <div class="form-group mb-0 flex-row align-items-center {{ $errors->has('colour_id') ? 'has-error' : ''}}">
            <label for="colour_id" class="control-label mb-0">{{ 'Colour' }}</label>
            <input class="form-control" name="color_id" type="color" value="@if(isset($category->color_id)){{$category->color_id??''}}@endif" placeholder="Enter Name">
            {!! $errors->first('colour_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-8 d-flex align-items-end justify-content-end">
        <div class="form-group mb-0">
            <input class="btn btn-green d-block mx-auto" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>