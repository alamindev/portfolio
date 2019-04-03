@extends('backend.layouts.app')
@section('title')
View Social Icon Information Details
@endsection 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-md-flex d-sm-block justify-content-between text-center bg-success text-light align-items-center">
                <h4 class="text-capitalize m-0 text-light"><i class="fas fa-star-of-david text-light"></i> View Social Icon Information</h4>
                <a href="{{ route('social-icon.index') }}" class="btn btn-outline-light waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
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
                        <td>Icon class</td>
                        <td>:</td>
                        <td>{{ $show->icon }}</td>
                    </tr>
                    <tr>
                        <td>Social Link</td>
                        <td>:</td>
                        <td>{{ $show->link }}</td>
                    </tr>
                    <tr>
                        <td>Font Size</td>
                        <td>:</td>
                        <td>{{ $show->font_size }}</td>
                    </tr>
                    <tr>
                        <td>Background Color</td>
                        <td>:</td>
                        <td>{{ $show->background }}</td>
                    </tr> 
                    <tr>
                        <td>Icon Color</td>
                        <td>:</td>
                        <td>{{ $show->color }}</td>
                    </tr> 
                    <tr>
                        <td>Icon Hover Color</td>
                        <td>:</td>
                        <td>{{ $show->hover_color }}</td>
                    </tr> 
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('social-icon.edit',$show->id) }}" class="btn btn-outline-primary waves-effect waves-light">Update social Icon</a>
            </div>
        </div>
    </div> 
</div>

<!-- end row -->

@endsection 
