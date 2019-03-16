@extends('backend.layouts.app')
@section('title')
All portfolio 
@endsection
@section('styles')
@php
    echo datatablecss();
@endphp 
@endsection
@section('main-content')

<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header d-md-flex d-sm-block justify-content-between text-center align-items-center">
                <h4 class="text-capitalize m-0"><i class="fas fa-chess-board"></i> All Portfolio  List</h4>
                @permission("create-portfolios")
                <a href="{{ route('portfolios.create') }}" class="btn btn-outline-success waves-effect waves-light"> <i class="fas fa-plus"></i> Add New Portfolio</a>
                @endpermission
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-striped" id="datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Portfolio Name</th>
                            <th>Portfolio Link</th>  
                            <th>Portfolio Details</th>  
                            <th>Created Date</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection

@section('scripts')

@php
    echo datatablejs();
@endphp
<script type="text/javascript">
$(document).ready(function () {
    $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('getPortfolioData') }}',
        columns: [
            {data: 'id', name: 'id'}, 
            {data: 'port_name', name: 'port_name'},
            {data: 'port_link', name: 'port_link'}, 
            {data: 'port_details', name: 'port_details'}, 
            {data: 'created_at', name: 'created_at'},
            {data: 'manage', name: 'manage'},
        ]
    });
    $('#datatable').off('click');
    $('#datatable').on('click', '#delete', function (e) {  

    Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this Data!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'Your Data has been deleted.',
                'success'
                ) 
                e.preventDefault();
                    var url = $(this).data('remote'); 
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); 
                    $.ajax({
                        url:url ,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#datatable').DataTable().draw(false);
                    });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                'Cancelled',
                'Your Data file is safe :)',
                'error'
                )
            }
            }) 
    }); 
});
</script>
@endsection

 