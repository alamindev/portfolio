@extends('backend.layouts.app')
@section('title')
view Role
@endsection 
@section('main-content')

<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body d-md-flex d-sm-block justify-content-between text-center bg-success text-light align-items-center">
                <h4 class="text-capitalize m-0"><i class="fas fa-star-of-david"></i>view Roles</h4>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered"> 
                        <tr>
                                <td   style="width: 200px;">Id</td>
                                <td style="width: 50px;">:</td>
                                <td>{{ $show->id }}</td>
                            </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $show->display_name }}</td>
                    </tr>
                    <tr>
                        <td>Slug</td>
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
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="title bg-primary p-2 rounded text-light">Permissions:</h3>
                            <ul>
                              @foreach ($show->permissions as $r)
                              <li><span class="font-weight-bold text-primary">{{ $r->display_name }}</span><em class="ml-1">({{$r->description}})</em></li>
                              @endforeach
                            </ul>
                    </div>
                    <div class="col-lg-4">
                            <h3 class="title bg-info p-2 rounded text-light">Users:</h3>
                            <ul>
                              @foreach ($show->users as $r)
                              <li> <span class="font-weight-bold text-info">{{$r->user_name}} </span><em class="ml-1">({{$r->email}})</em></li>
                              @endforeach
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->


@endsection 