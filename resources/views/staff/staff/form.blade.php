
<div class="row">
    <div class="col-md-12">
        <h5>General Information</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'First Name' }} *</label>
            <input class="form-control" placeholder="Enter your first name" name="first_name" type="text" id="name" value="{{ $staff->first_name??''}}" required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Last Name' }} *</label>
            <input class="form-control" placeholder="Enter your last name" name="last_name" type="text" id="last_name" value="{{ $staff->last_name??''}}" required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            <label for="email" class="control-label">{{ 'Email' }} *</label>
            <input class="form-control" placeholder="Enter your email" name="email" type="email" id="email" value="{{ $staff->email??''}}" required>
            <span style="color: red" id="email_exist_msg"></span>
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
            <label for="phone" class="control-label">{{ 'Phone' }} *</label>
            <input class="form-control phone" name="phone" placeholder="( ___ ) ___-____ " type="tel" id="phone" value="{{ $staff->profile->phone??''}}" maxlength="12" pattern="[0-9]+">
            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ 'Address' }}</label>
            <input class="form-control" name="address" type="text" id="address" value="{{ $staff->profile->address??''}}" >
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('colour_id') ? 'has-error' : ''}}">
            <label for="colour_id" class=" control-label">{{ 'Colour' }}</label>
            <input class="form-control" name="colour_id" id="colour_id" type="color" value="{{$stage->colour_id??''}}" placeholder="Enter Name">
            {!! $errors->first('colour_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class="control-label">{{ 'Status' }}</label>
            <select class="form-control" name="status">
                <option value="1" @if(isset($staff) && $staff->status=='1') selected @endif>Active</option>
                <option value="0" @if(isset($staff) && $staff->status=='0') selected @endif>Inactive</option>
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @if(request()->is('staff/staff/' . ($staff->id ?? 0) . '/edit'))
        <div class="col-md-6">
            <label for="status" class="control-label">Reset Password</label>
            <button class="btn btn-primary" type="button" id="reset_password_btn">Reset Password</button>
        </div>
    @endif


    <div class="col-md-12">
        <h5>Finances</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group select_finance_dropdown {{ $errors->has('position') ? 'has-error' : ''}}">
            <label for="" class="control-label">Position <span class="text-danger">*</span></label>
            <select class="form-control select2" data-placeholder="Select Position" name="position" id="position">
                @if(request()->is('staff/staff/create'));
                <option value=""></option>
                @endif
                @foreach($positionBlocks as $position)
                <option value="{{$position->id}}" @if(isset($staff->staffPosition) && $staff->staffPosition->staff_position == $position->id) @endif>{{$position->name}}</option>
                @endforeach
            </select>
            {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('compensation') ? 'has-error' : ''}}">
            <label for="status" class="control-label ">Compensation Type <span class="text-danger">*</span></label>
            <select class="form-control select2" data-placeholder="Select Compensation Type" name="compensation" id="compensation">
                <option ></option>
                <option value="hourly" @if(isset($staff->staffPosition) && $staff->staffPosition->staff_compensation == 'hourly') selected @endif>Hourly</option>
                <option value="salary" @if(isset($staff->staffPosition) && $staff->staffPosition->staff_compensation == 'salary') selected @endif>Salary</option>
                <option value="commission" @if(isset($staff->staffPosition) && $staff->staffPosition->staff_compensation == 'commission') selected @endif>Commission</option>
                <option value="base_commission" @if(isset($staff->staffPosition) && $staff->staffPosition->staff_compensation == 'base_comission') selected @endif>Base + Commission</option>
            </select>
            {!! $errors->first('compensation', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div id="position_div"></div>
        <div id="compensation_div"></div>
    </div>

    <div class="col-md-12">
        <h5>Permissions</h5>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
            <label for="status" class="control-label">{{ 'Select Role' }} *</label>
{{--            <input type="checkbox" name="role_id" id="role_id_checkbox" value="2"> Is Admin--}}
            <select class="form-control role_id select2" data-placeholder="Select Role" name="role_id" id="role_id">
                <option value="" selected disabled>Select Role</option>  <!-- Empty option -->
                @if(request()->is('staff/staff/create'))
                    @foreach($roles as $role)
                        <option value="{{$role->id}}"
                        @if(isset($role->name) && $role->name == 'staff')
                                @endif>
                            @if(isset($role->name) && $role->name == 'user')
                                Admin
                            @else
                                {{$role->name}}
                            @endif
                        </option>
                    @endforeach
                    <option value="custom_role">Other</option>
                @else
                    @foreach($roles as $role)
                        @if(isset($staff) && !$staff->roles->contains('id', $role->id)) @continue @endif
                        <option value="{{$role->id}}" @if(isset($staff) && $staff->roles->contains('id', $role->id)) selected @endif>{{$role->name}}</option>
                    @endforeach
                    <option value="custom_role">Other</option>
                @endif
            </select>

            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <span style="color: red" id="role_exist_msg"></span>
    <div id="permissions_detail_div">
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input class="btn btn-primary permission_submit_btn" id="submit_btn" type="submit" value="{{ $submitButtonText ?? 'Create' }}" >
            <span class="form_error"></span>
        </div>
    </div>
</div>
@push('js')
    {{--<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCx6i3_HuvU0VjZjNHdLQ5XVXf4fTgALJY"></script>--}}
    <script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{env('googleAPI')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>

        @php
            $id = $staff->id ?? 0;
        @endphp
        var id = {{ $id }};
        var staff_role = $('.role_id').val();
        @if(request()->is('staff/staff/' . $id . '/edit'))
        getRolePermissions(staff_role);
        @else
        getRolePermissions(3);
        @endif

        function getRolePermissions($role_id){
            var role  = $role_id;
            $.ajax({
                type: "GET",
                url: "{{url('get_role_details_staff')}}/"+role,
                success: function(data){
                    $('#permissions_detail_div').html(data)
                },
                error:function(e){

                }
            })
        }

        $(document).on('change','#role_id',function (e) {
            e.preventDefault();
            getRolePermissions($(this).val());
        });
        $(document).ready(function () {
            $(document).on('click','input[data-permiss^="permiss_add"]',function () {
                var isChecked = $(this).is(':checked');
                var permissionName = $(this).attr('data-permiss').replace('permiss_add', 'permiss_view');
                if (permissionName) {
                    $('input[data-permiss="'+ permissionName + '"]').prop('checked', isChecked);
                }
            });
            $(document).on('click','input[data-permiss^="permiss_edit"]',function () {
                var isChecked = $(this).is(':checked');
                var permissionName = $(this).attr('data-permiss').replace('permiss_edit', 'permiss_view');
                if (permissionName) {
                    $('input[data-permiss="'+ permissionName + '"]').prop('checked', isChecked);
                }
            });
        });

        @if(request()->is('staff/staff/create'))
        $(document).on('keyup paste',"#email",function(){
            var email = $(this).val();
            $.ajax({
                url                             : "{{ route('check_email') }}",
                method                          : "POST",
                data                            : {
                    '_token': '{{ csrf_token() }}',
                    email          :email,
                },
                success: function( data ) {

                    if(data=='yes'){
                        $('#email_exist_msg').text("This email is already registered");
                        $('input[type="submit"]').attr('disabled','disabled');
                        $('.form_error').text('Please Change Email! This Email has Taken').css('color','red');
                        event.preventDefault();
                    }else{
                        $('#email_exist_msg').text("");
                        $('input[type="submit"]').removeAttr('disabled','disabled');
                    }
                },
            });
        });
        @endif
        $(document).on('keyup paste',"#status",function(){
            var roleName = $(this).val();
            $.ajax({
                url                             : "{{ route('check_role') }}",
                method                          : "POST",
                data                            : {
                    '_token': '{{ csrf_token() }}',
                    roleName          :roleName,
                },
                success: function( data ) {
                    if(data=='yes'){
                        $('#role_exist_msg').text("This Role is already registered");
                        $('input[type="submit"]').attr('disabled','disabled');
                        $('.form_error').text('Please Change Role! This Role has Taken').css('color','red');
                        event.preventDefault();
                    }else{
                        $('#role_exist_msg').text("");
                        $('.form_error').text("");
                        $('input[type="submit"]').removeAttr('disabled','disabled');
                    }
                },

            });
        });
        document.getElementById('address').addEventListener('keydown', function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent form submission when Enter key is pressed
            }
        });
        google.maps.event.addDomListener(window, 'load', function () {
            event.preventDefault();
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
                event.preventDefault();
            });
        });
        $(document).ready(function() {
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
                $('#staff-form').validate({
                    rules: {
                        first_name: {
                            required: true,
                            noSpace: true
                        },
                        last_name: {
                            required: true,
                            noSpace: true
                        },
                        email: {
                            required: true,
                            noSpace: true
                        },
                        phone: {
                            required: true,
                            minlength: 14,
                            maxlength: 14
                        },
                        address: {
                            required: true,
                            noSpace: true
                        },

                        position: {
                            required: true,
                        },

                        compensation: {
                            required:   true,
                        }


                    },
                    messages: {
                        first_name: {
                            required: "Please enter First Name.",
                            noSpace: "Spaces are not allowed."
                        },
                        last_name: {
                            required: "Please enter Last Name.",
                            noSpace: "Spaces are not allowed."
                        },
                        email: {
                            required: "Please enter Email.",
                            noSpace: "Spaces are not allowed."
                        },
                        phone: {
                            required: 'Please enter Phone number.',
                            minlength: 'Invalid phone number. Enter at least 10 digits.',
                            maxlength: 'Invalid phone number. Enter at most 10 digits.'
                        },
                        address: {
                            required: "Please enter Address.",
                            noSpace: "Spaces are not allowed."
                        },

                        position: {
                            required: "Please select position.",
                            noSpace: "Spaces are not allowed."
                        },
                        compensation: {
                            required: "Please select compensation.",
                            noSpace: "Spaces are not allowed."
                        }

                    },
                    submitHandler: function (form) {
                    if ($("input[name='permissions[]']:checked").length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Please select at least one permission!',
                        });
                        $('#submit_btn').prop('disabled', false);
                        return false; // Prevent form submission
                    } else {
                        form.submit();
                    }
                }
                });

        });

        $(document).ready(function () {
            $('.phone').mask('(000) 000-0000'); // Use zeros to represent digit placeholders
        });
    </script>

    <script>
        $(document).ready(function() {
            function fetchPositionData(position = null) {
                var positionValue = position || $('#position').val();
                var staffId = {{ $id??"" }};
                $.ajax({
                    url: "{{ url('get_position_record') }}" ,
                    method: "GET",
                    method: "GET",
                    data: {
                        position: positionValue,
                        id: staffId,
                    },
                    success: function(response) {
                        $('#position_div').html(response);
                    }
                });
            }
            function fetchCompensationData(compensation = null) {
                var compensationValue = compensation || $('#compensation').val();
                var staffId = {{ $id??"" }};
                $.ajax({
                    url: "{{ url('get_compensation_record') }}",
                    method: "GET",
                    data: {
                        compensation: compensationValue,
                        id: staffId,
                    },
                    success: function(response) {
                        $('#compensation_div').html(response);
                    }
                });
            }
            $(document).on('change', '#position', function() {
                fetchPositionData($(this).val());  // Pass selected position value to fetchPositionData
            });

            $(document).on('change', '#compensation', function() {
                fetchCompensationData();
            });



            var initialPosition = $('#position').val();
            var initialCompensation = $('#compensation').val();
            if (initialPosition) {
                fetchPositionData(initialPosition);
            }
            if (initialCompensation) {
                fetchCompensationData(initialCompensation);
            }
        });
    </script>
    <script>
            $(document).ready(function() {
                $('#role_id_checkbox').change(function() {
                    var roleDropdown = $('#role_id');

                    if ($(this).prop('checked')) {
                        // If checkbox is checked, set the dropdown value to 2
                        roleDropdown.val('2');
                        // Disable the dropdown to prevent further selection
                        roleDropdown.prop('disabled', true);
                    } else {
                        // If checkbox is unchecked, enable the dropdown and allow selection
                        roleDropdown.prop('disabled', false);
                    }
                });
            });
            // select 2 initialize

    </script>

    <script>
        $(document).ready(function() {
            $staffId = {{ isset($staff) ? $staff->id : '' }};
        });
    $('#reset_password_btn').click(function() {
        Swal.fire({
            title: 'Reset Password',
            text: 'Are you sure you want to reset password?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reset it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{url("staff_password_reset")}}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: $staffId
                    },
                    success: function(response) {
                        Swal.fire(
                            'Reset!',
                            'Password reset instructions have been sent.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Failed to reset password. Please try again.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
    </script>
@endpush
