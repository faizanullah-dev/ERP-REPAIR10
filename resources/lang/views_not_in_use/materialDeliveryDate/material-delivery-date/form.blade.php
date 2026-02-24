<div class="form-group {{ $errors->has('material_delivery_date') ? 'has-error' : ''}}">
    <label for="material_delivery_date" class="col-md-4 control-label">{{ 'Material Delivery Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="material_delivery_date" type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"  id="material_delivery_date" value="{{ $materialdeliverydate->material_delivery_date??''}}" >
        {!! $errors->first('material_delivery_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ strip_tags($materialdeliverydate->description??'')}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('material_id') ? 'has-error' : ''}}">
    <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Material List ' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields select2 borderRadius" name="material_id" id="material_id" required>
            @foreach($materials as $material)
                <option value="{{$material->id}}" @if(isset($materialdeliverydate)  && $material->id == $materialdeliverydate->material_id) selected @endif >{{$material->name}}</option>
            @endforeach
        </select>
        {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>

@push('js')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
</script>
@endpush