<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <h5>Job Information</h5>
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group job-image-upload">
                            <label class="form-label input_labels p-18">Job Image <span class="text-danger">*</span></label>
                            <div class="job-image-preview-box">
                                <img class="job-image-preview rounded-circle" src="{{ asset('website/images/upload_avatar.svg') }}" alt="Job Image Preview">
                                <label for="job-image-input" class="btn btn-sm btn-outline-secondary rounded-circle job-image-pencil">
                                    <i class="fas fa-pencil-alt"></i>
                                </label>
                            </div>
                            <label class="error job-image-error"></label>
                            <input class="form-control job-image-input" id="job-image-input" name="lead_icon" type="file" accept="image/jpeg,image/png,image/webp" style="display: none;">
                        </div>
                    </div>
                   <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label input_labels p-18">Customer <span class="text-danger">*</span></label>
                            <select class="form-control  borderRadius select2 " data-placeholder="Select Customer" id="customer_id" name="customer_id" required>
                                <option value=""></option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        @if ((isset($lead) && $lead->customer_id == $customer->id) || (!empty($preselectedCustomerId) && $preselectedCustomerId == $customer->id)) selected @endif>
                                        {{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Job Name <span class="text-danger">*</span></label>
                            <input class="form-control clr_input_fields borderRadius" name="title" type="text" id="title" placeholder="Enter Job Name" value="{{ $lead->title??''}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Job Rep/Sales Rep<span class="text-danger">*</span></label>
                            <select class="form-control select2 borderRadius " data-placeholder="Select Representative" id="representative_id" name="representative_id" required>
                                <option value=""></option>
                                @foreach ($roles as $role)
                                    @if ($role->name !== 'admin' && $role->name !== 'customer')
                                        <optgroup label="{{ $role->name }}">
                                            @foreach ($role->users as $user)
                                                <option value="{{ $user->id }}" @if(isset($team) && in_array($user->id, $team->getUserTeam->pluck('user_id')->toArray())) @endif>
                                                    {{ $user->name ?? "" }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Category <span class="text-danger">*</span></label>
                            <select class="form-control select2 borderRadius " data-placeholder="Select Category" id="category_id" name="category_id" required>
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(isset($lead) && $lead->category_id == $category->id) @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Lead #</label>
                            <input class="form-control clr_input_fields borderRadius" name="lead_number" placeholder="Enter Lead" type="text" id="lead_number" value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="contact-person" class="form-label input_labels p-18">Contact Person <span class="text-danger"></span></label>
                            <input class="form-control clr_input_fields borderRadius" name="contact_person" placeholder="Contact" type="text" id="contact_person" value="{{ $lead->contact_person??''}}" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="mb-3">--}}
                    {{--                            <label for="customer-name" class="form-label input_labels p-18">Project Price*</label>--}}
                    {{--                            <input class="form-control clr_input_fields borderRadius" name="lead_price" placeholder="Enter Price" type="text" id="lead_price" pattern="\d*" required>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Lead Date <span class="text-danger">*</span></label>
                            {{--                            <input class="form-control clr_input_fields borderRadius" name="lead_date" placeholder="Enter Price" type="date" id="lead_date" value="{{ $lead->lead_date??''}}" required>--}}
                            <input class="form-control clr_input_fields borderRadius" name="lead_date" placeholder="Enter Price" type="date" id="lead_date" value="{{ $lead->lead_date ?? date('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>
                {{--                <div class="row">--}}
                {{--                    <div class="col-md-4">--}}
                {{--                        <div class="mb-3">--}}
                {{--                            <label class="form-label input_labels p-18">Select Percentage / Flat *</label>--}}
                {{--                            <select  name="percentage_or_flat" class="form-control" id="percentage_or_flat" required>--}}
                {{--                                <option value=""> Select Values </option>--}}
                {{--                                <option value="percentage">Percentage</option>--}}
                {{--                                <option value="flat">Flat</option>--}}
                {{--                            </select>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md-4">--}}
                {{--                        <div class="mb-3">--}}
                {{--                            <label for="customer-name" class="form-label input_labels p-18">Enter Percentage / Flat *</label>--}}
                {{--                            <input class="form-control clr_input_fields borderRadius" name="percentage_flat_value" placeholder="Enter Percentage / Flat" type="number" id="percentage_flat_value" value="" required>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md-4">--}}
                {{--                        <div class="mb-3">--}}
                {{--                            <label for="customer-name" class="form-label input_labels p-18">Sales Commission *</label>--}}
                {{--                            <input class="form-control clr_input_fields borderRadius" name="sales_commission" placeholder="Commission" type="number" id="sales_commission" value="" required readonly>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="row">
                     <div class="col-md-12">
                        <div class="mb-3">
                            <label for="job-address" class="form-label input_labels p-18">Job Address <span class="text-danger">*</span></label>
                            <textarea class="form-control clr_textarea_fields borderRadius" row="2" name="address" type="text" id="address" required>{{ $lead->address ?? '' }}</textarea>
                            <input type="hidden" name="latitude" value="{{ old('latitude', $lead->customer->latitude ?? '') }}" class="form-control clr_input_fields borderRadius" id="latitude">
                            <input type="hidden" name="longitude" value="{{ old('longitude', $lead->customer->longitude ?? '') }}" class="form-control clr_input_fields borderRadius" id="longitude">
                            <input type="hidden" name="city" value="{{ old('city', $lead->customer->city ?? '') }}" id="city">
                            <input type="hidden" name="state" value="{{ old('state', $lead->customer->state ?? '') }}" id="state">
                            <input type="hidden" name="postal_code" value="{{ old('postal_code', $lead->customer->postal_code ?? '') }}" id="postal_code">
                            <input type="hidden" name="country" value="{{ old('country', $lead->customer->country ?? '') }}" id="country">
                        </div>
                    </div>
                    <div class=" col-md-4">
                        <div class="form-group">
                            <a class="btn green_btn Job_Insurance_offcanvasgreen_btn  borderRadius" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Job Insurance</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <div class="row top">
                    <div class="col-md-12">
                        <div class="mb-3 error_positioned_parent">
                            <label for="description" class="form-label input_labels p-18">Job Description <span class="text-danger"></span></label>
                            <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ $lead->description??'' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="call-center" class="form-label input_labels p-18">Minimum Days</label>
                        <input  min="0" oninput="this.value = Math.abs(this.value)" class="form-control borderRadius clr_input_fields" name="minimum_days" type="number" id="duration_days" value="{{ $lead->minimum_days??''}}" >
                    </div>
                    <div class="col-md-6">
                        <label for="call-center" class="form-label input_labels p-18">Maximum Days</label>
                        <input  min="0" oninput="this.value = Math.abs(this.value)" class="form-control borderRadius clr_input_fields" name="maximum_days" type="number" id="duration_hours" value="{{ $lead->maximum_days??''}}" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 mt-3">
                            <textarea class="form-control borderRadius clr_textarea_fields" rows="3" placeholder="Other Information" name="other_information" type="textarea" id="other_information" >{{ $lead->other_information??''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas Job_Insurance_offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Job Insurance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="insuranceCompany" class="form-label input_labels p-18">Insurance company</label>
                            <select class="form-control  select2  borderRadius" data-placeholder="Select Insurance Company" name="company_id" id="insuranceCompany">
                                <option value=""></option>
                                @foreach($companies as $key => $company)
                                    <option value="{{ $company->id}}" @if(isset($lead) && $lead->company_id==$company->id) selected @endif required>{{ $company->company??''}}</option>
                                @endforeach
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="Claim" class="form-label input_labels p-18">Claim# </label>
                            <input class="form-control clr_input_fields borderRadius" name="claim_number" placeholder="Enter Claim#" type="text" id="" value="{{$lead->claim_number??''}}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="Policy" class="form-label input_labels p-18">Policy# </label>
                            <input class="form-control clr_input_fields borderRadius" name="policy_number" placeholder="Enter Policy # " type="text" id="Policy" value="{{$lead->policy_number??''}}" >
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="Phone" class="form-label input_labels p-18">Phone # </label>
                            <input class="form-control clr_input_fields borderRadius" name="phone_insurance" placeholder="(__)__-__" type="tel" id="phone_insurance" value="{{$lead->phone_insurance??''}}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="Fax" class="form-label input_labels p-18">Fax </label>
                            <input class="form-control clr_input_fields borderRadius" name="fax_number" placeholder="(__)__-__" type="text" id="Fax" value="{{$lead->fax_number??''}}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="Email" class="form-label input_labels p-18">Email </label>
                            <input class="form-control clr_input_fields borderRadius" name="email_insurance" placeholder="" type="email" id="Email" value="{{$lead->email_insurance??''}}" >
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="adjustName" class="form-label input_labels p-18">Adjust Name </label>
                            <input class="form-control clr_input_fields borderRadius" name="adjust_name_insurance" placeholder="Adjust Name" type="text" id="adjustName" value="{{$lead->adjust_name_insurance??''}}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="adjustPhone" class="form-label input_labels p-18">Adjust Phone </label>
                            <input class="form-control clr_input_fields borderRadius" name="adjust_Phone_insurance" placeholder="(__)__-__" type="tel" id="adjustPhone" value="{{$lead->adjust_Phone_insurance??''}}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="adjustEmail" class="form-label input_labels p-18">Adjust Email </label>
                            <input class="form-control clr_input_fields borderRadius" name="adjust_email_insurance" placeholder="Adjust Email" type="email" id="adjustEmail" value="{{$lead->adjust_email_insurance??''}}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="contractSignedDate" class="form-label input_labels p-18">Contingency Contract Signed Date </label>
                            <input class="form-control clr_input_fields borderRadius" name="contract_signed_date" placeholder="Select Date" type="date" id="contractSignedDate" value="{{$lead->contract_signed_date??''}}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="dateLoss" class="form-label input_labels p-18">Date of Loss </label>
                            <input class="form-control clr_input_fields borderRadius" name="date_loss_insurance" placeholder="Select Date" type="date" id="dateLoss" value="{{$lead->date_loss_insurance??''}}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="claimFilledDate" class="form-label input_labels p-18">Claim Filled Date </label>
                            <input class="form-control clr_input_fields borderRadius" name="claim_filled_date" placeholder="Select Date" type="date" id="claimFilledDate" value="{{ $lead->claim_filled_date??'' }}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class=" mb-3 d-flex justify-content-end">
                            <button type="button" class="btn secondary_btn" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group create_btn_lead">
                <input class="btn btn-primary" id="submitButton" type="submit" value="{{ $submitButtonText??'Create' }}">
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{ env('googleAPI') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {






            $('#insuranceCompany').change(function() {
                var companyId = $(this).val();

                // AJAX request
                $.ajax({
                    url: "{{ url('get_company_detail') }}", // Replace with your endpoint URL
                    method: 'GET',
                    data: {
                        companyId: companyId,
                    },
                    success: function(response) {
                        $('#phone_insurance').val(response.phone ?? '')
                        $('#Email').val(response.email ?? '')
                        $('#contractSignedDate').val(response.insurance_start ?? '')
                        $('#dateLoss').val(response.insurance_expire ?? '')


                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        // google.maps.event.addDomListener(window, 'load', function () {
        //     var places = new google.maps.places.Autocomplete(document.getElementById('address'));
        //     google.maps.event.addListener(places, 'place_changed', function () {
        //         var place = places.getPlace();
        //         var latitude = place.geometry.location.lat();
        //         var longitude = place.geometry.location.lng();
        //
        //         // Assuming jQuery is used. For vanilla JS, use document.getElementById('latitude').value = latitude, etc.
        //         $('#latitude').val(latitude);
        //         $('#longitude').val(longitude);
        //
        //         var latlng = new google.maps.LatLng(latitude, longitude);
        //         var geocoder = new google.maps.Geocoder();
        //         geocoder.geocode({ 'latLng': latlng }, function (results, status) {
        //             if (status == google.maps.GeocoderStatus.OK) {
        //                 if (results[0]) {
        //                     var addressComponents = results[0].address_components;
        //                     var pin = addressComponents.find(component => component.types.includes('postal_code')).long_name;
        //                     var country = addressComponents.find(component => component.types.includes('country')).short_name; // Changed to short_name
        //                     var state = addressComponents.find(component => component.types.includes('administrative_area_level_1')).long_name;
        //                     var city = addressComponents.find(component => component.types.includes('locality')).long_name;
        //
        //                     $('#postal_code').val(pin);
        //                     $('#state').val(state);
        //                     $('#city').val(city);
        //                     $('#country').val(country); // This will now set a 2-letter country code
        //                 }
        //             } else {
        //                 console.error('Geocoder failed due to: ' + status);
        //                 // Handle the error appropriately in your application
        //             }
        //         });
        //     });
        // });

        // Function to geocode and update city, state, postal code, country
        // Initialize the Google Places Autocomplete and Geocoding
        function initializeAutocomplete() {
            var places = new google.maps.places.Autocomplete(document.getElementById('address'));

            // Listen for when a place is selected
            google.maps.event.addListener(places, 'place_changed', function() {
                var place = places.getPlace();
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();

                // Update the latitude and longitude fields
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);

                var latlng = new google.maps.LatLng(latitude, longitude);
                var geocoder = new google.maps.Geocoder();

                // Perform geocoding to get detailed address components
                geocoder.geocode({
                    'latLng': latlng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var addressComponents = results[0].address_components;
                            var pin = addressComponents.find(component => component.types.includes(
                                'postal_code'))?.long_name || '';
                            var country = addressComponents.find(component => component.types.includes(
                                'country'))?.short_name || '';
                            var state = addressComponents.find(component => component.types.includes(
                                'administrative_area_level_1'))?.long_name || '';
                            var city = addressComponents.find(component => component.types.includes(
                                'locality'))?.long_name || '';

                            // Update the form fields with geocoded data
                            $('#postal_code').val(pin);
                            $('#state').val(state);
                            $('#city').val(city);
                            $('#country').val(country);
                        }
                    } else {
                        console.error('Geocoder failed due to: ' + status);
                        // Handle the error appropriately in your application
                    }
                });
            });
        }

        // Initialize the Autocomplete functionality when the window loads
        google.maps.event.addDomListener(window, 'load', function() {
            initializeAutocomplete();
        });

        // Trigger geocoding when the user changes the address manually
        $('#address').on('change', function() {
            var address = $(this).val();
            if (address) {
                var geocoder = new google.maps.Geocoder();

                // Geocode the manually entered address
                geocoder.geocode({
                    'address': address
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var addressComponents = results[0].address_components;
                            var pin = addressComponents.find(component => component.types.includes(
                                'postal_code'))?.long_name || '';
                            var country = addressComponents.find(component => component.types.includes(
                                'country'))?.short_name || '';
                            var state = addressComponents.find(component => component.types.includes(
                                'administrative_area_level_1'))?.long_name || '';
                            var city = addressComponents.find(component => component.types.includes(
                                'locality'))?.long_name || '';

                            // Update the form fields with geocoded data
                            $('#postal_code').val(pin);
                            $('#state').val(state);
                            $('#city').val(city);
                            $('#country').val(country);
                        }
                    } else {
                        console.error('Geocoder failed due to: ' + status);
                        // Handle the error appropriately in your application
                    }
                });
            }
        });




        {{-- $('#customer_id').on('change', function () { --}}
        {{--    var customer_id = $(this).val(); --}}
        {{--    $.ajax({ --}}
        {{--        url: "{{ route('get_customer_detail') }}/" + customer_id, --}}
        {{--        type: "GET", --}}
        {{--        success: function (data) { --}}
        {{--            $('#address').val(data.address); --}}
        {{--            $('#longitude').val(data.longitude); --}}
        {{--            $('#latitude').val(data.latitude); --}}
        {{--            $('#postal_code').val(data.zip); --}}
        {{--            $('#state').val(data.state); --}}
        {{--            $('#city').val(data.city); --}}
        {{--            $('#country').val(data.country); --}}
        {{--            var createdAt = new Date(data.created_at); --}}
        {{--            var yearLastTwoDigits = createdAt.getFullYear().toString().slice(-2); --}}
        {{--            var month = ('0' + (createdAt.getMonth() + 1)).slice(-2); --}}
        {{--            var day = ('0' + createdAt.getDate()).slice(-2); --}}
        {{--            var leadCount = data.lead_count; --}}
        {{--            leadCount ++; --}}
        {{--            var paddedLeadCount = leadCount.toString().padStart(3, '0'); --}}
        {{--            var newLeadNumber = yearLastTwoDigits + month + day + '-' + paddedLeadCount; --}}
        {{--            $('#lead_number').val(newLeadNumber); --}}
        {{--        } --}}
        {{--    }); --}}
        {{-- }); --}}

        // Define fetchCustomerDetails as a global function (outside document.ready)
        function fetchCustomerDetails() {
            var customer_id = $('#customer_id').val();
            var selectedYear = $('#lead_date').val() ? new Date($('#lead_date').val()).getFullYear() : null;
            if (customer_id) {
                $.ajax({
                    url: "{{ route('get_customer_detail') }}/" + customer_id,
                    type: "GET",
                    data: {
                        year: selectedYear
                    }, // Send the selected year to the server
                    success: function(data) {
                        $('#address').val(data.address);
                        $('#longitude').val(data.longitude);
                        $('#latitude').val(data.latitude);
                        $('#postal_code').val(data.zip);
                        $('#state').val(data.state);
                        $('#city').val(data.city);
                        $('#country').val(data.country);
                        // var createdAt = new Date(data.created_at);
                        // var yearLastTwoDigits = createdAt.getFullYear().toString().slice(-2);
                        // var month = ('0' + (createdAt.getMonth() + 1)).slice(-2);
                        // var day = ('0' + createdAt.getDate()).slice(-2);
                        // var leadCount = data.lead_count;
                        // leadCount++;
                        // var paddedLeadCount = leadCount.toString().padStart(3, '0');
                        // var newLeadNumber = yearLastTwoDigits + month + day + '-' + paddedLeadCount;
                        // $('#lead_number').val(newLeadNumber);

                        var leadDate = $('#lead_date').val() ? new Date($('#lead_date').val()) :
                            new Date();
                        var yearLastTwoDigits = leadDate.getFullYear().toString().slice(-2);
                        var month = ('0' + (leadDate.getMonth() + 1)).slice(-2);
                        var day = ('0' + leadDate.getDate()).slice(-2);
                        var totalLeadCount = data.total_lead_count;
                        var customerLeadCount = data.customer_lead_count;
                        var newLeadNumber = 'L' + yearLastTwoDigits + '-' + month + day + '-' +
                            totalLeadCount + '-' + customerLeadCount;
                        // $('#lead_number').val(newLeadNumber);

                        $('#lead_number').val(data.lead_number);
                    },
                    error: function() {
                        console.log('Error fetching customer details');
                    }
                });
            }
        }

        $(document).ready(function() {
            // Trigger when customer_id is changed
            $('#customer_id').on('change', function() {
                fetchCustomerDetails();
            });

            // Trigger when lead_date is changed
            $('#lead_date').on('change', function() {
                fetchCustomerDetails();
            });

        });

        // Call fetchCustomerDetails on page load if customer_id is pre-selected
        // This runs AFTER Select2 is initialized (which happens on window.load)
        $(window).on('load', function() {
            var preselectedCustomerId = '{{ $preselectedCustomerId ?? '' }}';
            console.log('=== WINDOW LOAD EVENT ===');
            console.log('Preselected Customer ID from PHP:', preselectedCustomerId);
            console.log('Current customer_id value:', $('#customer_id').val());
            console.log('Select2 instance:', $('#customer_id').data('select2'));

            if (preselectedCustomerId && preselectedCustomerId !== '') {
                console.log('Setting customer_id to:', preselectedCustomerId);

                // First, make sure the option exists
                var optionExists = $('#customer_id option[value="' + preselectedCustomerId + '"]').length > 0;
                console.log('Option exists:', optionExists);

                // Set the value and trigger change event
                $('#customer_id').val(preselectedCustomerId);

                // Trigger Select2 to update
                if ($('#customer_id').data('select2')) {
                    $('#customer_id').trigger('change.select2');
                }

                console.log('After setting - customer_id value:', $('#customer_id').val());

                // Call fetchCustomerDetails after a small delay to ensure Select2 is updated
                setTimeout(function() {
                    console.log('Calling fetchCustomerDetails...');
                    fetchCustomerDetails();
                }, 1000);
            } else {
                console.log('No preselected customer ID provided');
            }
        });


        // $(document).ready(function() {
        //     function formatCurrency(value) {
        //         value = value.replace(/,/g, '');
        //         var parts = value.split('.');
        //         parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //         return parts.join('.');
        //     }
        //
        //     $('#lead_price').on('input', function() {
        //         // Ensure that only valid numeric values are allowed
        //         var inputValue = $(this).val().replace(/[^\d.]/g, '');
        //         $(this).val(formatCurrency(inputValue));
        //     });
        //
        //     $('form').submit(function() {
        //         // Remove commas before submitting the form
        //         $('#lead_price').val($('#lead_price').val().replace(/,/g, ''));
        //     });
        // });
    </script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Spaces are not allowed.");
            let editor;
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            }
            // $.validator.addMethod("ckRequired", function(value, element) {
            //     if (editor) {
            //         var editorContent = editor.getData().trim();
            //         $(element).val(editorContent);
            //         return editorContent.length !== 0;
            //     }
            //     return false;
            // }, "Description is required.");
            $("#leadFrom").validate({
                ignore: [],
                rules: {
                    customer_id: {
                        required: true
                    },
                    title: {
                        required: true,
                        noSpace: true
                    },
                    representative_id: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                    lead_number: {
                        required: true
                    },
                    lead_date: {
                        required: true,
                        date: true
                    },
                    address: {
                        required: true,
                        noSpace: true
                    }
                },
                messages: {
                    customer_id: {
                        required: "Please select a customer"
                    },
                    title: {
                        required: "Please enter the job name",
                        noSpace: "Spaces are not allowed."
                    },
                    representative_id: {
                        required: "Please select a representative"
                    },
                    category_id: {
                        required: "Please select a category"
                    },
                    lead_number: {
                        required: "Lead number is required"
                    },
                    lead_date: {
                        required: "Please enter the lead date",
                        date: "Please enter a valid date"
                    },
                    address: {
                        required: "Please enter the job address",
                        noSpace: "Spaces are not allowed."
                    },
                },
                {{-- testing --}}
                submitHandler: function(form) {
                    const submitButton = form.querySelector('input[type=submit]') || form.querySelector(
                        'button[type=submit]');
                    if (submitButton) {
                        submitButton.disabled = true;
                        if (submitButton.tagName === 'INPUT') {
                            submitButton.value = 'Submitting...';
                        } else {
                            submitButton.innerText = 'Submitting...';
                        }
                    }
                    form.submit();
                }
                {{-- testing --}}
            });
            if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['description']) {
                CKEDITOR.instances['description'].on('change', function() {
                    $('#leadFrom').validate().element("#description");
                });
            } else {
                console.log("CKEditor instance not found for 'description' - this is OK if using ClassicEditor");
            }
        });

        $(document).ready(function() {
            $('.phone_insurance').mask('(000) 000-00000'); // Use zeros to represent digit placeholders
        });


        // $(document).ready(function() {
        //     // Define the formatCurrency function in the global scope
        //     function formatCurrency(value) {
        //         value = value.replace(/,/g, '');
        //         var parts = value.split('.');
        //         parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //         return parts.join('.');
        //     }
        //
        //     // Event listener for formatting lead price input
        //     $('#lead_price').on('input', function() {
        //         // Ensure that only valid numeric values are allowed
        //         var inputValue = $(this).val().replace(/[^\d.]/g, '');
        //         $(this).val(formatCurrency(inputValue));
        //     });
        //
        //     // Event listener for form submission to remove commas
        //     $('form').submit(function() {
        //         // Remove commas before submitting the form
        //         $('#lead_price').val($('#lead_price').val().replace(/,/g, ''));
        //     });
        //
        //     // Event listeners for commission calculation
        //     $(document).on('change', '#percentage_or_flat', function() {
        //         calculateComssion();
        //     });
        //
        //     $(document).on('input keyup', '#percentage_flat_value, #lead_price', function() {
        //         calculateComssion();
        //     });
        //
        //     // Function to calculate commission
        //     function calculateComssion() {
        //         var value = $('#percentage_or_flat').val();
        //         var leadPrice = $('#lead_price').val().replace(/,/g, '');
        //
        //         if (value == 'percentage') {
        //             var percentageValue = $('#percentage_flat_value').val();
        //             var commission = (leadPrice * percentageValue) / 100;
        //             $('#sales_commission').val(commission.toFixed(2)); // Fix to 2 decimal places
        //         } else {
        //             var flatValue = $('#percentage_flat_value').val();
        //             $('#sales_commission').val(flatValue);
        //         }
        //     }
        // });
    </script>
@endpush


