<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie->title }}の上映スケジュール管理</title>
</head>

<body>
    <h2>{{ $movie->title }}の上映スケジュール管理</h2>

    <form method="GET">
        <button value="{{ $movie->id }}" name="movie_id">
            新規作成
        </button>
    </form>

    <br>

    @foreach ($movie->schedules as $schedule)
        <table border="1">
            <tr>
                <th>ID</th>
                <th>作品ID</th>
                <th>開始時刻</th>
                <th>終了時刻</th>
                <th>作成日時</th>
                <th>更新日時</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            <tr>
                <td>{{ $schedule->id }}</td>
                <td>{{ $schedule->movie_id }}</td>
                <td>{{ $schedule->start_time->format('h:m') }}</td>
                <td>{{ $schedule->end_time->format('h:m') }}</td>
                <td>{{ $schedule->created_at }}</td>
                <td>{{ $schedule->updated_at }}</td>
                <td>
                    <form method="GET">
                        <button value="{{ $movie->id }}" name="id">
                            編集
                        </button>
                    </form>
                </td>
                <td>
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button value="{{ $schedule->id }}" name="id" onclick="return articleDelete();"
                            formaction="{{ route('scheduleDestroy', $schedule->id) }}">
                            削除
                        </button>
                    </form>
            </tr>
        </table>
    @endforeach
</body>

<script>
    'use strict';
    const articleDelete = () => {
        var ret = confirm("削除を実行しますか？");
        return ret;
    }
</script>


</html>
