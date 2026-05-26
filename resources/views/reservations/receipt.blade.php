<!DOCTYPE html>
<html>
<head>
    <title>Check-in Receipt</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 25px; }
        h1 { color: #ff7b00; margin-bottom: 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #ff9500; color: white; }
    </style>
</head>
<body>

<div class="header">
    <h1>La Luna Hotel</h1>
    <p>Check-in Receipt</p>
</div>

<table>
    <tr>
        <th>Guest</th>
        <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
    </tr>
    <tr>
        <th>Room</th>
        <td>{{ $reservation->room->room_number }} - {{ $reservation->room->room_type }}</td>
    </tr>
    <tr>
        <th>Check In</th>
        <td>{{ $reservation->check_in }}</td>
    </tr>
    <tr>
        <th>Expected Check Out</th>
        <td>{{ $reservation->check_out ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Total Amount</th>
        <td>PHP {{ number_format($reservation->total_amount, 2) }}</td>
    </tr>
    <tr>
        <th>Extended Amount</th>
        <td>PHP {{ number_format($reservation->extended_amount, 2) }}</td>
    </tr>
    <tr>
        <th>Final Amount</th>
        <td><strong>PHP {{ number_format($reservation->final_amount, 2) }}</strong></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ ucfirst(str_replace('_', ' ', $reservation->status)) }}</td>
    </tr>
</table>

<p style="text-align:center; margin-top:30px;">
    Thank you for choosing La Luna Hotel.
</p>

</body>
</html>