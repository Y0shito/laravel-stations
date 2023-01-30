<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/admin_reservations.css') }}">
    <title>予約一覧</title>
</head>

<body>
    @include('components.header', ['title' => '予約一覧'])

    @if (session('message'))
        {{ session('message') }}
    @endif

    <br>
    <form class="reservation-form" action="{{ route('valueToReservationCreate') }}">
        @csrf
        <select name="schedule_id">
            @foreach ($schedules as $item)
                <option value="{{ $item->id }}">
                    {{ "ID:{$item->id}「{$item->movie->title}」スクリーン{$item->screen_no}/{$item->start_time->format('Y-m-d H:i')}" }}
                </option>
            @endforeach
        </select>
        <button>このスケジュールで予約作成</button>
    </form>

    <table border="1">
        <tr>
            <th>予約ID</th>
            <th>作品名</th>
            <th>上映スクリーン</th>
            <th>座席</th>
            <th>日時</th>
            <th>名前</th>
            <th>メールアドレス</th>
        </tr>
        @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->schedule->movie->title }}</td>
                <td>{{ $reservation->schedule->screen_no }}</td>
                <td>{{ strtoupper($reservation->sheet->row . $reservation->sheet->column) }}</td>
                <td>{{ $reservation->screening_date->format('Y-m-d') }}</td>
                <td>{{ $reservation->name }}</td>
                <td>{{ $reservation->email }}</td>
                <td>
                    <form method="GET">
                        <button formaction="{{ route('adminReservationsPreEdit', ['id' => $reservation->id]) }}">
                            編集
                        </button>
                    </form>
                </td>
                <td>
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return ReservationDelete();"
                            formaction="{{ route('ReservationDelete', ['id' => $reservation->id]) }}">
                            削除
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>

<script>
    'use strict';
    const ReservationDelete = () => {
        var ret = confirm("削除を実行しますか？");
        return ret;
    }
</script>

</html>
