<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Emergency Incidents Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #8B0000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #8B0000;
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
            background-color: #8B0000;
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

        .badge-severity {
            background-color: #ffe4e6;
            color: #9f1239;
            padding: 3px 6px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Emergency Incidents Report</h1>
        <p>Generated On: {{ date('F d, Y') }} — {{ date('F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Emergency Type</th>
                <th>Severity Level</th>
                <th>Resident ID</th>
                <th>Description</th>
                <th>Incident Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incidents as $incident)
            <tr>
                <td><strong>{{ $incident->emergency_type }}</strong></td>
                <td>
                    <span class="badge-severity">{{ $incident->severity_level }}</span>
                </td>
                <td>{{ $incident->resident_id ?? 'N/A' }}</td>
                <td>{{ $incident->description ?? 'N/A' }}</td>
                <td>
                    @if($incident->incident_time)
                    {{ \Carbon\Carbon::parse($incident->incident_time)->format('d M, Y h:i A') }}
                    @else
                    N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>