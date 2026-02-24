<div class="col-md-6">
    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
        <label for="category_id" class="control-label">{{ 'Category *' }}</label>
           {{--<input class="form-control" name="category_id" type="text" id="category_id" value="{{ $companycontact->category_id??''}}" >--}}
           {{--<label for="salesman-customer-rep" class="form-label input_labels p-18">{{ 'Salesman' }}</label>--}}
           <select class="form-control  select2 borderRadius" name="category_id" id="category_id">
               <option value="">Select</option>
               @foreach($categories as $key => $category)
                   <option value="{{ $category->id}}" @if(isset($companycontact) && $category->id == $companycontact->category_id) selected @endif required>{{ $category->name??''}}</option>
               @endforeach
           </select> {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
        <label for="company" class="control-label">{{ 'Company *' }}</label>
            <input class="form-control" name="company" type="text" required id="company" placeholder="Enter Company Name" value="{{ $companycontact->company??''}}" >
            {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="control-label">{{ 'Name *' }}</label>
            <input class="form-control" name="name" type="text" id="name" required placeholder="Enter Name" value="{{$companycontact->name??''}}" >
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
        <label for="address" class="control-label">{{ 'Address *' }}</label>
            <input class="form-control" name="address" type="text" id="address" required placeholder="Enter Address" value="{{ $companycontact->address??''}}" >
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
        <label for="email" class="control-label">{{ 'Email *' }}</label>
            <input class="form-control" name="email" type="email" id="email" required placeholder="Enter email" value="{{ $companycontact->email??''}}" >
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
        <label for="phone" class="control-label">{{ 'Phone *' }}</label>
            <input class="form-control" name="phone" type="text" id="phone" required placeholder="Enter Phone Number" value="{{ $companycontact->phone??''}}" >
            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('insurance_start') ? 'has-error' : ''}}">
        <label for="insurance_start" class="control-label">{{ 'Insurance Start *' }}</label>
        <input class="form-control" name="insurance_start" type="date" id="insurance_start" required placeholder="Select Insurance Start date" value="{{ $companycontact->insurance_start??'' }}">
        {!! $errors->first('insurance_start', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('insurance_expire') ? 'has-error' : ''}}">
        <label for="insurance_expire" class="control-label">{{ 'Insurance Expire *' }}</label>
        <input class="form-control" name="insurance_expire" type="date" id="insurance_expire" min="{{ now()->subDay()->format('Y-m-d') }}" required placeholder="Select Insurance Expiry date" value="{{ $companycontact->insurance_expire??'' }}">
        {!! $errors->first('insurance_expire', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('insurance_status') ? 'has-error' : ''}}">
    <label for="insurance_status" class="control-label">{{ 'Status *' }}</label>
        <select class="form-control  select2 borderRadius" name="insurance_status" id="insurance_status" readonly required>
            <option value="active" @if(isset($companycontact) && $companycontact->insurance_status == 'active') selected @endif>Active</option>
            <option value="expire" @if(isset($companycontact) && $companycontact->insurance_status == 'expire') selected @endif>Expire</option>
        </select>
        {!! $errors->first('insurance_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="col-md-6">
    <div class="form-group {{ $errors->has('total_paid') ? 'has-error' : ''}}">
    <label for="total_paid" class="control-label">{{ 'Total Paid *' }}</label>
        <input class="form-control" name="total_paid" type="text" id="total_paid" value="{{ $companycontact->total_paid??"" }}" required placeholder="Enter Total Paid" pattern="\d*" oninput="this.value = formatCurrency(this.value);" required >
        {!! $errors->first('total_paid', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{env('googleAPI')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>

        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('address'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                var latlng = new google.maps.LatLng(latitude, longitude);
                var geocoder = geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var address = results[0].formatted_address;
                        }//ends if
                    }
                });
            });
        });
        $(document).on('keyup','#email',function(){
            var email = $(this).val();
            $.ajax({
                url                             : "{{ route('check_email') }}",
                method                          : "POST",
                data                            : {
                    '_token': '{{ csrf_token() }}',
                    email          :email,
                },
                success: function( data ) {
                    console.log(data);
                    if(data=='yes'){
                        $('#email_exist_msg').text("This email is already registered");
                        $('#submit_btn').attr('disabled','disabled');
                        event.preventDefault();
                    }else{
                        $('#email_exist_msg').text("");
                        $('#submit_btn').removeAttr('disabled','disabled');
                    }
                },

            });
        });

        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
           $('#companyContactValidate').validate({
                ignore: [],
                rules: {
                    category_id: {
                        required: true
                    },
                    company: {
                        required: true,
                        noSpace: true
                    },

                    address: {
                        required: true
                    },
                    name: {
                        required: true,
                        noSpace: true
                    },

                    email: {
                        required: true
                    },
                    phone: {
                        required: true,
                        minlength: 14,
                        maxlength: 14
                    },

                    insurance_start: {
                        required: true
                    },
                    insurance_expire: {
                        required: true,
                        noSpace: true
                    },
                    total_paid: {
                        required: true,
                        noSpace: true
                    }
                },
                messages: {
                    category_id: {
                        required: "Please select category."
                    },
                    company: {
                        required: "Please enter company name.",
                        noSpace: "Spaces are not allowed."
                    },
                    address: {
                        required: "Please enter address.",
                        noSpace: "Spaces are not allowed."
                    },
                    name: {
                        required: "Please enter name.",
                        noSpace: "Spaces are not allowed."
                    },

                    email: {
                        required: "Please enter email."
                    },
                    phone: {
                        required: 'Phone number is required.',
                        minlength: 'Invalid phone number. Enter at least 10 digits.',
                        maxlength: 'Invalid phone number. Enter at most 10 digits.'
                    },

                    insurance_start: {
                        required: "Please select insurance start date."
                    },
                    insurance_expire: {
                        required: "Please select insurance expire date."

                    },
                    total_paid: {
                        required: "Please enter total paid.",
                        noSpace: "Spaces are not allowed."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(document).ready(function () {
            $('#phone').mask('(000) 000-0000'); // Use zeros to represent digit placeholders
        });


        $(document).ready(function(){
            $('#insurance_expire').change(function(){
                var selectedDate = new Date($(this).val());
                var currentDate = new Date();

                if(selectedDate < currentDate){
                    $('#insurance_status').val('expire');
                } else {
                    $('#insurance_status').val('active');
                }
            });
        });

        $(document).ready(function () {
            $("#insurance_start").on("change", function () {
                var startDate = $(this).val();
                $("#insurance_expire").attr("min", startDate);
            });
        });

        $(document).ready(function() {
            function formatCurrency(value) {
                value = value.replace(/,/g, '');
                var parts = value.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return parts.join('.');
            }

            $('#total_paid').on('input', function() {
                // Ensure that only valid numeric values are allowed
                var inputValue = $(this).val().replace(/[^\d.]/g, '');
                $(this).val(formatCurrency(inputValue));
            });

            $('form').submit(function() {
                // Remove commas before submitting the form
                $('#total_paid').val($('#total_paid').val().replace(/,/g, ''));
            });
        });
    </script>
@endpush
