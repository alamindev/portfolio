@extends('backend.layouts.app')
@section('title')
Add Social Icon information
@endsection 
@section('styles')
@php
echo colorPickercss();
@endphp 

@endsection
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
            <h4 class="text-capitalize m-0"><i class="fas fa-first-aid"></i>Add Social Icon Information</h4>
                <a href="{{ route('social-icon.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-caret-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('social-icon.store') }}" id="form" method="POST">
  @csrf 
<div class="row mt-2">
    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12"> 
            <?php
            echo helper_card_with_input(1, 'Fillup this form', [  
                array('icon', 'text', 'icon', '', 'FontAwesome Icon', 'Paste Icon Or Class Name', '<i class=\'fas fa-facebook\'></i>', 'true', 'true', 'off', '', '', '', '2', '', '', '', ''),   
                array('link', 'text', 'link', '', 'Social Link', 'Paste your social profile link', 'www.example.com', 'true', 'true', 'off', '', '', '', '2', '', '', '', ''), 
                array('background', 'text', 'background', '', 'Background Color', 'background color', '#fff', 'true', 'true', 'off', '', '', '', '2', '', '', '', ''), 
                array('color', 'text', 'color', '', 'Icon Color', 'Icon Color', '#fff', 'true', 'true', 'off', '', '', '', '2', '', '', '', ''), 
                array('hover_color', 'text', 'hover_color', '', 'Icon hover color', 'Icon hover color', '#fff', 'true', 'true', 'off', '', '', '', '2', '', '', '', ''),
                array('hover_background', 'text', 'hover_background', '', 'Icon Hover Background', 'Icon Hover Background', '#fff', 'true', 'true', 'off', '', '', '', '2', '', '', '', ''),
                array('font_size', 'text', 'font_size', '', 'Icon font size', 'Icon font size', '18px', 'true', 'true', 'off', '', '', '', '2', '', '', '', '')
                ], 'submit', 'save', 'btn btn-outline-primary waves-effect waves-light btn-lg btn-custom');
            ?>  
    </div>   
</div>
</form>
<!-- end row -->

@endsection
@section('scripts') 
@php 
    echo colorPickerjs(); 
@endphp
<script> 
  $(document).ready(function(){
   $('#color').colorpicker({
        format: 'hex', 
    });
   $('#hover_color').colorpicker({
        format: 'hex'
    });
    $('#background').colorpicker();
    $('#hover_background').colorpicker();
  });
</script>
@endsection
 