<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/admin_movies_id.css') }}">
    <title>管理者画面/{{ $movie->title }}</title>
</head>

<body>
    <header>
        <p><a href="{{ route('adminMovies') }}">StationMovies/管理者画面/映画一覧/{{ $movie->title }}</a></p>
        <nav>
            <ul>
                <li><a href="{{ route('showCreate') }}">映画新規入力</a></li>
                <li><a href="{{ route('schedules') }}">スケジュール一覧</a></li>
            </ul>
        </nav>
    </header>

    <h2>{{ $movie->title }}</h2>
    <img src={{ $movie->image_url }} width="400">
    <p>ID：{{ $movie->id }}</p>
    <p>公開年：{{ $movie->published_year }}</p>
    <p>公開状況：{{ $movie->is_showing == true ? '上映中' : '上映予定' }}</p>
    <p>概要：{{ $movie->description }}</p>
    <p>作成日：{{ $movie->created_at }}</p>
    <p>更新日：{{ $movie->updated_at }}</p>

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
                <td>{{ $schedule->start_time }}</td>
                <td>{{ $schedule->end_time }}</td>
                <td>{{ $schedule->created_at }}</td>
                <td>{{ $schedule->updated_at }}</td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('scheduleManage', ['id' => $schedule->movie_id]) }}">
        <p>「{{ $movie->title }}」のスケジュール管理へ</p>
    </a>
    <a href="{{ route('edit', ['id' => $schedule->movie_id]) }}">
        <p>「{{ $movie->title }}」の内容編集へ</p>
    </a>
</body>

</html>
