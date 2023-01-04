<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/schedule_manage.css') }}">
    <title>{{ $movie->title }}の上映スケジュール管理</title>
</head>

<body>
    @include('components.header', ['title' => "{$movie->title}/上映スケジュール"])

    <h2>{{ $movie->title }}</h2>
    <img src={{ $movie->image_url }} width="400">

    <table border="1">
        <tr>
            <th>ID</th>
            <th>スクリーン</th>
            <th>開始時刻</th>
            <th>終了時刻</th>
            <th>作成日時</th>
            <th>更新日時</th>
        </tr>
        @foreach ($movie->schedules as $schedule)
            <tr>
                <td>{{ $schedule->id }}</td>
                <td>{{ $schedule->screen_no }}</td>
                <td>{{ $schedule->start_time }}</td>
                <td>{{ $schedule->end_time }}</td>
                <td>{{ $schedule->created_at }}</td>
                <td>{{ $schedule->updated_at }}</td>
                <td>
                    <form method="GET">
                        <button formaction="{{ route('scheduleEdit', $schedule->id) }}">
                            編集
                        </button>
                    </form>
                </td>
                <td>
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return articleDelete();"
                            formaction="{{ route('scheduleDestroy', $schedule->id) }}">
                            削除
                        </button>
                    </form>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('scheduleCreate', $movie->id) }}">{{ $movie->title }}の上映スケジュール新規作成</a>
</body>

<script>
    'use strict';
    const articleDelete = () => {
        var ret = confirm("削除を実行しますか？");
        return ret;
    }
</script>


</html>
