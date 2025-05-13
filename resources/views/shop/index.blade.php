@extends('layouts.app')
@push('styles')    
@endpush
@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Store</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        
    </div>
</div>
<div class="row">
    <div class="col col-lg-4">
        <h6 class="mb-0 text-uppercase">New Shop</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                   <form class="row g-3" action="{{route('shop.store')}}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="name">Shop Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="address">Shop Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="phone">Phone No.</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="tin_no">TIN No.</label>
                            <input type="text" class="form-control" name="tin_no" id="tin_no" value="">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="is_active">Status</label>
                            <select class="form-select single-select" id="is_active" name="is_active" required>
                                <option value="1" selected>Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                   </form>
                </div>
             </div>
        </div>
    </div>
    <div class="col col-lg-8">
        <h6 class="mb-0 text-uppercase">Shop List</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="4%">#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th width="10%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ajaxDiv"></div>
<!--end breadcrumb-->
@endsection

@push('scripts')
    <script>
        (function($) {
            "use strict";
            APP_TOKEN;
            $(document).ready(function(){
                var table = $('#dataTable').DataTable( {
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('shop.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'slug', name: 'slug'},
                        {data: 'address', name: 'address'},
                        {data: 'phone', name: 'phone'},
                        {data: 'is_active', name: 'is_active'},
                        {data: 'action', name: 'action', orderable: false, searchable: false, printable:false},
                    ],
                    responsive: false,
                    lengthChange: true,
                } );
                $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
            });
            $(document).on('click','.detail_info', function(){
                $('.detail_info').addClass('disabled');
                var url = $(this).attr("data-route");
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "HTML",
                    success: function (response) {
                        $('#ajaxDiv').html(response);
                        $('#exampleLargeModal').modal('show');
                        $('.detail_info').removeClass('disabled');
                    },
                    error: function (error) {
                        $('.detail_info').removeClass('disabled');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
