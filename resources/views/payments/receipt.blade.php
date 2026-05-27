<!DOCTYPE html>
<html>
<head>
    <title>Check-out Receipt</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            padding:20px;
            font-size:14px;
        }

        .header{
            text-align:center;
            margin-bottom:30px;
        }

        .hotel{
            font-size:28px;
            font-weight:bold;
            color:#ff7b00;
        }

        .subtitle{
            font-size:16px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th, td{
            border:1px solid #ddd;
            padding:10px;
            text-align:left;
        }

        th{
            background:#ff9500;
            color:white;
            width:35%;
        }

        .amount{
            font-size:18px;
            font-weight:bold;
            color:#ff7b00;
        }

        .footer{
            margin-top:40px;
            text-align:center;
        }
    </style>
</head>

<body>

<div class="header">
    <div class="hotel">La Luna Hotel</div>
    <div class="subtitle">Official Check-out Receipt</div>
</div>

<table>

    <tr>
        <th>Guest Name</th>
        <td>
            {{ $payment->reservation->guest->first_name }}
            {{ $payment->reservation->guest->last_name }}
        </td>
    </tr>

    <tr>
        <th>Room Number</th>
        <td>{{ $payment->reservation->room->room_number }}</td>
    </tr>

    <tr>
        <th>Room Type</th>
        <td>{{ $payment->reservation->room->room_type }}</td>
    </tr>

    <tr>
        <th>Check In</th>
        <td>{{ $payment->reservation->check_in }}</td>
    </tr>

    <tr>
        <th>Check Out</th>
        <td>{{ $payment->reservation->check_out }}</td>
    </tr>

    <tr>
        <th>Duration Hours</th>
        <td>{{ $payment->reservation->duration_hours }}</td>
    </tr>

    <tr>
        <th>Price Per Hour</th>
        <td>₱{{ number_format($payment->reservation->price_per_hour,2) }}</td>
    </tr>

    <tr>
        <th>Total Amount</th>
        <td>₱{{ number_format($payment->reservation->total_amount,2) }}</td>
    </tr>

    <tr>
        <th>Extended Hours</th>
        <td>{{ $payment->reservation->extended_hours }}</td>
    </tr>

    <tr>
        <th>Extended Amount</th>
        <td>₱{{ number_format($payment->reservation->extended_amount,2) }}</td>
    </tr>

    <tr>
        <th>Final Amount Paid</th>
        <td class="amount">
            ₱{{ number_format($payment->amount,2) }}
        </td>
    </tr>

    <tr>
        <th>Payment Method</th>
        <td>{{ $payment->payment_method }}</td>
    </tr>

    <tr>
        <th>Reference Number</th>
        <td>{{ $payment->reference_number }}</td>
    </tr>

    <tr>
        <th>Payment Status</th>
        <td>{{ ucfirst($payment->status) }}</td>
    </tr>
        <th>Payment Date</th>
        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y h:i A') }}</td>
    <tr>

</table>

<div class="footer">
    Thank you for staying at La Luna Hotel.
</div>

</body>
</html>