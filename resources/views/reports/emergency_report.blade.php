<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Emergency Incidents Report</title>
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
            border-bottom: 2px solid #8B0000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #8B0000;
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
            background-color: #FFF5F5;
            border: 1px solid #FEB2B2;
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
            background-color: #8B0000;
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

        .badge-high {
            color: #7F1D1D;
            background-color: #FEE2E2;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        .badge-medium {
            color: #92400E;
            background-color: #FEF3C7;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        .badge-low {
            color: #065F46;
            background-color: #D1FAE5;
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
        <h1>Emergency Incidents Report</h1>
        <p><strong>Report Log:</strong> All Recorded Emergency Events</p>
    </div>

    <!-- SUMMARY SECTION -->
    <table class="summary-box">
        <tr>
            <td><strong>Total Recorded Incidents:</strong> {{ $totalIncidents ?? $incidents->count() }}</td>
            <td style="text-align: right;"><strong>Critical / High Alerts:</strong> <span style="color: #991B1B; font-weight: bold;">{{ $criticalCount ?? 0 }} Case(s)</span></td>
        </tr>
    </table>

    <!-- MAIN DATA TABLE -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 22%;">Emergency Type</th>
                <th style="width: 15%;">Severity</th>
                <th style="width: 25%;">Resident</th>
                <th style="width: 20%;">Description</th>
                <th style="width: 18%;">Incident Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($incidents as $incident)
            @php
            $type = $incident->emergency_type ?? 'Incident';
            $severity = strtolower($incident->severity_level ?? 'medium');

            // Cardiac arrest ko auto-override karke High Severity karna
            if(strtolower($type) == 'cardiac arrest') {
            $severity = 'high';
            }
            @endphp
            <tr>
                <td><strong style="color: #991B1B;">{{ ucwords($type) }}</strong></td>
                <td>
                    @if($severity == 'high' || $severity == 'critical')
                    <span class="badge-high">High / Critical</span>
                    @elseif($severity == 'medium')
                    <span class="badge-medium">Medium</span>
                    @else
                    <span class="badge-low">Low</span>
                    @endif
                </td>
                <td>
                    <strong>{{ ucwords(strtolower($incident->resident->name ?? 'Resident #' . $incident->resident_id)) }}</strong>
                    @if(isset($incident->resident->room_number))
                    <br><span style="font-size: 9px; color: #666;">Room: {{ $incident->resident->room_number }}</span>
                    @endif
                </td>
                <td>{{ $incident->description ? ucfirst($incident->description) : 'N/A' }}</td>
                <td>{{ $incident->created_at ? $incident->created_at->format('d M, Y h:i A') : ($incident->incident_time ?? 'N/A') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #888; padding: 15px;">No emergency incidents recorded.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Confidential System Generated Report — Old Age Home Management System | Generated On: {{ date('F d, Y') }}
    </div>
</body>

</html>