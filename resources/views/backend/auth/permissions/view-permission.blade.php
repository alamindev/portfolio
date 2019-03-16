@extends('backend.layouts.app')
@section('title')
View Permission Details
@endsection 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-md-flex d-sm-block justify-content-between text-center bg-success text-light align-items-center">
                <h4 class="text-capitalize m-0"><i class="fas fa-star-of-david"></i>View Permission Details</h4>
                <a href="{{ route('permissions.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2"> 
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <td   style="width: 200px;">Id</td>
                <td style="width: 50px;">:</td>
                <td>{{ $show->id }}</td>
            </tr>
            <tr>
                <td>Table Name</td>
                <td>:</td>
                <td>{{ $show->per_table }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td>{{ $show->display_name }}</td>
            </tr>
            <tr>
                <td>
                    Slug</td>
                <td>:</td>
                <td>{{ $show->name }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>:</td>
                <td>{{ $show->description }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- end row -->

@endsection 
