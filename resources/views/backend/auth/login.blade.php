@extends('backend.layouts.app')

@section('main-content')
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

    <div class="account-bg">
        <div class="card-box mb-0">
            <div class="text-center m-t-20">
                <a href="index.html" class="logo">
                    <i class="zmdi zmdi-group-work icon-c-logo"></i>
                    <span>Admin</span>
                </a>
            </div>
            <div class="m-t-10 p-20">
                <div class="row">
                    <div class="col-12 text-center">
                        <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
                    </div>
                </div>
                <form id="form" class="form-horizontal" method="POST" action="{{ route('admin.login.post') }}">
                        @csrf

                    @php
                            echo Help_all_input_normal('email','text','email','','','write email for login','Email Or Username','true','true','on','','','','4','');
                     @endphp
                    @php
                        echo Help_all_input_normal('password','password','password','','','write password for login','Password','true','true','on','','','','6','');
                     @endphp


                    <div class="form-group row">
                        <div class="col-12">
                            <div class="checkbox checkbox-custom">
                                <input type="checkbox" id="checkbox-signup" name="remember" {{ old( 'remember')? 'checked' : '' }} >
                                <label for="checkbox-signup">Remember Me</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center row m-t-10">
                        <div class="col-12">
                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    <div class="form-group row m-t-30 mb-0">
                        <div class="col-12">
                            <a href="{{ route('admin.password.request') }}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- end wrapper page -->
@endsection
