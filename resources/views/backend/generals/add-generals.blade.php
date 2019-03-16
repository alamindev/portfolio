@extends('backend.layouts.app')
@section('title')
Add General information
@endsection 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
            <h4 class="text-capitalize m-0"><i class="fas fa-first-aid"></i>Add General Information</h4>
                <a href="{{ route('generals.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('generals.store') }}" id="form" method="POST" enctype="multipart/form-data">
  @csrf 
<div class="row mt-2">
    <div class="col-xs-12 col-md-12 col-lg-8 col-xl-8"> 
            <?php
            echo helper_card_with_input(1, 'Fillup this form', [ 
                array('main_text', 'text', 'main_text', '', 'Website Main Text', 'Write Website Main Heading Text', 'example:- John Doe', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''), 
                array('logo', 'file', 'logo', '', 'Website Logo', 'Upload Website Logo', '', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''), 
                array('fav_icon', 'file', 'fav_icon', '', 'Website fav icon', 'Upload Website fav icon', '', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''), 
                array('copy_right', 'text', 'copy_right', '', 'Website copyright', 'Write Copyright text for website', '', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''), 
                array('photo', 'file', 'photo', '', 'Author Photo', 'Upload Website author photo', '', 'true', 'false', 'off', '', '', '', '2', '', '', '', ''), 
            ], 'submit', 'save', 'btn btn-outline-primary waves-effect waves-light btn-lg btn-custom');
            ?> 
       
    </div> 
    <div class="col-xs-12 col-md-12 col-lg-4 col-xl-4">
         <div class="card mt-2"> 
            <div class="card-body">
                <ul class="list-group" v-if="items !== ''">
                    <li class="list-group-item d-flex justify-content-between h5"  v-for="(item, index) in items" :key="index">@{{ item }} <button  @click="removeItem(index)" type="button" class="btn btn-outline-danger waves-effect waves-light btn-sm "><i class="fas fa-trash"></i></button></li> 
                </ul>
                <div class="defult"  v-if="items == ''">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between h5">Default Value</li> 
                    </ul>
                    <input type="hidden" name="animate_text[]" value="default value" >
                </div>
                
              <div class="form-group mt-3" v-if="itemForm">
                  <input type="text" name="main_texts" v-model="main_texts" class="form-control">  
              </div> 
              <input type="hidden" name="animate_text[]" :value="animateText" >
              <button type="button" v-if="!itemForm" @click="AddNewItem" class="btn btn-outline-warning waves-effect waves-light btn-lg btn-block mt-2"><i class="fas fa-plus"></i> Add New</button>
              <button type="button" v-if="itemForm" @click="SaveItem" class="btn btn-outline-success waves-effect waves-light btn-lg btn-block mt-2" v-bind:disabled="main_texts === ''"> Save</button>
            </div>
         </div>
    </div> 
</div>
</form>
<!-- end row -->

@endsection
@section('scripts') 
<script>
var app = new Vue({
  el: '#app', 
  data:{ 
      items: [],
      itemForm: false,
      main_texts: '',
  },
  computed:{
    animateText(){
      return this.items;
    }
  },
  methods: {
    AddNewItem(){
      this.itemForm = true; 
    },
    SaveItem(){
      this.items.push(this.main_texts);
      this.main_texts = '';
      this.itemForm = false;
    },
    removeItem(index){ 
      this.$delete(this.items, index);
    }
  },
}); 
</script>
@endsection
