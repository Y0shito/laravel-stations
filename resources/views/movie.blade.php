<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
    <title>{{ $movie->title }}</title>
</head>

<body>
    <header>
        <p><a href="{{ route('index') }}">StationMovies</a></p>
    </header>

    @if (session()->has('message'))
        <li>
            {{ session('message') }}
        </li>
    @endif

    <h2>{{ $movie->title }}</h2>
    <img src={{ $movie->image_url }} width="400">
    <p>上映状況：{{ $movie->is_showing == true ? '上映中' : '上映予定' }}</p>
    <p>公開年：{{ $movie->published_year }}</p>
    <p>概要：{{ $movie->description }}</p>

    <table border="1">
        <tr>
            <th>公開日</th>
            <th>開始時間</th>
            <th>終了時刻</th>
            <th>予約</th>
        </tr>
        @foreach ($movie->schedules as $schedule)
            <tr>
                <td>{{ $schedule->start_time->format('m/d') }}</td>
                <td>{{ $schedule->start_time->format('h:i') }}</td>
                <td>{{ $schedule->end_time->format('h:i') }}</td>
                <td>
                    <form
                        action="{{ route('reserveSheet', ['movie_id' => $movie->id, 'schedule_id' => $schedule->id]) }}">
                        <button name="screening_date"
                            value="{{ $schedule->start_time->format('Y-m-d') }}">座席を予約する</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
