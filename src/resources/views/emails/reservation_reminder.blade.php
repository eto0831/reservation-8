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
        <li>予約日時: {{ $reservation->reserve_date }}</li>
        <li>人数: {{ $reservation->guest_count }}人</li>
    </ul>
    <p>お忘れなくお越しください。</p>
</body>
</html>
