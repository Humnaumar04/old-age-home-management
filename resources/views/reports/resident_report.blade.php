<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Resident Health & Activity Report</title>
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

        .badge-critical {
            color: #DC2626;
            background-color: #FEE2E2;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        .badge-stable {
            color: #059669;
            background-color: #D1FAE5;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        .badge-recovering {
            color: #D97706;
            background-color: #FEF3C7;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Monthly Resident Health Report</h1>
        <p><strong>Report Period:</strong> {{ date('F Y') }}</p>
    </div>

    <!-- SUMMARY SECTION -->
    <table class="summary-box">
        <tr>
            <td><strong>Total Active Residents:</strong> {{ $totalResidents ?? $residents->count() }}</td>
            <td style="text-align: right;"><strong>Critical Attention Needed:</strong> <span style="color: #DC2626; font-weight: bold;">{{ $criticalCount ?? 0 }} Resident(s)</span></td>
        </tr>
    </table>

    <!-- MAIN DATA TABLE -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 8%;">Sr. No.</th>
                <th style="width: 32%;">Resident Name</th>
                <th style="width: 20%;">Room Number</th>
                <th style="width: 20%;">Medical Condition</th>
                <th style="width: 20%;">Care Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($residents as $index => $resident)
            @php
            $cond = $resident->medical_condition ?? 'Stable';
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ ucwords(strtolower($resident->name)) }}</strong></td>
                <td>{{ $resident->room_number ?? 'N/A' }}</td>
                <td>
                    @if(strtolower($cond) == 'critical')
                    <span class="badge-critical">Critical Attention</span>
                    @elseif(strtolower($cond) == 'recovering')
                    <span class="badge-recovering">Recovering</span>
                    @else
                    <span class="badge-stable">Stable Condition</span>
                    @endif
                </td>
                <td>
                    <span style="color: #059669; font-weight: bold;">Active Resident</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #888; padding: 15px;">No resident records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Confidential System Generated Report — Old Age Home Management System | Generated On: {{ date('F d, Y') }}
    </div>
</body>

</html>