@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Campaign</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Campaign</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
            <h6 class="mb-0 text-uppercase">New Campaign</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <form class="row g-3" action="{{ route('campaign.store') }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="shop_id">Shop ID <span class="text-danger">*</span></label>
                                <select class="form-control" name="shop_id" id="shop_id">
                                    <option value="">-- Select --</option>
                                    @foreach ($shops as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="start_date">Start Date </label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="details">Details </label>
                                <textarea type="text" class="form-control" name="details" id="details"></textarea>
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
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-lg-8">
            <h6 class="mb-0 text-uppercase">Campaign List</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="4%">#</th>
                                    <th>Title</th>
                                    <th>Shop</th>
                                    {{-- <th>Start Date</th>
                                    <th>End Date</th> --}}
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
            $(document).ready(function() {
                var table = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('campaign.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'shop.name',
                            name: 'shop.name'
                        },
                        // {
                        //     data: 'start_date',
                        //     name: 'start_date'
                        // },
                        // {
                        //     data: 'end_date',
                        //     name: 'end_date'
                        // },
                        {
                            data: 'is_active',
                            name: 'is_active'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            printable: false
                        },
                    ],
                    responsive: false,
                    lengthChange: true,
                });
                $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
            });
            $(document).on('click', '.detail_info', function() {
                $('.detail_info').addClass('disabled');
                var url = $(this).attr("data-route");
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "HTML",
                    success: function(response) {
                        $('#ajaxDiv').html(response);
                        $('#exampleLargeModal').modal('show');
                        $('.detail_info').removeClass('disabled');
                    },
                    error: function(error) {
                        $('.detail_info').removeClass('disabled');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
