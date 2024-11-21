<!DOCTYPE html>
<html>
<head>
    <title>予約リマインドメール</title>
</head>
<body>
    <p>{{ $reservation->user->name }}様</p>
    <p>以下の内容で予約されています：</p>
    <ul>
        <li>店名: {{ $reservation->shop->shop_name }}</li>
        <li>予約日時: {{ \Carbon\Carbon::parse($reservation->reserve_date . ' ' . $reservation->reserve_time)->locale('ja')->isoFormat('YYYY-MM-DD (ddd) H:mm') }}</li>
        {{-- <li>予約日時: {{ \Carbon\Carbon::parse($reservation->reserve_date)->locale('ja')->isoFormat('YYYY-MM-DD (dd)') }} {{ date('H:i',strtotime($reservation->reserve_time)) }}</li> --}}
        {{-- <li>予約日時: {{ $reservation->reserve_date }} {{ \Carbon\Carbon::createFromFormat('H:i:s', $reservation->reserve_time)->format('H:i') }}</li> --}}
        <li>人数: {{ $reservation->guest_count }}人</li>
    </ul>
    <p>お忘れなくお越しください。</p>
</body>
</html>
