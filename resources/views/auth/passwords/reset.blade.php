@extends('layouts.app')

@section('content')

    <section id="wrapper" class="login-register">
        <div class="login-box passowrd_fields ">
            <div class="white-box">
                <form class="form-horizontal form-material" method="post" action="{{ route('password.request') }}">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>{{ __('Reset Password') }}</h3>
                        </div>
                    </div>

                    <div class="form-group ">

                        <div class="col-xs-12">
                            <input placeholder="Email" id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ $email ?: old('email') }}" required autofocus readonly>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input_group_box">
                                <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <div class="input_icon">
                                    <a href="javascript:void(0);" class="password_btn1"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input_group_box">
                                <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <div class="input_icon">
                                    <a href="javascript:void(0);" class="password_btn2"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    <span class="validation_icon" id="validation-icon" style="display: none; margin-left: 5px;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <style>
        .input_group_box {
            position: relative;
        }

        .input_icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
        }

        .validation_icon {
            font-size: 16px;
            font-weight: bold;
        }

        .validation_icon.valid {
            color: #28a745;
        }
        .passowrd_fields .input_group_box .input_icon{top: 20px ;}
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(function(){
            // Password visibility toggle for password field
            $('.password_btn1').click(function(){
                if($('.password_btn1 i').hasClass('fa-eye-slash')){
                    $('.password_btn1 i').removeClass('fa-eye-slash');
                    $('.password_btn1 i').addClass('fa-eye');
                    $('#password').attr('type','text');
                }else{
                    $('.password_btn1 i').removeClass('fa-eye');
                    $('.password_btn1 i').addClass('fa-eye-slash');
                    $('#password').attr('type','password');
                }
            });

            // Password visibility toggle for confirm password field
            $('.password_btn2').click(function(){
                if($('.password_btn2 i').hasClass('fa-eye-slash')){
                    $('.password_btn2 i').removeClass('fa-eye-slash');
                    $('.password_btn2 i').addClass('fa-eye');
                    $('#password-confirm').attr('type','text');
                }else{
                    $('.password_btn2 i').removeClass('fa-eye');
                    $('.password_btn2 i').addClass('fa-eye-slash');
                    $('#password-confirm').attr('type','password');
                }
            });

            // Real-time password validation
            function validatePasswords() {
                var password = $('#password').val();
                var confirmPassword = $('#password-confirm').val();
                var validationIcon = $('#validation-icon');

                // Only show tick when passwords match and both fields have content
                if (password.length > 0 && confirmPassword.length > 0 && password === confirmPassword) {
                    validationIcon.show();
                    validationIcon.html('✓');
                    validationIcon.removeClass('invalid').addClass('valid');
                } else {
                    // Hide validation icon in all other cases
                    validationIcon.hide();
                }
            }

            // Bind validation to input events
            $('#password, #password-confirm').on('input keyup paste', function() {
                validatePasswords();
            });

            // Initial validation on page load
            validatePasswords();
        });
    </script>
@endpush