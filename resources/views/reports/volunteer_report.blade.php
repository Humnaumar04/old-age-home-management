<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Volunteer Activity Report</title>
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

        .text-bold {
            font-weight: bold;
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
        <h1>Monthly Volunteer Activity Report</h1>
        <p><strong>Report Period:</strong> {{ date('F Y') }}</p>
    </div>

    <!-- SUMMARY SECTION -->
    <table class="summary-box">
        <tr>
            <td><strong>Total Volunteers:</strong> {{ $totalVolunteers ?? $volunteers->count() }}</td>
            <td><strong>Total Hours Contributed:</strong> <span style="color: #D1884F; font-weight: bold;">{{ $totalHours ?? $volunteers->sum('hours_this_month') }} hrs</span></td>
            <td style="text-align: right;"><strong>Total Tasks Completed:</strong> <span style="color: #14434C; font-weight: bold;">{{ $totalTasks ?? $volunteers->sum('tasks_completed') }}</span></td>
        </tr>
    </table>

    <!-- MAIN DATA TABLE -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 8%;">Sr. No.</th>
                <th style="width: 32%;">Volunteer Name</th>
                <th style="width: 20%;">Sessions Attended</th>
                <th style="width: 20%;">Hours Contributed</th>
                <th style="width: 20%;">Tasks Completed</th>
            </tr>
        </thead>
        <tbody>
            @forelse($volunteers as $index => $volunteer)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong style="color: #14434C;">{{ ucwords(strtolower($volunteer->name ?? $volunteer->user->name ?? 'N/A')) }}</strong></td>
                <td>{{ $volunteer->sessions_attended ?? 0 }}</td>
                <td><strong>{{ $volunteer->hours_this_month ?? $volunteer->hours_contributed ?? 0 }} hrs</strong></td>
                <td>{{ $volunteer->tasks_completed ?? 0 }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #888; padding: 15px;">No volunteer records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Confidential System Generated Report — Old Age Home Management System | Generated On: {{ date('F d, Y') }}
    </div>
</body>

</html>