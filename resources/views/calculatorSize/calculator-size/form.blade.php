@push('css')
@endpush
<style>
</style>
<div class="row">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" placeholder="Type Here..." id="name" value="{{ $calculatorsize->name??''}}" required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
        <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
        <div class="col-md-12">
            <input class="form-control" name="price" type="number" placeholder="Type Here..." id="price" step="0.01" value="{{ $calculatorsize->price??''}}" required>
            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class=" control-label">{{ 'Status' }}</label>
            <select class="form-control" name="status" id="status" required>
                <option value="1" @if(isset($calculatorsize) && $calculatorsize->status == 1) selected @endif>Active</option>
                <option value="0" @if(isset($calculatorsize) && $calculatorsize->status == 0) selected @endif>InActive</option>
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="container">
        <div class="col-md-offset-4 col-md-4">
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
@endpush
