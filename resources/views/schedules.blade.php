<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schedules</title>
</head>

<body>
    <h2>映画上映スケジュール一覧</h2>

    @foreach ($movies as $movie)
        <h2>ID：{{ $movie->id }} {{ $movie->title }}</h2>
        @foreach ($movie->schedules as $schedule)
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>作品ID</th>
                    <th>開始時刻</th>
                    <th>終了時刻</th>
                    <th>作成日時</th>
                    <th>更新日時</th>
                </tr>
                <tr>
                    <td>{{ $schedule->id }}</td>
                    <td>{{ $schedule->movie_id }}</td>
                    <td>{{ $schedule->start_time->format('h:m') }}</td>
                    <td>{{ $schedule->end_time->format('h:m') }}</td>
                    <td>{{ $schedule->created_at }}</td>
                    <td>{{ $schedule->updated_at }}</td>
                </tr>
            </table>
            <br>
        @endforeach
    @endforeach
</body>


</html>
