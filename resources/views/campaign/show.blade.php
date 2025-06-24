@extends('layouts.app')

@push('styles')
    <!-- Add custom styles here if needed -->
@endpush

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Campaign</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Campaign Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Campaign Details -->
    <div class="row">
        <div class="col-12">
            {{-- <a href="{{ route('form.show', $campaign->id) }}" class="mb-0 text-uppercase">Campaign Form</a> --}}
            <a href="{{ route('form.create', $campaign->id) }}" class="mb-0 text-uppercase">Create Campaign Form</a>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th>Campaign Name</th>
                                    <td>{{ $campaign->title ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date</th>
                                    <td>{{ $campaign->start_date ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ $campaign->end_date ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($campaign->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-warning">In Active</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Shop</th>
                                    <td>{{ $campaign->shop->name ?? 'Not Assigned' }}</td>
                                </tr>

                                <tr>
                                    <th>Details</th>
                                    <td>{{ $campaign->details }}</td>
                                </tr>
                                <!-- Add more fields as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Campaign Details -->
@endsection

@push('scripts')
    <!-- Add custom scripts here if needed -->
@endpush
