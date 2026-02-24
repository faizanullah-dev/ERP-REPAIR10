<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('material_delivery_date') ? 'has-error' : ''}}">
            <label for="material_delivery_date" class="col-md-6 control-label">{{ 'Material Delivery Date' }}</label>
            <input class="form-control" name="material_delivery_date" type="date" id="material_delivery_date" value="{{ $materialdeliverydate->material_delivery_date ?? $yearEstimation->year . '-01-01'}}">
            {!! $errors->first('material_delivery_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('material_id') ? 'has-error' : ''}}">
            <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Material List ' }}</label>
            <select class="form-control clr_input_fields select2 borderRadius" name="material_id" id="material_id" required>
                @foreach($materials as $material)
                    <option value="{{$material->id}}" @if(isset($materialdeliverydate) && $material->id == $materialdeliverydate->material_id) selected @endif >{{$material->name}}</option>
                @endforeach
            </select>
            {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
            <textarea class="form-control" name="description" id="description" required>{!! $materialdeliverydate->description??''!!}</textarea>
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>
@push('js')
    {{--<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>--}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // $(document).ready(function () {
        //     CKEDITOR.replace('description');
        // });
        $(document).ready(function() {
            var descriptionElement = document.querySelector('#description');
            if (descriptionElement) {
                ClassicEditor
                    .create(descriptionElement)
                    .catch(error => {
                        console.error(error);
                    });
            }
        });

    </script>
@endpush