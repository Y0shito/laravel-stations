<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約一覧</title>
</head>

<body>
    <h2>予約一覧</h2>
    <a href="">予約の新規作成</a>
    <table border="1">
        <tr>
            <th>予約ID</th>
            <th>作品名</th>
            <th>座席</th>
            <th>日時</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>編集</th>
        </tr>
        @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->schedule->movie->title }}</td>
                <td>{{ strtoupper($reservation->sheet->row . $reservation->sheet->column) }}</td>
                <td>{{ $reservation->date }}</td>
                <td>{{ $reservation->name }}</td>
                <td>{{ $reservation->email }}</td>
                <td>
                    <form method="GET">
                        <button formaction="">
                            編集
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
