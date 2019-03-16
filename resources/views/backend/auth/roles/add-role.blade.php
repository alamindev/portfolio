@extends('backend.layouts.app')
@section('title')
    Create New Role
@endsection
@section('styles')
@php
echo select2css();
@endphp 
@endsection
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
                <h4 class="text-capitalize m-0"><i class="fas fa-first-aid"></i>  Add New Role</h4>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('roles.store') }}" id="form" method="POST">
        @csrf
<div class="row mt-2"> 
        <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4"> 
                <?php
                echo helper_card_with_input(1, 'Fillup this form', [
                    array('name', 'text', 'display_name', '', 'Name (Human Readable)', 'Write Admin Role Human readable', 'example:- SupperAdmin', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''),
                    array('slug', 'text', 'name', '', 'Slug (Cant Not be changed)', 'Write Admin Role Slug', 'example:- SupperAdmin', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''),
                    array('description', 'textarea', 'description', '', 'Description (Optional)', 'Write Admin Role Description', 'Write something', 'false', 'false', 'off', '', '', '', '2', '', '', '', ''),
                        ], 'submit', 'save', 'btn btn-outline-success waves-effect waves-light .btn-custom');
                ?>
        </div>

        <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8"> 
            <div class="card mt-2"> 
                <div class="card-body">
                    <p class="text-danger">If You Are Not Show Permission Table click the button below select a table</p>
                    <button class="btn btn-outline-primary waves-effect waves-light btn-block" data-toggle="modal" data-target="#permission_table">Add Permission Table</button>
                </div>
            </div>
            <div class="card mt-2">
                    <div class="card-body">
                    <div id="checkbox" class="check_all">
                        <a href="#checkbox" id="btn-check-all" data-toggle="checkboxes" data-action="check" class="btn btn-primary waves-effect waves-light mr-2">check all</a>
                        <a href="#checkbox" class="btn btn-outline-warning waves-effect waves-light" id="btn-check-all" data-toggle="checkboxes" data-action="uncheck">uncheck all</a>
                        <ul style="margin: 15px 0">
                            @foreach($view_tables as $table)  
                                @if(auth()->user()->hasRole('developer'))
                                <li style="width: 50%; float:left;list-style:none; " class="mb-2">
                                    <div id="{{ $table->t_name }}">
                                    <h4 for="permission" class=" text-muted"> Permission <span class="text-primary">{{ $table->t_name }}</span> Table</h4> 
                                    <div class="d-flex mb-3">
                                        <a href="#{{ $table->t_name }}" class="btn btn-outline-success waves-effect waves-light btn-sm mr-3" id="checkall" data-toggle="checkboxes"
                                        data-action="check">check</a>
                                        <a href="#{{ $table->t_name }}" class="btn btn-warning waves-effect waves-light btn-sm" id="checkall" data-toggle="checkboxes"
                                        data-action="uncheck">uncheck</a>
                                    </div>
                                        @php
                                        $value = $table->t_name; 
                                        @endphp
                                        @foreach($permissions as $permission) 
                                            @if($permission->per_table === $value)
                                                  <div class="checkbox checkbox-primary">
                                                    <input id="{{ $permission->id }}"  type="checkbox"  name="permission[]" value="{{ $permission->id }}">
                                                    <label for="{{ $permission->id }}">
                                                            {{ $permission->display_name }}
                                                    </label>
                                                </div>  
                                            @endif 
                                        @endforeach
                                    </div>
                                </li> 
                                @else 
                                @if($table->t_name !== 'permissions')
                                <li style="width: 50%; float:left;list-style:none; " class="mb-2">
                                    <div id="{{ $table->t_name }}">
                                    <h4 for="permission" class=" text-muted"> Permission <span class="text-primary">{{ $table->t_name }}</span> Table</h4> 
                                    <div class="d-flex mb-3">
                                        <a href="#{{ $table->t_name }}" class="btn btn-outline-success waves-effect waves-light btn-sm mr-3" id="checkall" data-toggle="checkboxes"
                                        data-action="check">check</a>
                                        <a href="#{{ $table->t_name }}" class="btn btn-warning waves-effect waves-light btn-sm" id="checkall" data-toggle="checkboxes"
                                        data-action="uncheck">uncheck</a>
                                    </div>
                                        @php
                                        $value = $table->t_name; 
                                        @endphp
                                        @foreach($permissions as $permission) 
                                            @if($permission->per_table === $value)
                                                  <div class="checkbox checkbox-primary">
                                                    <input id="{{ $permission->id }}"  type="checkbox"  name="permission[]" value="{{ $permission->id }}">
                                                    <label for="{{ $permission->id }}">
                                                            {{ $permission->display_name }}
                                                    </label>
                                                </div>  
                                            @endif 
                                        @endforeach
                                    </div>
                                </li> 
                                @endif
                                @endif 
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>  
</div>
</form>

<!-- Show modal -->
<div class="modal fade" id="permission_table" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('database_user_store') }}" method="post" id="form" >
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">Show Permission Table</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" >
                    
                    <div class="form-group"  >
                        <label for="display_name"> Select Database Table </label>
                        <select id="select2" name="per_table" class="form-control" style="width: 100%; z-index: 999;" required> 
                                <option value="" title="Please Select Databasse table for give permission">-- Please select Table --</option>
                                @foreach($tables as $table)
                                @foreach ($table as $key => $value)  
                                @if($value !== 'password_resets' &&  $value !== 'migrations' && $value !== 'role_user' && $value !== 'permission_role' && $value !== 'permission_user'  && $value !== 'view_tables') 
                                    <option value="{{  $value }}">{{  $value }}</option> 
                                @endif
                                @endforeach
                                @endforeach   
                        </select>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-outline-danger waves-effect waves-light" data-dismiss="modal">Cancel</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@php
echo  checkboxjs();
echo select2js();
@endphp 
<script>
$(function () {
    $('#btn-check-all').on('click', function(e) {
      $('#checkbox').checkboxes('check');
      e.preventDefault();
    });
    $('#checkall').on('click', function(e) {
      $('#user_check').checkboxes('check');
      e.preventDefault();
    }); 
$('#select2').select2();
}) 
</script>
@endsection
