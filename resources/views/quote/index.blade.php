@extends('layouts.app')
@push('styles')
    <style>
        input.form-check-input {
            margin: 0 !important;
            position: relative;
        }

        .card-height {
            height: 66vh;
        }
    </style>
@endpush
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Campaign Quote</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Campaign Quote</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <div class="row">
        <div class="col col-lg-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <h6 class="mb-0 text-uppercase">Campaign Quote List</h6>
                        </div>
                        <div class="col-md-6">
                            <form id="campaignFilterForm" method="GET" action="{{ route('quote.index') }}">
                                <select name="campaign_id" id="campaign_id" class="form-select" onchange="document.getElementById('campaignFilterForm').submit();">
                                    @foreach ($allCampaigns as $camp)
                                        <option value="{{ $camp->id }}" {{ $campaign->id == $camp->id ? 'selected' : '' }}>
                                            {{ $camp->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col-md-3 text-end">
                            <a href="{{ strpos($_SERVER['REQUEST_URI'], '?') == true ? Illuminate\Support\Facades\Request::fullUrl() . '&print=1' : Illuminate\Support\Facades\Request::fullUrl() . '?print=1' }}"
                                class="btn btn-sm btn-light" target="_blank"><i class="bi bi-printer-fill"></i></a>
                            <a href="{{ strpos($_SERVER['REQUEST_URI'], '?') == true ? Illuminate\Support\Facades\Request::fullUrl() . '&csv=1' : Illuminate\Support\Facades\Request::fullUrl() . '?csv=1' }}"
                                class="btn btn-sm btn-success" target="_blank"><i class="bi bi-file-earmark-spreadsheet-fill"></i></a>
                            <button class="btn btn-sm btn-info disabled disableBtn" type="button" id="changeStatusBtn"
                                onclick="approveMultipleItemData('Quote Status', '{{ route('quote.multiple_status_change') }}', 'Change')">
                                <i class="bi bi-arrow-repeat"></i></button>
                            <button class="btn btn-sm btn-danger disabled disableBtn" type="button" id="deleteBtn"
                                onclick="approveMultipleItemData('Quote', '{{ route('quote.multiple_delete') }}', 'Delete')">
                                <i class="bi bi-trash"></i></button>

                        </div>
                    </div>

                </div>
                <div class="card-body card-height">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="campaign_quote-table">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="form-check-input select_all_data_ids bg-primary" name="select_all" />
                                    </th>
                                    <th>#</th>
                                    <th style="width: 10px; text-align:center">Action</th>
                                    <th>Date</th>
                                    @if (count($quotes) > 0)
                                        @php
                                            $firstData = json_decode($quotes[0]->form_data, true);
                                        @endphp

                                        @foreach (array_keys($firstData) as $field)
                                            <th>{{ ucfirst(str_replace('_', ' ', $field)) }}</th>
                                        @endforeach
                                    @endif
                                    <th>Status</th>
                                    <th>Registered At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quotes as $index => $quote)
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input data_ids bg-primary" value="{{ $quote->id }}" name="ids" /></td>
                                        <td>{{ $quote->id }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" onclick="deleteData('Quote', '{{ route('quote.delete') }}', {{ $quote->id }})"
                                                    class="btn btn-sm btn-outline-danger"><i class="lni lni-trash"></i></button>
                                            </div>
                                        </td>
                                        <td class="nowrap">{{ showDateFormat($quote->date) }}</td>
                                        @php
                                            $formData = json_decode($quote->form_data, true);
                                        @endphp

                                        @foreach ($formData as $value)
                                            <td>
                                                @if (is_array($value))
                                                    {{ implode(', ', $value) }}
                                                @elseif(is_null($value))
                                                    -
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        @endforeach
                                        <td>
                                            @if ($quote->status)
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ date('d M,Y h:i:A', strtotime($quote->created_at)) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">No quotes found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.select_all_data_ids', function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        function toggleDisableBtn() {
            const anyChecked = $('.data_ids:checked').length > 0;
            $('.disableBtn').toggleClass('disabled', !anyChecked).prop('disabled', !anyChecked);
        }

        $(document).on('change', '.data_ids, .select_all_data_ids', function() {
            toggleDisableBtn();
        });

        // Optional: also initialize button state on page load
        $(document).ready(function() {
            toggleDisableBtn();
        });
    </script>
@endpush
