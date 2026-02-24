<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $emailtemplatevariable->name??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <label for="value" class="col-md-4 control-label">{{ 'Value' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="value" type="text" id="value" value="{{ $emailtemplatevariable->value??''}}" readonly >
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
        <label for="type" class="col-md-4 control-label">{{ 'Type' }}</label>
        <div class="col-md-6">
            <select class="form-control" name="email_variable_type_id" id="type">
                @foreach($variableType as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status">
            <option value="1" {{ isset($emailtemplatevariable->status) && $emailtemplatevariable->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ isset($emailtemplatevariable->status) && $emailtemplatevariable->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            function isValidName(name) {

                const invalidChars = /[\d./':!`+=\-*&^%$#)(?"}{[\]|~<>\\[\]]/;
                if (invalidChars.test(name)) {
                    $('#name').val('');
                    $('#value').val('');
                    return false;
                }
                return true;
            }
            function Varible() {
                var nameVal = $('#name').val() || '';

                if (isValidName(nameVal)) {
                    var forValue = `%{${nameVal.toLowerCase().replace(/\s+/g, '_')}}%`;
                    $('#value').val(forValue);
                } else {
                    $('#value').val('');
                    alert('Invalid input: only letters and spaces are allowed.');
                }
            }

            $('input').on('input', function() {
                Varible();
            });

            $('#name').on('input', Varible);

            Varible();
        });


    </script>
@endpush
