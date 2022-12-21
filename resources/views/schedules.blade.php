<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/schedules.css') }}">
    <title>スケジュール一覧</title>
</head>

<body>
    <header>
        <p><a href="{{ route('adminMovies') }}">StationMovies/管理者画面/スケジュール一覧</a></p>
        <nav>
            <ul>
                <li><a href="{{ route('showCreate') }}">映画新規入力</a></li>
                <li><a href="{{ route('schedules') }}">スケジュール一覧</a></li>
            </ul>
        </nav>
    </header>

    @foreach ($movies as $movie)
        <h4>
            <a href="{{ route('adminMovieId', ['id' => $movie->id]) }}">
                ID:{{ $movie->id }} {{ $movie->title }}
            </a>
        </h4>
        <img src={{ $movie->image_url }} width="100">

        <table border="1">
            <tr>
                <th>ID</th>
                <th>作品ID</th>
                <th>開始時刻</th>
                <th>終了時刻</th>
                <th>作成日時</th>
                <th>更新日時</th>
            </tr>
            @foreach ($movie->schedules as $schedule)
                <tr>
                    <td>{{ $schedule->id }}</td>
                    <td>{{ $schedule->movie_id }}</td>
                    <td>{{ $schedule->start_time->format('h:m') }}</td>
                    <td>{{ $schedule->end_time->format('h:m') }}</td>
                    <td>{{ $schedule->created_at }}</td>
                    <td>{{ $schedule->updated_at }}</td>
                </tr>
            @endforeach
        </table>
        <a href="{{ route('scheduleManage', ['id' => $schedule->movie_id]) }}">
            <p>「{{ $movie->title }}」のスケジュール管理へ</p>
        </a>
        <br>
    @endforeach
</body>


</html>
