@extends('backend.layouts.app')
@section('title')
Create New Permission
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
                <h4 class="text-capitalize m-0"><i class="fas fa-first-aid"></i> Add New Permission</h4>
                <a href="{{ route('permissions.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
        <form action="{{ route('permissions.store') }}" id="form" method="POST">
            @csrf 
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="radio radio-success">
                            <input  type="radio" v-model="permissionType" name="permission_type" value="basic" id="basic" >
                            <label for="basic">
                                Basic Permission
                            </label>
                        </div>
                        <div class="radio radio-info ml-4">
                            <input type="radio" v-model="permissionType"  name="permission_type" value="crud" id="crud" value="crud">
                            <label for="crud">
                                CRUD Permission
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="select2">Select Database Table <span class="text-danger">(Required)</span></label>
                        <select class="form-control" id="select2" name="per_table" required>
                            <option value="">-- Please select Table --</option>
                            @foreach($tables as $table)
                            @foreach ($table as $key => $value)  
                            @if($value !== 'password_resets' &&  $value !== 'migrations' && $value !== 'role_user' && $value !== 'permission_role' && $value !== 'permission_user'  && $value !== 'view_tables' && $value !== 'view_tables' && $value !== 'users')

                            <option value="{{  $value }}">{{  $value }}</option> 
                            @endif
                            @endforeach
                            @endforeach   
                        </select>
                    </div> 
                    <div class="card  mt-4">
                        <div class="card-body">
                            <div class="basic" v-if="permissionType == 'basic'">
                                @php
                                echo Help_all_input_normal('display_name','text','display_name','','Name (Human Readable)','Write Admin Role Human readable','example:- Create Table','true','false','off','','','','2','','','','');
                                echo Help_all_input_normal('name','text','name','','Slug (Cant Not be changed)','Write Admin Role Slug','example:- create-table','true','false','off','','','','2','','','','');
                                echo Help_all_input_normal('description','textarea','description','','Description (Optional)','Write Admin Role Description','Write something','false','false','off','','','','2','','','','');
                                @endphp
                            </div>
                            <div class="crud" v-if="permissionType == 'crud'"> 
                                <div class="form-group {{ $errors->has('table_name') ? 'is-invalid' : '' }}" title="Select Table Name at the top select box and Write a table Name are they same">
                                    <label for="table_name">Table Name <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" name="table_name" id="table_name" v-model="table_name" placeholder="Write Your Table name"
                                           value="{{ old('table_name') }}" required>
                                    <span class="text-danger">{{ $errors->has('table_name') ? $errors->first('table_name') : '' }}</span>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4"> 
                                        <div class="checkbox checkbox-danger">
                                            <input id="index" type="checkbox" v-model="crudSelected" value="index" checked>
                                            <label for="index">
                                                Index
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-primary">
                                            <input id="create" type="checkbox" v-model="crudSelected" value="create" checked>
                                            <label for="create">
                                                Create
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="read" type="checkbox" v-model="crudSelected" value="read" checked>
                                            <label for="read">
                                                Read
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input id="update" type="checkbox" v-model="crudSelected" value="update" checked>
                                            <label for="update">
                                                Update
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-warning">
                                            <input id="delete" type="checkbox" checked v-model="crudSelected" value="delete">
                                            <label for="delete">
                                                delete
                                            </label>
                                        </div> 
                                    </div>
                                    <div class="col-lg-8"> 
                                        <input type="hidden" name="crud_selected" :value="crudSelected">
                                        <table class="table table-striped" v-if="table_name.length >= 3 && crudSelected.length > 0">
                                            <thead>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in crudSelected">
                                                    <td v-text="crudName(item)"></td>
                                                    <td v-text="crudSlug(item)"></td>
                                                    <td v-text="crudDescription(item)"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>     
                                </div>             
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
@section('scripts')
@php
echo select2js();
@endphp 

<script>
var app = new Vue({
el: '#app',
data: {
    permissionType: 'basic',
    table_name: '',
    crudSelected: ['index','create', 'read', 'update', 'delete'],
},
methods: {
    crudName: function (item) {
        return item.substr(0, 1).toUpperCase() + item.substr(1) + " " + app.table_name.substr(0, 1).toUpperCase() + app.table_name.substr(1);
    },
    crudSlug: function (item) {
        return item.toLowerCase() + "-" + app.table_name.toLowerCase();
    },
    crudDescription: function (item) {
        return "Allow a User to " + item.toUpperCase() + " a " + app.table_name.substr(0, 1).toUpperCase() + app.table_name.substr(1);
    }
}

});
$(document).ready(function () {
$('#select2').select2();
});
</script>
@endsection
