<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Print Page') }}</title>
    <link rel="icon" href="{{ asset('images/favicon-32x32.png') }}" type="image/png" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body,
            html {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .container {
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            table {
                width: 100% !important;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 6px !important;
                font-size: 12px;
            }

            @page {
                /*size: A4 portrait;*/
                size: A4 landscape;
                margin: 10mm;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ $campaign->title }} Quote List</h2>
            </div>
            <div class="col-md-12">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
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
                                    <td>{{ $quote->id }}</td>
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

        <script>
            window.onload = function() {
                window.print();
            }
        </script>
</body>

</html>
