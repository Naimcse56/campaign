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
                    <li class="breadcrumb-item active" aria-current="page">Campaign Form</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Campaign Details -->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('form.create', $campaign->id) }}" class="mb-0 text-uppercase">Create Campaign Form</a>
            <hr />
            <div class="card">
                <div class="card-body">
                    @if ($fields->isEmpty())
                        <h5>No Form created yet. Please Create a Form</h5>
                    @else
                        @foreach ($fields as $field)
                            <div class="mb-3">
                                <label>{{ $field->label }} @if ($field->required)
                                        <span style="color: red">*</span>
                                    @endif
                                </label>

                                @switch($field->type)
                                    @case('text')
                                    @case('email')

                                    @case('number')
                                    @case('date')
                                        <input type="{{ $field->type }}" name="{{ $field->name }}" class="form-control" value="{{ old($field->name) }}">
                                    @break

                                    @case('textarea')
                                        <textarea name="{{ $field->name }}" class="form-control">{{ old($field->name) }}</textarea>
                                    @break

                                    @case('select')
                                        <select name="{{ $field->name }}" class="form-select">
                                            <option value="">Select</option>
                                            @foreach ($field->options ?? [] as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    @break

                                    @case('radio')
                                        @foreach ($field->options ?? [] as $opt)
                                            <div><input type="radio" name="{{ $field->name }}" value="{{ $opt }}"> {{ $opt }}</div>
                                        @endforeach
                                    @break

                                    @case('checkbox')
                                        @foreach ($field->options ?? [] as $opt)
                                            <div><input type="checkbox" name="{{ $field->name }}[]" value="{{ $opt }}"> {{ $opt }}</div>
                                        @endforeach
                                    @break
                                @endswitch

                                @error($field->name)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Campaign Details -->
@endsection

@push('scripts')
    <!-- Add custom scripts here if needed -->
@endpush
