<!DOCTYPE html>
<html>
<head>
    <title>Check-in Receipt</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 20px;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .hotel {
            font-size: 28px;
            font-weight: bold;
            color: #ff7b00;
        }

        .subtitle {
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #ff9500;
            color: white;
            width: 35%;
        }

        .amount {
            font-size: 18px;
            font-weight: bold;
            color: #ff7b00;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="header">
    <div class="hotel">La Luna Hotel</div>
    <div class="subtitle">Official Check-in Receipt</div>
</div>

<table>

    <tr>
        <th>Guest Name</th>
        <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
    </tr>

    <tr>
        <th>Room</th>
        <td>
            Room {{ $reservation->room->room_number }}
            - {{ $reservation->room->room_type }}
        </td>
    </tr>

    <tr>
        <th>Check In</th>
        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y h:i A') }}</td>
    </tr>

    <tr>
        <th>Check Out</th>
        <td>
            {{ $reservation->check_out
                ? \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y h:i A')
                : 'N/A'
            }}
        </td>
    </tr>

    <tr>
        <th>Duration Hours</th>
        <td>{{ $reservation->duration_hours }} hour(s)</td>
    </tr>

    <tr>
        <th>Price Per Hour</th>
        <td>PHP {{ number_format($reservation->price_per_hour, 2) }}</td>
    </tr>

    <tr>
        <th>Base Amount</th>
        <td>PHP {{ number_format($reservation->total_amount, 2) }}</td>
    </tr>

    <tr>
        <th>Extended Time</th>
        <td>{{ number_format($reservation->extended_hours, 2) }} hour(s)</td>
    </tr>

    <tr>
        <th>Additional Cost</th>
        <td>PHP {{ number_format($reservation->extended_amount, 2) }}</td>
    </tr>

    <tr>
        <th>Estimated / Final Amount</th>
        <td class="amount">
            PHP {{ number_format($reservation->final_amount, 2) }}
        </td>
    </tr>

    <tr>
        <th>Status</th>
        <td>{{ ucfirst(str_replace('_', ' ', $reservation->status)) }}</td>
    </tr>

</table>

<div class="footer">
    Thank you for choosing La Luna Hotel!<br>
    We hope you have a pleasant stay.
</div>

</body>
</html>