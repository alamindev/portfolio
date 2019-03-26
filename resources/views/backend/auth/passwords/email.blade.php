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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h6 class="text-muted text-uppercase mb-0 m-t-0">{{ __('Reset Password') }}</h6>
                        <p class="text-muted m-b-0 font-13 m-t-20">Enter your email address and we'll send you an email with instructions to reset your password.  </p>
                    </div>
                </div>
                <form id="form" method="POST" action="{{ route('admin.password.email') }}">
                    @csrf

                    @php
                            echo Help_all_input_normal('email','email','email','','','write email for login','Email Address','true','true','on','','','','','');
                    @endphp

                    <div class="form-group row text-center m-t-20 mb-0">
                        <div class="col-12">
                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit">{{ __('Send Password Reset Link') }}</button>
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
