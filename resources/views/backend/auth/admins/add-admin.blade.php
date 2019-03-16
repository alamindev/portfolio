@extends('backend.layouts.app')
@section('title')
    Create New Admin
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
                    <h4 class="text-capitalize m-0"><i class="fas fa-first-aid"></i> Add New Addmin</h4>
                    <a href="{{ route('admins.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i
                            class="fas fa-caret-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admins.store') }}" id="form" method="POST">
            @csrf
    <div class="row mt-2">
        <div class="col-xs-12 col-md-8 col-lg-7 col-xl-8"> 
                <?php
                echo helper_card_with_input(1, 'Fillup this form', [ 
                    array('user_name', 'text', 'user_name', '', 'User Name', 'Write Admin User Name', 'User Name', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''),
                    array('email', 'email', 'email', '', 'Email', 'Write Admin Email', 'Email', 'true', 'false', 'on', '', '', '', '2', '', '', '', '', ''), 
                    array('password', 'password', 'password', '', 'Password', 'Write Admin Password', 'Password', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''),
                    array('password-confirm', 'password', 'password_confirmation', '', 'Confirm Password', 'Write Admin confirm Password', 'Confirm Password', 'true', 'false', 'off', '', '', '', '2', '', 'password', '', ''),
                ], 'submit', 'save', 'btn btn-outline-purple waves-effect waves-light btn-lg btn-custom');
                ?> 
        </div>
        <div class="col-xs-12 col-md-4 col-lg-5 col-xl-4"> 
            <div class="card mt-2">
                <div class="card-header">Select User Role</div>
                <div class="card-body">
                    <div class="card-title">
                        <h5 class="text-danger">Please Select At least one Roles :) - </h5>
                    </div> 
                    <div id="checkbox" class="check_all mt4">
                        <a href="#checkbox" id="btn-check-all" data-toggle="checkboxes" data-action="check"
                           class="btn btn-outline-info btn-sm waves-effect waves-light">check all</a>
                        <a href="#checkbox" class="btn btn-outline-primary waves-effect waves-light btn-sm"
                           id="btn-check-all" data-toggle="checkboxes" data-action="uncheck">uncheck all</a>
                           @foreach($roles as $data)
                                @if(auth()->user()->hasRole('developer'))
                                    <div class="check-box-main mt-4">
                                        <div class="checkbox checkbox-primary">
                                            <input id="{{ $data->id }}" type="checkbox" name="roles[]" value="{{ $data->id }}">
                                            <label for="{{ $data->id }}">
                                                    {{ $data->display_name }}
                                            </label>
                                        </div>
                                    </div>
                                @else
                                   @if($data->name !== 'developer')
                                    <div class="check-box-main mt-4">
                                        <div class="checkbox checkbox-primary">
                                            <input id="{{ $data->id }}" type="checkbox" name="roles[]" value="{{ $data->id }}">
                                            <label for="{{ $data->id }}">
                                                    {{ $data->display_name }}
                                            </label>
                                        </div>
                                    </div>
                                   @endif
                                @endif 
                            @endforeach
                            @if($errors->has('roles'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('roles') }} 
                             @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <!-- end row -->

@endsection
@section('scripts')
    <script src="{{ asset('backend/js/jquery.checkboxes-1.2.0.min.js') }}"></script>
    <script>
        var app = new Vue({
            el: '#app'
        });
        $(function () {
            $('#checkall').on('click', function (e) {
                $('#user_check').checkboxes('check');
                e.preventDefault();
            });
        })
    </script>
@endsection
