<div class="row">
    <div class=" col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class=" control-label">{{ 'Product Category' }}</label>
            <select class="form-control  borderRadius custom_modal_select2" name="product_category_id" required>
                @foreach($productCategory as $item)
                    @if(!empty($product->product_category_id))
                        <option value="{{ $item->id }}" @if(isset($product) && $item->id == $product->product_category_id)selected @endif>{{ $item->name??"" }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name??"" }}</option>
                    @endif
                @endforeach
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-md-4 control-label">{{ 'Sub Category Name' }}</label>
            <input class="form-control" name="sub_category" type="text" id="name" value="@if(isset($product->sub_category)){{ $product->sub_category??''}}@endif" placeholder="Type Here...">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-md-4 control-label">{{ 'Price' }}</label>
            <input class="form-control" name="price" type="number" step="0.01" id="price" value="@if(isset($product->price)){{ $product->price??''}}@endif" placeholder="Type Here...">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-0">
            <input class="btn btn-green d-block mx-auto" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>
<script>
    // select 2 initialize
    $(document).ready(function() {
        $('.select_two_initialize_product').select2({
            // placeholder: "Select Lead",
            allowClear: true,
            width: '100%'
        });
    });
</script>
