@push('css')
<style>
    .page-wrapper input[value=Cancel]:is(.btn) { border: 0; color: #4A4A4A; box-shadow: none; padding: 15px 30px; border-radius: 10px; background: #E1E1E1; }
</style>
@endpush

<div class="row">
    <input type="hidden" name="role_id" value="43">
    <div class="col-md-12">
        <h5>Company Details</h5>
        <div class="form-group">
            <label for="company_name" class="col-md-4 control-label">Company Name *</label>
            <input class="form-control" placeholder="Enter Company Name" name="company_name" type="text" id="company_name" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="address" class="col-md-4 control-label">Address</label>
            <input class="form-control" placeholder="Enter Address" name="company_address" type="text" id="address">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="city" class="col-md-4 control-label">City</label>
            <input class="form-control" placeholder="Enter City" name="company_city" type="text" id="city">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="state" class="col-md-4 control-label">State</label>
            <input class="form-control" placeholder="Enter State" name="company_state" type="text" id="state">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="zipCode" class="col-md-4 control-label">Zip Code</label>
            <input class="form-control" placeholder="Enter Zip Code" name="company_zip_code" type="text" id="zipCode">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="phone" class="col-md-4 control-label">Phone *</label>
            <input class="form-control phone" name="company_phone" placeholder="( ___ ) ___-____ " type="tel" id="phone" maxlength="12" pattern="[0-9]+">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="col-md-4 control-label">Email *</label>
            <input class="form-control" placeholder="Enter your email" name="company_email" type="email" id="email">
            <span style="color: red" id="email_exist_msg"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="corporation" class="col-md-4 control-label">Corporation</label>
            <input class="form-control" placeholder="Enter Corporation" name="corporation" type="text" id="corporation">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="trades" class="col-md-4 control-label">Trades</label>
            <select class="form-control select2" name="trades[]" multiple="multiple">
                @foreach($trades as $trade)
                    <option value="{{$trade->id}}">{{$trade->name??''}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="website" class="col-md-4 control-label">Website</label>
            <input class="form-control" placeholder="Enter Website" name="company_website" type="text" id="website">
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <h5>Contact Details</h5>
        <div class="form-group">
            <label for="title" class="col-md-4 control-label">Title</label>
            <input class="form-control" placeholder="Enter Title" name="title" type="text" id="title">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name" class="col-md-4 control-label">First Name</label>
            <input class="form-control" placeholder="Enter First Name" name="first_name" type="text" id="first_name">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="last_name" class="col-md-4 control-label">Last Name</label>
            <input class="form-control" placeholder="Enter Last Name" name="last_name" type="text" id="last_name">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="col-md-4 control-label">Email</label>
            <input class="form-control" placeholder="Enter your email" name="email" type="email" id="email">
            <span style="color: red" id="email_exist_msg"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="phone" class="col-md-4 control-label">Phone</label>
            <input class="form-control phone" name="phone" placeholder="( ___ ) ___-____ " type="tel" id="phone" maxlength="12" pattern="[0-9]+">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="notes" class="col-md-4 control-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" placeholder="Enter Notes">  </textarea>
        </div>
    </div>


    <div class="col-md-12">
        <div class="gap-2 d-flex align-items-center">
            <div class="form-group mb-0">
                <input class="btn btn-primary" id="submit_btn" type="submit" value="Add">
                <span class="form_error"></span>
            </div>
            <div class="form-group mb-0">
                <input class="btn btn-secondary" id="cancel_btn" type="button" value="Cancel">
                <span class="form_error"></span>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('googleAPI')}}&libraries=places"></script>

    <script>
        $(document).ready(function() {
            var autocomplete = new google.maps.places.Autocomplete(
                $('#address')[0],
                {types: ['geocode']}
            );

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) return;

                $.each(place.address_components, function(i, component) {
                    if (component.types.includes('locality')) {
                        $('#city').val(component.long_name);
                    }
                    if (component.types.includes('administrative_area_level_1')) {
                        $('#state').val(component.short_name);
                    }
                    if (component.types.includes('postal_code')) {
                        $('#zipCode').val(component.long_name);
                    }
                });
            });
        });
    </script>
@endpush
