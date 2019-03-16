@extends('backend.layouts.app')
@section('title')
View portfolio Information Details
@endsection 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-md-flex d-sm-block justify-content-between text-center bg-success text-light align-items-center">
                <h4 class="text-capitalize m-0"><i class="fas fa-star-of-david"></i> View {{ $show->port_name }} Information</h4>
                <a href="{{ route('portfolios.index') }}" class="btn btn-outline-light waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
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
                        <td>Portfolio Name</td>
                        <td>:</td>
                        <td>{{ $show->port_name }}</td>
                    </tr>
                    <tr>
                        <td>Portfolio Link</td>
                        <td>:</td>
                        <td>{{ $show->port_link }}</td>
                    </tr>
                    <tr>
                        <td>Portfolio Details</td>
                        <td>:</td>
                        <td>{{ $show->port_details }}</td>
                    </tr> 
                </table>
            </div>
            <div class="card-header">
                <a href="{{ route('portfolios.edit',$show->id) }}" class="btn btn-outline-primary waves-effect waves-light">Update your profile</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-success">
            <div class="card-header bg-success text-light">
                portfolio Photo
            </div>
            <div class="card-body">
                <img src="{{ asset('uploads/portfolio/'.$show->port_photo ) }}" alt="photo" class="img-fluid">
            </div>
        </div> 
    </div>
</div>

<!-- end row -->

@endsection 
