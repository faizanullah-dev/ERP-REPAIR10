<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }} *</label>
    <div class="col-md-6">
        <input class="form-control" placeholder="Enter name" name="name" type="text" id="name" value="{{ $salesman->name??''}}" required >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }} *</label>
    <div class="col-md-6">
        <input class="form-control" placeholder="Enter email" name="email" type="text" id="email" value="{{ $salesman->email??''}}" required >
        <span style="color: red" id="email_exist_msg"></span>
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="col-md-4 control-label">{{ 'Phone' }}</label>
    <div class="col-md-6">
        <input class="form-control phone" name="phone" type="text" id="phone" placeholder="( ___ ) ___-____ " value="{{ $salesman->profile->phone??''}}" >
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="col-md-4 control-label">{{ 'Address' }}</label>
    <div class="col-md-6">
        <input class="form-control" placeholder="Enter address" name="address" type="text" id="address" value="{{ $salesman->profile->address??''}}" >
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        {{--<input class="form-control" name="status" type="text" id="status" value="{{ $salesman->status??''}}" >--}}
        <select class="form-control" name="status">
            <option value="1" @if(isset($salesman) && $salesman->status=='1') selected @endif>Active</option>
            <option value="0" @if(isset($salesman) && $salesman->status=='0') selected @endif>Inactive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Select Role' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="role_id" id="role_id">
            @foreach($roles as $role)
                <option value="{{$role->id}}" @if(isset($salesman) && $role->name== $salesman->roles->first()->name )  selected @endif >{{$role->name}}</option>
            @endforeach
            <option value="custom_role">Other</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="permissions_detail_div">
    <div class="form-group">
        <label for="status" class="col-md-4 control-label">{{ 'Permissions' }}</label>
        <div class="mb-3 checkbox_btn_box col-md-12">
            @foreach($roles as $role)
                @forelse($role->permissions as $key=>$permission)
                    <div class="single_checkbox_btn borderRadius">
                        <input type="checkbox" class="form-check-input" name="staff_permissions[]" id="staff_permissions{{$key}}" disabled checked required>
                        <div class="green_circle"></div>
                        <label for="staff_permissions{{$key}}" class="form-label input_labels p-18">{{ucwords(str_replace('-',' ',$permission->name)) }}</label>
                    </div>
                @empty
                    <div class="col-md-6">
                        <input class="form-control"  type="text" value="Not Available" disabled >
                    </div>
                @endforelse
                @break
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}" disabled>
    </div>
</div>

@push('js')
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAM52bC4tsQFv_3IPHLJ7kyrMx1Ys_teaU"></script>
<script>
    $(document).on('change','#role_id',function (e) {
        e.preventDefault();
        var role  = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{url('get_role_details_sales_man')}}/"+role,
            success: function(data){
                $('#permissions_detail_div').html(data)
                console.log(data);
            },
            error:function(e){
                console.log(e.status);
            }
        })
    });
    $(document).ready(function () {

        $(document).on('click','.form-check-input',function(){
            checked = $("input[type=checkbox]:checked").length;
            console.log(checked)
            if(checked==0) {
                $('.form-check-input').prop('required',true);
            }else{
                $('.form-check-input').prop('required',false);
            }

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
                    $('input[type="submit"]').attr('disabled','disabled');
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
                    $('input[type="submit"]').removeAttr('disabled','disabled');
                }
            },

        });
    });
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
</script>
@endpush
