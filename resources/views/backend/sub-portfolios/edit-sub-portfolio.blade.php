@extends('backend.layouts.app')
@section('title')
   Edit Admin
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
                    <h4 class="text-capitalize m-0"> <i class="fas fa-book-dead"></i> Edit <b>{{ $edit->user_name }}</b> Information</h4>
                    <a href="{{ route('admins.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i
                            class="fas fa-caret-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admins.update',$edit->id) }}" id="form" method="POST">
            @csrf
    <div class="row mt-2">
        <div class="col-xs-12 col-md-8 col-lg-7 col-xl-8"> 
                <?php
                echo helper_card_with_input(1, 'Fillup this form', [
                     array('first_name','text','first_name',$edit->first_name,'First Name','Write Admin User First Name','User First Name','false','false','off','','','','2','','','',''),
                     array('last_name','text','last_name',$edit->last_name,'Last Name','Write Admin User Last Name','User Last Name','false','false','off','','','','2','','','',''),
                    array('user_name', 'text', 'user_name', $edit->user_name, 'User Name', 'Write Admin User Name', 'User Name', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''),
                    array('email', 'email', 'email', $edit->email, 'Email', 'Write Admin Email', 'Email', 'true', 'false', 'on', '', '', '', '2', '', '', '', '', ''),
                     array('address','textarea','address',$edit->address,'Address','Write Admin Address','Address','false','false','on','','','','2','','','15','5'),
                     array('phone','number','phone',$edit->phone,'Phone Number','Write Admin Phone Number','Phone Number','false','false','on','1','','','10','11','','','',''), 
                ]);
                ?> 
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex">
                                <div class="radio radio-primary" title="if your click do not change password then password can't be changed !">
                                    <input type="radio" name="new_password" id="do_not" value="keep" v-model="new_password">
                                        <label for="do_not">
                                                Do Not change Password
                                        </label>
                                </div>
                                <div class="radio radio-success ml-5" title="If you need to change password then click on this and give new password">
                                    <input type="radio" name="new_password" id="give_pass" value="manual" v-model="new_password">
                                    <label for="give_pass">
                                            Give New Password
                                    </label>
                                </div>
                            </div>
                    </div>
                    <div class="card-body"> 
                        <div class="manual_generate" v-if="new_password == 'manual'">
                                <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}" title="Give New Password">
                                    <label for="password">Password <span class="text-danger">(Required)</span></label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="false" required >
                                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                                </div>
                                <div class="form-group" title="Give confirmation Password">
                                    <label for="password">Confirm Password <span class="text-danger">(Required)</span></label>
                                    <input class="form-control {{$errors->has('password_confirmation') ? 'is-danger' : ''}}" type="password" name="password_confirmation"
                                        id="password_confirmation" placeholder="confirm password" required autocomplete="false" data-parsley-equalto="password">
                                </div>
                        </div>
                        <div class="form-group mt-5 text-center"> 
                            <button type="submit" class="btn btn-lg btn-outline-primary btn-rounded waves-effect waves-light">Update Profile</button>
                        </div>
                     </div> 
              </div> 
        </div>
        <div class="col-xs-12 col-md-4 col-lg-5 col-xl-4">
            <upload-image :admin_id="{{ $edit->id }}"></upload-image>
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
                                    <input id="{{ $data->id }}" type="checkbox" name="roles[]" value="{{ $data->id }}" @foreach($edit->roles
                                    as $role) @if($role->id == $data->id) checked @endif @endforeach >
                                    <label for="{{ $data->id }}">
                                            {{ $data->display_name }}
                                    </label>
                                </div>
                            </div>
                            @else
                               @if($data->name !== 'developer')
                               <div class="check-box-main mt-4">
                                <div class="checkbox checkbox-primary">
                                    <input id="{{ $data->id }}" type="checkbox" name="roles[]" value="{{ $data->id }}" @foreach($edit->roles
                                    as $role) @if($role->id == $data->id) checked @endif @endforeach >
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
        el: '#app',
        data: {
          new_password: 'keep',
        }
    });
        $(function () {
            $('#checkall').on('click', function (e) {
                $('#user_check').checkboxes('check');
                e.preventDefault();
            });
        })
    </script>
@endsection
