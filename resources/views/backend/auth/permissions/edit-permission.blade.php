@extends('backend.layouts.app') 
@section('title') Edit Permission
@endsection
 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
                <h4 class="text-capitalize m-0"> <i class="fas fa-book-dead"></i>Edit Permission</h4>
                <a href="{{ route('permissions.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-xs-12 col-md-12 col-lg12 col-xl-12">
        <form action="{{ route('permissions.update',$edit->id) }}" id="form" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="select2">Select Database Table</label>
                        <select class="form-control" name="per_table" disabled>
                            <option value="">-- Please select Table --</option>
                            @foreach($tables as $table)
                                @foreach ($table as $key => $value)   
                                <option value="{{  $value }}" 
                                        @if($value == $edit->per_table) selected @endif
                                        >{{  $value }}</option>  
                                @endforeach
                            @endforeach   
                        </select>
                    </div>
                    <div class="card  mt-4">
                        <div class="card-body">
                            <div class="basic">
                                @php echo Help_all_input_normal('display_name','text','display_name',$edit->display_name,'Name (Human Readable)','Write Admin
                                Role Human readable','example:- Create Table','true','false','off','','','','2','','','','');
                                echo Help_all_input_normal('name','text','name',$edit->name,'Slug (Can Not be changed)','Write
                                Admin Role Slug','','false','false','off','','','','2','','','','','disabled'); echo Help_all_input_normal('description','textarea','description',$edit->description,'Description
                                (Optional)','Write Admin Role Description','Write something','false','false','off','','','','2','','','','');
                                
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- end row -->
@endsection