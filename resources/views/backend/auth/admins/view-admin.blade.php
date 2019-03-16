@extends('backend.layouts.app')
@section('title')
View Admin User details
@endsection 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-md-flex d-sm-block justify-content-between text-center bg-success text-light align-items-center">
                <h4 class="text-capitalize m-0"><i class="fas fa-star-of-david"></i> View {{ $show->user_name }} Information</h4>
                <a href="{{ route('admins.index') }}" class="btn btn-outline-light waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2"> 
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td  style="width: 200px;">Id</td>
                        <td style="width: 50px;">:</td>
                        <td>{{ $show->id }}</td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td>:</td>
                        <td>{{ $show->first_name }}</td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>:</td>
                        <td>{{ $show->last_name }}</td>
                    </tr>
                    <tr>
                        <td>User Name</td>
                        <td>:</td>
                        <td>{{ $show->user_name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $show->email }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{ $show->address }}</td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>:</td>
                        <td>{{ $show->phone }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-header">
                <a href="{{ route('admins.edit',$show->id) }}" class="btn btn-outline-primary waves-effect waves-light">Update your profile</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-success">
            <div class="card-header bg-success text-light">
                Admin Photo
            </div>
            <div class="card-body">
                <img src="{{ asset('uploads/avaters/'.$show->photo) }}" alt="photo" class="img-fluid">
            </div>
        </div>
        <div class="card mt-3 border-info">
            <div class="card-header  bg-info text-light">
                Admin  Roles
            </div>
            <div class="card-body">
                <ul class="list-group list-unstyled">
                    @foreach($show->roles as $role)
                        <li class="list-group-item">  {{ strtoupper($role->display_name) }}</li>
                    @endforeach
                </ul> 
            </div>
        </div>
    </div>
</div>

<!-- end row -->

@endsection 
