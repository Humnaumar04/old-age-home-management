<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Monthly Resident Report</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #14434C;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h1 {
            color: #14434C;
            margin: 0;
            font-size: 22px;
        }

        .header p {
            color: #666;
            margin: 5px 0 0;
            font-size: 12px;
        }

        .meta-info {
            margin-bottom: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #14434C;
            color: white;
            font-size: 12px;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td {
            font-size: 12px;
        }

        .badge-critical {
            background-color: #ffe4e6;
            color: #9f1239;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        .badge-stable {
            background-color: #d1fae5;
            color: #065f46;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <div class="header">
        <h1>Old Age Home Management System</h1>
        <p>Monthly Resident Health & Activity Report — {{ date('F Y') }}</p>
    </div>

    <!-- Generated Date -->
    <div class="meta-info">
        <strong>Generated On:</strong> {{ date('F d, Y') }}
        <strong>Total Residents:</strong> {{ $residents->count() }}
    </div>

    <!-- Table Data -->
    <table>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Resident Name</th>
                <th>Room Number</th>
                <th>Medical Condition</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($residents as $index => $resident)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $resident->name }}</strong></td>
                <td>{{ $resident->room_number ?? 'A-101' }}</td>
                <td>{{ $resident->medical_condition ?? 'Stable' }}</td>
                <td>
                    @if(($resident->medical_condition ?? '') == 'Critical')
                    <span class="badge-critical">Critical</span>
                    @else
                    <span class="badge-stable">Stable / Recovering</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Confidential System Generated Report — Old Age Home Management System</p>
    </div>

</body>

</html>