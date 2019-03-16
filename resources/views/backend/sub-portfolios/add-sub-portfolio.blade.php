@extends('backend.layouts.app')
@section('title')
Add portfolio information
@endsection 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
            <h4 class="text-capitalize m-0"><i class="fas fa-first-aid"></i>Add portfolio Information</h4>
                <a href="{{ route('portfolios.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('portfolios.store') }}" id="form" method="POST" enctype="multipart/form-data">
  @csrf 
<div class="row mt-2">
    <div class="col-xs-12 col-md-12 col-lg-8 col-xl-8"> 
            <?php
            echo helper_card_with_input(1, 'Fillup this form', [ 
               
                array('port_details', 'textarea', 'port_details', '', 'Portfolio details', 'Write Website Portfolio details', 'portfolio details', 'false', 'false', 'off', '', '', '', '2', '', '', '', ''), 
                ], 'submit', 'save', 'btn btn-outline-primary waves-effect waves-light btn-lg btn-custom');
            ?>  
    </div>  
    <div class="col-xs-12 col-md-12 col-lg-4 col-xl-4"> 
        <div class="card mt-2">
          <div class="card-body">
            <?php
              echo Help_all_input_normal('port_name', 'text', 'port_name', '', 'Portfolio Name', 'Write Website Portfolio name', 'portfolio name', 'true', 'false', 'off', '', '', '', '2', '', '', '', '');
              echo Help_all_input_normal('port_link', 'url', 'port_link', '', 'Portfolio link', 'Write Website Portfolio link', 'portfolio link', 'true', 'false', 'off', '', '', '', '2', '', '', '', '');
              echo Help_all_input_normal('port_photo', 'file', 'port_photo', '', 'Portfolio photo', 'Upload Portfolio Photo', '', 'true', 'false', 'off', '', '', '', '2', '', '', '', '');
            ?>
          </div>
        </div> 
    </div>  
</div>
</form>
<!-- end row -->

@endsection
@section('scripts') 
@php
    echo ckeditorjs();
@endphp
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

  $(document).ready(function(){
    CKEDITOR.replace('port_details');  
  });
</script>
@endsection
