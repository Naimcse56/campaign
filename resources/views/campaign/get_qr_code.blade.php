</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Campaign QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }

        .qr-section {
            margin-bottom: 40px;
        }

        .qr-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .qr-code {
            border: 1px solid #dee2e6;
            padding: 10px;
            width: fit-content;
            text-align: center;
        }

        .qr-code p {
            margin: 4px 0;
        }

        .print-button {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container py-4">

        {{-- Header Section (No Print) --}}
        <div class="no-print mb-4 text-center">
            <h2>{{ $campaign->title }} QR Code</h2>
            <button class="btn btn-light print-button" onclick="window.print()">
                🖨️ Print QR
            </button>
        </div>
        @php
            // $encryptedShopId = Crypt::encrypt($campaign->shop_id);
            // $qrString = route('campaign') . '?shopId=' . urlencode($encryptedShopId);
            $qrString = route('campaign') . '?shop=' . urlencode($campaign->shop->slug);
        @endphp
        <div class="qr-section text-center">
            <h4 class="mb-2">QR Code</h4>
            <div class="qr-grid">
                <div class="qr-code">
                    {!! QrCode::size(200)->generate($qrString) !!}
                    <p class="fw-bold">Shop: {{ $campaign->shop->slug }}</p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
