@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush

@section('content')
<section class="change_password_section pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                    <div class="card-headerr">
                        <h5>Change Password</h5>
                        <i class="fa fa-info-circle"></i>
                    </div>
                    <hr class="">
                    <div class="card-body">
                        <p>Enter your detail below here</p>
                        <div class="row">
                            <div class="col-md-4">
                            <div class="passowrd_fields">
                                <form action="{{route('change_user_password')}}" method="post" enctype="multipart/form-data" id="account_detail">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="currentPassword" class="form-label input_labels p-18">Current Password</label>
                                        <input type="password" name="password" class="form-control input_fields borderRadius" id="currentpassword" aria-describedby="emailHelp">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class=" mb-3">
                                        <label for="newPassword" class="form-label input_labels p-18">New Password</label>
                                         <div class="input_group_box">
                                            {{--<input type="password" class="form-control input_fields borderRadius" name="new_password" id="newpassword">--}}
                                             <input type="password" name="new_password" class="form-control input_fields borderRadius" id="newpassword" aria-describedby="emailHelp">
                                            <div class="input_icon">
                                                <a href="javascript:void(0);" class="password_btn2"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="mb-5">
                                        <label for="confirmPassword" class="form-label input_labels p-18">Confirm Password</label>
                                        <div class="input_group_box">
                                        {{--<input type="password" class="form-control input_fields borderRadius" name="confirm_password" id="confirmPassword">--}}
                                            <input type="password" name="password_confirmation" class="form-control input_fields borderRadius" id="password_confirmation" aria-describedby="emailHelp">
                                            <div class="input_icon">
                                            <a href="javascript:void(0);" class="password_btn3"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        </div>
                                        {{--<span id="error" class="hidden">Password Not Matched*</span>--}}
                                    </div>
                                    <div class="mb-3">
                                    <button type="submit" class="btn green_btn borderRadius w-100 submit_btn border-0">Change Password</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<script type="text/javascript">

    jQuery('#account_detail').validate({
        rules: {
            password:{
                required: true,
                remote: {
                    type: 'post',
                    url: "{{route('check_password')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",'password': function () { return $('#currentpassword').val(); }
                    },
                    dataType: 'json'
                }
            },
            new_password: {
                required: true,
                minlength: 8,
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#newpassword",
            },
        },
        messages: {
            password: "Password must be at least 8 characters.",
            password_confirmation: "Confirm password is incorrect.",
            password: {
                required: "Please enter your current password.",
                remote: "Current Password is Invalid"
            }
        },
        submitHandler: function (form) {
            return true;
        }
    });
    $(function(){
        $('.password_btn2').click(function(){
            if($('.password_btn2 i').hasClass('fa-eye-slash')){
                $('.password_btn2 i').removeClass('fa-eye-slash');
                $('.password_btn2 i').addClass('fa-eye');
                $('#newpassword').attr('type','text');
            }else{
                $('.password_btn2 i').removeClass('fa-eye');
                $('.password_btn2 i').addClass('fa-eye-slash');
                $('#newpassword').attr('type','password');
            }
        });
    });
    $(function(){
        $('.password_btn3').click(function(){
            if($('.password_btn3 i').hasClass('fa-eye-slash')){
                $('.password_btn3 i').removeClass('fa-eye-slash');
                $('.password_btn3 i').addClass('fa-eye');
                $('#password_confirmation').attr('type','text');
            }else{
                $('.password_btn3 i').removeClass('fa-eye');
                $('.password_btn3 i').addClass('fa-eye-slash');
                $('#password_confirmation').attr('type','password');
            }
        });
    });
</script>
@endpush
{{--@endpush--}}
