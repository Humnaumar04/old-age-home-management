<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Donation & Funding Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #14434C;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #14434C;
            margin: 0;
            font-size: 20px;
        }

        .header p {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #14434C;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        td {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Donation & Funding Report</h1>
        <p>Generated On: {{ date('F d, Y') }} — {{ date('F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Donation Type</th>
                <th>Item / Details</th>
                <th>Payment Method</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
            <tr>
                <td>{{ $donation->donation_type }}</td>
                <td>{{ $donation->item_name ?? 'N/A' }}</td>
                <td>{{ $donation->payment_method ?? 'N/A' }}</td>
                <td>Rs. {{ number_format($donation->amount ?? 0) }}</td>
                <td>{{ $donation->created_at ? $donation->created_at->format('d M, Y') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>