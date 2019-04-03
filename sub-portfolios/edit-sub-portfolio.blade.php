@extends('backend.layouts.app')
@section('title')
   Edit Portfolio
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
                    <h4 class="text-capitalize m-0"> <i class="fas fa-book-dead"></i> Edit Portfolio Information</h4>
                    <a href="{{ route('sub_portfolios.index') }}" class="btn btn-outline-success waves-effect waves-light"> <i
                            class="fas fa-caret-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('sub_portfolios.update',$edit->id) }}" id="form" method="POST" enctype="multipart/form-data">
            @csrf 
<div class="row mt-2">
    <div class="col-xs-12 col-md-12 col-lg-8 col-xl-8"> 
            <?php
            echo helper_card_with_input(1, 'Fillup this form', [ 
               
                array('port_details', 'textarea', 'port_details', strip_tags($edit->sub_port_details), 'Portfolio details', 'Write Website Portfolio details', 'portfolio details', 'false', 'false', 'off', '', '', '', '2', '', '', '', ''), 
                ], 'submit', 'save', 'btn btn-outline-primary waves-effect waves-light btn-lg btn-custom');
            ?>  
    </div>  
    <div class="col-xs-12 col-md-12 col-lg-4 col-xl-4"> 
        <div class="card mt-2">
          <div class="card-body">
            <div class="form-group {{ $errors->has('portfolio') ? 'is-invalid' : '' }}">
                <label for="select2">Select Portfolio Category <span class="text-danger">*</span></label>
                <select class="form-control" id="select2" name="portfolio" required>
                    <option value="">-- Please select Category --</option> 
                    @foreach($categories as $portfolio)
                      <option value="{{ $portfolio->id }}"
                       @if($portfolio->id == $edit->portfolio_id)selected @endif 
                      >{{ $portfolio->portfolio_name }}</option> 
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->has('portfolio') ? $errors->first('portfolio') : '' }}</span>

            </div> 
            <?php
              echo Help_all_input_normal('port_name', 'text', 'port_name', $edit->sub_port_name, 'Portfolio Name', 'Write Website Portfolio name', 'Portfolio name', 'true', 'false', 'off', '', '', '', '2', '', '', '', '');
              echo Help_all_input_normal('port_link', 'url', 'port_link', $edit->sub_port_link, 'Portfolio link', 'Write Website Portfolio link', 'Portfolio link', 'true', 'false', 'off', '', '', '', '2', '', '', '', '');
              echo Help_all_input_normal('sub_port_photo', 'file', 'sub_port_photo', [$edit->sub_port_photo,'uploads/portfolio'], 'Portfolio photo', 'Upload Portfolio Photo', '', 'false', 'false', 'off', '', '', '', '2', '', '', '', '');
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
    <script src="{{ asset('backend/js/jquery.checkboxes-1.2.0.min.js') }}"></script>
    <script>
    var app = new Vue({
        el: '#app',
        data: {
          new_password: 'keep',
        }
    });
        $(function () {
             CKEDITOR.replace('port_details');  
            $('#checkall').on('click', function (e) {
                $('#user_check').checkboxes('check');
                e.preventDefault();
            });
        })
    </script>
@endsection
