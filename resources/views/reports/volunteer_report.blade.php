<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Volunteer Activity Report</title>
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
        <h1>Volunteer Activity Report</h1>
        <p>Generated On: {{ date('F d, Y') }} — {{ date('F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Volunteer Name</th>
                <th>Sessions Attended</th>
                <th>Hours Contributed</th>
                <th>Tasks Completed</th>
            </tr>
        </thead>
        <tbody>
            @foreach($volunteers as $volunteer)
            <tr>
                <td><strong>{{ $volunteer->name ?? $volunteer->user->name ?? 'N/A' }}</strong></td>
                <td>{{ $volunteer->sessions_attended ?? 0 }}</td>
                <td>{{ $volunteer->hours_this_month ?? 0 }} hrs</td>
                <td>{{ $volunteer->tasks_completed ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>