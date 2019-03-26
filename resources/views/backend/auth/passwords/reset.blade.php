@extends('backend.layouts.app')

@section('main-content')
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="account-bg">
        <div class="card-box mb-0">
            <div class="text-center m-t-20">
                <a href="{{ route('dashboard') }}" class="logo">
                    <i class="zmdi zmdi-group-work icon-c-logo"></i>
                    <span>Admin</span>
                </a>
            </div>
            <div class="m-t-10 p-20">
             <div class="row">
                    <div class="col-12 text-center">
                        <h6 class="text-muted text-uppercase mb-0 m-t-0">{{ __(' Your New password and Email Address') }}</h6>
                        <br>
                    </div>
                </div>
                <form id="form" method="POST" action="{{ route('admin.password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                    @php
                            echo Help_all_input_normal('email','email','email','','','write email for login','Email Address','true','true','on','','','','','');
                    @endphp
                    @php
                            echo Help_all_input_normal('password','password','password','','','Write Your New Password','New Password','true','true','on','','','','','');
                    @endphp
                    @php
                            echo Help_all_input_normal('password-confirm','password','password_confirmation','','','Write Your New Password','Confirmation  Password','true','true','on','','','','','');
                    @endphp

                    <div class="form-group row text-center m-t-20 mb-0">
                        <div class="col-12">
                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit">    {{ __('Reset Password') }}</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- end card-box-->

    <div class="m-t-20">
        <div class="text-center">
            <p class="text-white">Return to<a href="{{ route('admin.login') }}" class="text-white m-l-5"><b>Sign In</b></p>
        </div>
    </div>

</div>
<!-- end wrapper page -->
@endsection
