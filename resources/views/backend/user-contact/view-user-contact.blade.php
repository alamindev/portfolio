@extends('backend.layouts.app')
@section('title')
View User Contact Information Details
@endsection 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-md-flex d-sm-block justify-content-between text-center bg-success text-light align-items-center">
                <h4 class="text-capitalize m-0 text-light"><i class="fas fa-star-of-david text-light"></i> View User Contact Information</h4>
                <a href="{{ route('user-contact.index') }}" class="btn btn-outline-light waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2"> 
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td  style="width: 200px;">Id</td>
                        <td style="width: 50px;">:</td>
                        <td>{{ $show->id }}</td>
                    </tr>
                    <tr>
                        <td>User Name</td>
                        <td>:</td>
                        <td>{{ $show->name }}</td>
                    </tr>
                    <tr>
                        <td>User Email</td>
                        <td>:</td>
                        <td>{{ $show->email }}</td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>:</td>
                        <td>{{ $show->subject }}</td>
                    </tr>
                    <tr>
                        <td>Details</td>
                        <td>:</td>
                        <td>{{ $show->details }}</td>
                    </tr>   
                </table>
            </div> 
        </div>
    </div> 
</div>

<!-- end row -->

@endsection 
