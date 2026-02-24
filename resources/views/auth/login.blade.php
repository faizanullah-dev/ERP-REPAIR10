@extends('layouts.app')

@section('content')
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box passowrd_fields">
            <form class="form-horizontal form-material" id="loginform" method="post" action="{{ route('login') }}">
                {{csrf_field()}}
                <h3 class="box-title m-b-20">Sign In</h3>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <label for="email" class="form-label input_labels p-18">Email</label>
                        <div class="input_group_box">
                            <input id="email" placeholder="example@mail.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input_icon">
                                <a href="javascript:void(0);"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="password" class="form-label input_labels p-18">Password</label>
                        <div class="input_group_box">
                            <input id="password"  type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Type password">
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
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input type="checkbox" id="checkbox-signup" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="checkbox-signup"> Remember me </label>
                        </div>
                        <a href="{{ route('password.request') }}" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"> Log In
                        </button>
                    </div>
                </div>
                {{-- use for social auth --}}
                {{-- <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social">
                            <a href="{{url('auth/facebook')}}" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                            <a href="{{url('auth/google')}}" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                        </div>
                    </div>
                </div> --}}
{{--                <div class="form-group m-b-0">--}}
{{--                    <div class="col-sm-12 text-center">--}}
{{--                        <p>Don't have an account? <a href="{{url('register')}}" class="text-primary m-l-5"><b>Sign Up</b></a></p>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </form>
        </div>
    </div>
</section>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(function(){
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
        });
    </script>
@endpush