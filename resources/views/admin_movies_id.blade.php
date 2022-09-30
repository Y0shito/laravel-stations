<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie->title }}</title>
</head>

<body>
    <h2>映画個別管理画面</h2>
    <h2>{{ $movie->title }}</h2>
    <img src={{ $movie->image_url }} width="400">
    <p>ID：{{ $movie->id }}</p>
    <p>公開日：{{ $movie->published_year }}</p>
    <p>上映状況：{{ $movie->is_showing == true ? '上映中' : '上映予定' }}</p>
    <p>概要：{{ $movie->description }}</p>

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
        <a href="{{ route('scheduleManage', ['id' => $schedule->movie_id]) }}">
            <p>「{{ $movie->title }}」のスケジュール管理へ</p>
        </a>
    @endforeach

    <p>作成日：{{ $movie->created_at }}</p>
    <p>更新日：{{ $movie->updated_at }}</p>
</body>

</html>
