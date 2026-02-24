<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <h5>Customer Information</h5>
            <div class="mt-5">
                <div class="col-md-6 residential_commercial w-100 {{ $errors->has('customer_type_id') ? 'has-error' : ''}}">
                    @foreach($customerTypes as $key=>$customerType)
                        <div class="mb-3">
                            <input type="radio" class="form-check-input" name="customer_type_id" id="customer_type_id{{$key}}" value="{{$customerType->id}}" @if(isset($customer->customer_type_id) && $customer->customer_type_id== $customerType->id) checked @endif required>
                            <label for="customer_type_id{{$key}}" class="form-label input_labels p-18">{{$customerType->name}}</label>
                        </div>
                    @endforeach
                    {!! $errors->first('customer_type_id', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('first_name') ? 'has-error' : ''}}">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">{{ 'First Name' }} *</label>
                            <input type="text" class="form-control clr_input_fields borderRadius" placeholder="Enter first name" id="first_name" name="first_name" value="{{ $customer->first_name??''}}" required>
                            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 {{ $errors->has('last_name') ? 'has-error' : ''}}">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">{{ 'Last Name' }} *</label>
                            <input type="text" class="form-control clr_input_fields borderRadius" placeholder="Enter last name" name="last_name" id="last_name" value="{{ $customer->last_name??''}}" required>
                            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('company') ? 'has-error' : ''}}">
                        <div class="mb-3">
                            <label for="company-name" class="form-label input_labels p-18">{{ 'Company' }} </label>
                            <input type="text" class="form-control clr_input_fields borderRadius" placeholder="Enter company name" name="company" id="company" value="{{ $customer->company??''}}">
                            {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 multiple_inputs{{ $errors->has('email') ? 'has-error' : ''}}">
                        <div class="multiple_inputs">
                            <label for="email"  class="form-label input_labels p-18">{{ 'Email' }} *</label>
                                    <div class="form-group">
                                        <div class="entry  form-inline text-center">
                                                <input type="email" placeholder="Enter your email" name="email" class="form-control clr_input_fields borderRadius" id="email" value="{{ $customer->email ??""}}" required>
                                                <span style="color: red" id="email_exist_msg"></span>
                                        </div>
                                    </div>
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                @if(isset($customer) && $customer->customerPhones != null)
                    <div class="row">
                        <div class="col-md-12 multiple_inputs">
                            <div class="multiple_inputs">
                                <label for="phone" class="form-label input_labels p-18">Phone *</label>
                                @foreach($customer->customerPhones as $key=>$item)
                                    <div class="form-group @if($loop->last) table-fields-phone @endif">
                                        <div class="entry  form-inline text-center">
                                            <input required class="form-control clr_input_fields borderRadius phone" placeholder="( ___ ) ___-____ " name="phone[]" value="{{ $item->phone ??""}}" type="tel" required>
                                            @if($loop->last)
                                                <button class="btn btn-success btn-add-phone inline" type="button">
                                                    <span class="fa fa-plus"></span>
                                                </button>
                                            @else
                                                <button class="btn btn-danger btn-remove inline" type="button">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12 multiple_inputs">
                            <div class="multiple_inputs">
                                <label for="phone" class="form-label input_labels p-18">Phone</label>
                                    <div class="form-group table-fields-phone">
                                        <div class="entry  form-inline text-center">
                                            <input required class="form-control clr_input_fields borderRadius phone" placeholder="( ___ ) ___-____ " name="phone[]" value="{{ $item->phone ??""}}" type="tel" required>
                                            <button class="btn btn-success btn-add-phone inline" type="button">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('salesman_id') ? 'has-error' : ''}}">
                        <div class="mb-3">
                            <label for="salesman-customer-rep" class="form-label input_labels p-18">{{ 'Salesman' }}</label>
                            <select class="form-control clr_input_fields select2 borderRadius" name="salesman_id" id="salesman_id">
                                <option value="">None</option>
                                @foreach($saleMen as $key=>$saleMan)
                                    <option value="{{ $saleMan->id??''}}" @if(isset($customer->salesman_id) && $customer->salesman_id==$saleMan->id) selected @endif required>{{ $saleMan->name??''}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('salesman_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                     <div class="col-md-6 {{ $errors->has('referral_source_id') ? 'has-error' : ''}}">
                        <div class="mb-3">
                            <label for="referred" class="form-label input_labels p-18">{{ 'Referral Source' }}</label>
                            <select class="form-control clr_input_fields borderRadius select2" name="referral_source_id" id="referral_source_id">
                                <option value="">None</option>
                                @foreach($referralSources as $key=>$referralSource)
                                    <option value="{{$referralSource->id}}" @if(isset($customer->referral_source_id) && $customer->referral_source_id==$referralSource->id) selected @endif required>{{$referralSource->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('referral_source_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        <h5>Customer Address</h5>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label input_labels p-18">Address *</label>
                            <input type="text" name="address" value="{{ $customer->profile->address ??''}}" class="form-control clr_input_fields borderRadius" id="address" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="city" class="form-label input_labels p-18">City</label>
                            <input type="text" name="city"  class="form-control clr_input_fields borderRadius" value="{{ $customer->profile->city ??''}}" id="txtCity">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="state" class="form-label input_labels p-18">State</label>
                            <input type="text" name="state" value="{{ $customer->profile->state ??''}}" class="form-control clr_input_fields borderRadius" id="txtState">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="zip" class="form-label input_labels p-18">Zip</label>
                            <input type="text" name="zip" value="{{ $customer->profile->zip ??''}}" class="form-control clr_input_fields borderRadius" id="txtZip">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="country" class="form-label input_labels p-18">Country</label>
                            <input type="text" name="country" value="{{ $customer->profile->country ??''}}" class="form-control clr_input_fields borderRadius" id="txtCountry">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 {{ $errors->has('customer_note') ? 'has-error' : ''}}">
                        <div class="mb-3">
                            <label for="call-center" class="form-label input_labels p-18">{{ 'Customer Note' }}</label>
                            <textarea class="form-control borderRadius clr_textarea_fields" rows="6" name="customer_note" type="textarea" id="customer_note">{{ $customer->customer_note ??''}}</textarea>
                            {!! $errors->first('customer_note', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6 mt-5">
            {{-- <button type="submit" class="btn green_btn borderRadius w-100 submit_btn large_green_btn create_btn">Create</button> --}}
            <button type="submit" id="submit_btn" class="btn green_btn borderRadius w-100 submit_btn large_green_btn create_btn" >Create</button>
        </div>

    </div>
</div>





@push('js')
{{--<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAM52bC4tsQFv_3IPHLJ7kyrMx1Ys_teaU"></script>--}}
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{env('googleAPI')}}"></script>
<script>
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('address'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var latlng = new google.maps.LatLng(latitude, longitude);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var address = results[0].formatted_address;
                        var pin = results[0].address_components[results[0].address_components.length - 1].long_name;
                        var country = results[0].address_components[results[0].address_components.length - 2].long_name;
                        var state = results[0].address_components[results[0].address_components.length - 3].long_name;
                        var city = results[0].address_components[results[0].address_components.length - 4].long_name;
                        document.getElementById('txtCountry').value = country;
                        document.getElementById('txtState').value = state;
                        document.getElementById('txtCity').value = city;
                        document.getElementById('txtZip').value = pin;
                    }
                }
            });
        });
    });


   $(document).ready(function () {
      var phone = 0;
      $(document).on('click', '.btn-add-phone', function (e) {
         e.preventDefault();
         console.log(phone)
         if (phone < 4) {
             var tableFields = $('.table-fields-phone'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(tableFields);

             newEntry.find('input').val('');
             tableFields.find('.entry:not(:last) .btn-add-phone')
                .removeClass('btn-add-phone').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="fa fa-minus"></span>');
            phone++;
         }
      }).on('click', '.btn-remove', function (e) {
         $(this).parents('.entry:first').remove();
         phone--;
         e.preventDefault();
         return false;
      });
    });

    // Used to format phone number
    function phoneFormatter() {

       $(document).on('input', '.phone', function (e) {
          var number = $(this).val().replace(/[^\d]/g, '')
          if (number.length < 7) {
             number = number.replace(/(\d{0,3})(\d{0,3})/, "($1) $2");
          } else if (number.length <= 10) {
             number = number.replace(/(\d{3})(\d{3})(\d{1,4})/, "($1) $2-$3");
          } else {
             // ignore additional digits
             number = number.replace(/(\d{3})(\d{1,3})(\d{1,4})(\d.*)/, "($1) $2-$3");
          }
          $(this).val(number)
       });
    };
    $(phoneFormatter);

   $("#email").on('keyup paste',function(){
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
                   Swal.fire({
                       title: "Oops..",
                       html:  "This email is already registered",
                       icon:  "error",
                       timer: 5000,
                       buttons: false,
                   });
               }else{
                   $('#email_exist_msg').text("");
                   $('#submit_btn').removeAttr('disabled','disabled');
               }
           },

       });
   });
</script>
@endpush


