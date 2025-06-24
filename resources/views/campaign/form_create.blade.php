@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <style>
        .cursor-move {
            cursor: move;
        }

        .sortable-placeholder {
            background-color: #f0f0f0;
            border: 2px dashed #ccc;
            height: 80px;
            margin-bottom: 1rem;
        }
    </style>
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
                    <li class="breadcrumb-item active" aria-current="page">Campaign Form Create</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Campaign Details -->
    <div class="row">
        <div class="col-12">
            <h6 class="mb-0 text-uppercase">Campaign Form Create</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                   <form method="POST" action="{{ route('form_fields.save', $campaign->id) }}">
                        @csrf
                        <div id="field-builder" class="sortable-fields">
                            @foreach ($fields as $index => $field)
                                <div class="border p-3 mb-3 field-item" id="field-{{ $index }}">
                                    <div class="row">
                                        <div class="col-md-1 text-center align-self-center cursor-move">
                                            <i class="bi bi-arrows-move fs-4"></i>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Type</label>
                                            <select name="fields[{{ $index }}][type]" class="form-control field-type" data-id="{{ $index }}">
                                                @foreach (['text', 'textarea', 'select', 'radio', 'checkbox', 'email', 'number', 'date'] as $type)
                                                    <option value="{{ $type }}" {{ $field->type === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Label</label>
                                            <input type="text" name="fields[{{ $index }}][label]" class="form-control" value="{{ $field->label }}" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Name</label>
                                            <input type="text" name="fields[{{ $index }}][name]" class="form-control" value="{{ $field->name }}" required>
                                        </div>
                                        <div class="col-md-1">
                                            <label>Required</label>
                                            <input type="checkbox" name="fields[{{ $index }}][required]" value="1" {{ $field->required ? 'checked' : '' }}>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger mt-4 remove-field" data-id="{{ $index }}">X</button>
                                        </div>

                                        <div class="col-12 mt-2 options-group row" id="options-{{ $index }}"
                                            style="{{ in_array($field->type, ['select', 'radio', 'checkbox']) ? '' : 'display:none;' }}">
                                            <div class="offset-md-1 col-md-10">
                                                <label>Options</label>
                                                <input type="text" name="fields[{{ $index }}][options]" class="form-control tag-input" id="tag-input-{{ $index }}"
                                                    value='{{ json_encode($field->options) }}' placeholder="Type options and press Enter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-success" id="add-field">Add Field</button>
                        <button type="submit" class="btn btn-primary">{{ $fields->isEmpty() ? 'Save Form' : 'Update Form' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Campaign Details -->
@endsection

@push('scripts')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        let fieldCount = {{ $fields->count() }};

        // Initialize Tagify on existing inputs
        $(document).ready(function() {
            $('.tag-input').each(function() {
                new Tagify(this, {
                    delimiters: ",",
                    dropdown: {
                        enabled: 0
                    }
                });
            });
        });

        // Add new field
        $('#add-field').click(function() {
            fieldCount++;

            const fieldHTML = `
            <div class="border p-3 mb-3 field-item" id="field-${fieldCount}">
                <div class="row">
                    <div class="col-md-1 text-center align-self-center cursor-move">
                        <i class="bi bi-arrows-move fs-4"></i>
                    </div>
                    <div class="col-md-3">
                        <label>Type</label>
                        <select name="fields[${fieldCount}][type]" class="form-control field-type" data-id="${fieldCount}">
                            <option value="text">Text</option>
                            <option value="textarea">Textarea</option>
                            <option value="select">Select</option>
                            <option value="radio">Radio</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="email">Email</option>
                            <option value="number">Number</option>
                            <option value="date">Date</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Label</label>
                        <input type="text" name="fields[${fieldCount}][label]" class="form-control field-label" required>
                    </div>
                    <div class="col-md-3">
                        <label>Name</label>
                        <input type="text" name="fields[${fieldCount}][name]" class="form-control field-name" required>
                    </div>
                    <div class="col-md-1">
                        <label>Required</label>
                        <input type="checkbox" name="fields[${fieldCount}][required]" value="1">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger mt-4 remove-field" data-id="${fieldCount}">X</button>
                    </div>
                    <div class="col-12 mt-2 options-group row" id="options-${fieldCount}" style="display:none;">
                        <div class="offset-md-1 col-md-10">
                            <label>Options (comma separated)</label>
                            <input type="text" name="fields[${fieldCount}][options]" class="form-control tag-input" id="tag-input-${fieldCount}" placeholder="Type options and press Enter">
                        </div>
                    </div>
                </div>
            </div>
        `;

            $('#field-builder').append(fieldHTML);

            // Apply Tagify to new input
            const newTagInput = document.getElementById(`tag-input-${fieldCount}`);
            if (newTagInput) {
                new Tagify(newTagInput, {
                    delimiters: ",",
                    dropdown: {
                        enabled: 0
                    }
                });
            }
        });

        // Show/hide options based on type
        $(document).on('change', '.field-type', function() {
            const id = $(this).data('id');
            const type = $(this).val();
            const optionGroup = $(`#options-${id}`);
            type === 'select' || type === 'radio' || type === 'checkbox' ?
                optionGroup.show() :
                optionGroup.hide();
        });

        // Remove field
        $(document).on('click', '.remove-field', function() {
            const id = $(this).data('id');
            $(`#field-${id}`).remove();
        });

        // Auto-generate name slug from label
        $(document).on('input', '.field-label', function() {
            const label = $(this).val();
            const index = $(this).attr('name')?.match(/\d+/)?.[0];
            if (!index) return;

            const slug = label
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '_')
                .replace(/^_+|_+$/g, '');

            $(`input[name="fields[${index}][name]"]`).val(slug);
        });

        // Enable sortable drag-and-drop
        $('#field-builder').sortable({
            handle: '.cursor-move',
            placeholder: 'sortable-placeholder'
        });

        // Handle form submit
        $('form').on('submit', function() {
            // Reorder all fields' names
            $('#field-builder .field-item').each(function(index) {
                $(this)
                    .find(':input')
                    .each(function() {
                        const name = $(this).attr('name');
                        if (name) {
                            const updated = name.replace(/fields\[\d+]/, `fields[${index}]`);
                            $(this).attr('name', updated);
                        }
                    });
            });

            // Convert tagify objects to clean JSON arrays
            $('.tag-input').each(function() {
                const tagifyInstance = $(this).data('tagify');
                if (tagifyInstance) {
                    const values = tagifyInstance.value.map(tag => tag.value);
                    $(this).val(JSON.stringify(values));
                }
            });
        });
    </script>
@endpush
