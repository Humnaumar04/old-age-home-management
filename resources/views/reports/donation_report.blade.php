<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Donation & Funding Report</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #14434C;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #14434C;
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header p {
            color: #555;
            font-size: 11px;
            margin-top: 6px;
        }

        .summary-box {
            width: 100%;
            margin-bottom: 20px;
            background-color: #F8F6F0;
            border: 1px solid #E2DED0;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .summary-box td {
            border: none;
            padding: 4px;
            font-size: 11px;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data-table th {
            background-color: #14434C;
            color: white;
            padding: 8px 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }

        table.data-table td {
            border: 1px solid #E0E0E0;
            padding: 8px 10px;
            font-size: 11px;
        }

        table.data-table tr:nth-child(even) {
            background-color: #F9F9F9;
        }

        .badge-inkind {
            color: #D1884F;
            font-weight: bold;
            background-color: #FFF2E6;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
        }

        .text-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Monthly Donation & Funding Report</h1>
        <p><strong>Report Period:</strong> {{ $startDate ?? 'Current Month' }} — {{ $endDate ?? date('F d, Y') }}</p>
        <p style="font-size: 10px; color: #888;">Generated On: {{ date('F d, Y') }}</p>
    </div>

    <!-- SUMMARY SECTION -->
    <table class="summary-box">
        <tr>
            <td><strong>Total Monthly Donations:</strong> {{ $donations->count() }} Record(s)</td>
            <td style="text-align: right;"><strong>Total Cash Raised:</strong> <span style="color: #14434C; font-size: 13px;">Rs. {{ number_format($totalMoneyDonations ?? $donations->where('donation_type', 'Money')->sum('amount')) }}</span></td>
        </tr>
    </table>

    <!-- MAIN REPORT TABLE -->
    <table class="data-table">
        <thead>
            <tr>
                <th>Donation Category</th>
                <th>Description / Item</th>
                <th>Mode / Method</th>
                <th>Value / Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donations as $donation)
            @php
            $isMoney = strtolower($donation->donation_type ?? '') == 'money' || ($donation->amount ?? 0) > 0;
            $itemName = $donation->item_name ?? $donation->item_details ?? null;
            @endphp
            <tr>
                <td class="text-bold">{{ ucfirst($donation->donation_type ?? 'General') }}</td>
                <td>
                    @if($isMoney)
                    <span style="color: #666;">Monetary Contribution</span>
                    @else
                    <strong>{{ ucwords(strtolower($itemName ?? 'In-Kind Goods')) }}</strong>
                    @endif
                </td>
                <td>
                    @if($isMoney)
                    {{ $donation->payment_method ? ucwords($donation->payment_method) : 'Cash / Transfer' }}
                    @else
                    <span style="color: #666;">Physical Delivery</span>
                    @endif
                </td>
                <td>
                    @if($isMoney)
                    <strong>Rs. {{ number_format($donation->amount ?? 0) }}</strong>
                    @else
                    <span class="badge-inkind">In-Kind Item</span>
                    @endif
                </td>
                <td>{{ $donation->created_at ? $donation->created_at->format('d M, Y') : date('d M, Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #888; padding: 15px;">No donation records found for the current month.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>