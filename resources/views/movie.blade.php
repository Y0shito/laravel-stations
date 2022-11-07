<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie->title }}</title>
</head>

<body>
    @if (session()->has('message'))
        <li>
            {{ session('message') }}
        </li>
    @endif

    <h2>{{ $movie->title }}</h2>
    <img src={{ $movie->image_url }} width="400">
    <p>ID：{{ $movie->id }}</p>
    <p>公開日：{{ $movie->published_year }}</p>
    <p>上映状況：{{ $movie->is_showing == true ? '上映中' : '上映予定' }}</p>
    <p>概要：{{ $movie->description }}</p>

    @foreach ($movie->schedules as $schedule)
        <table border="1">
            <tr>
                <th>開始日付</th>
                <th>開始時間</th>
                <th>終了時刻</th>
                <th>予約</th>
            </tr>
            <tr>
                <td>{{ $schedule->start_time->format('m/d') }}</td>
                <td>{{ $schedule->start_time->format('h:m') }}</td>
                <td>{{ $schedule->end_time->format('h:m') }}</td>
                <td>
                    <form
                        action="{{ route('reserveSheet', ['movie_id' => $movie->id, 'schedule_id' => $schedule->id]) }}">
                        <button name="date" value="{{ $schedule->start_time->format('Y-m-d') }}">座席を予約する</button>
                    </form>
                </td>
            </tr>
        </table>
    @endforeach

    <p>作成日：{{ $movie->created_at }}</p>
    <p>更新日：{{ $movie->updated_at }}</p>
</body>

</html>
