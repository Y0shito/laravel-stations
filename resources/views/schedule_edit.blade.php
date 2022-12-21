<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/schedule_manage.css') }}">
    <title>スケジュール編集</title>
</head>

<body>
    <header>
        <p><a href="{{ route('adminMovies') }}">StationMovies/管理者画面/{{ $schedule->movie->title }}/スケジュール編集</a></p>
        <nav>
            <ul>
                <li><a href="{{ route('showCreate') }}">映画新規入力</a></li>
                <li><a href="{{ route('schedules') }}">スケジュール一覧</a></li>
            </ul>
        </nav>
    </header>

    <h2>{{ $schedule->movie->title }}</h2>
    <img src={{ $schedule->movie->image_url }} width="400">

    <form method="POST" action="{{ route('scheduleUpdate', $schedule->id) }}">
        @method('PATCH')
        @csrf

        <input type="hidden" name="id" value="{{ $schedule->id }}">
        <input type="hidden" name="movie_id" value="{{ $schedule->movie_id }}">

        <div>
            <label>開始日付
                @error('start_time_date')
                    <li>{{ $message }}</li>
                @enderror
                <input type="date" name="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}">
            </label>
        </div>
        <br>
        <div>
            <label>開始時間
                @error('start_time_time')
                    <li>{{ $message }}</li>
                @enderror
                <input type="time" name="start_time_time" value="{{ $schedule->start_time->format('H:i') }}">
            </label>
        </div>
        <br>
        <div>
            <label>終了日付
                @error('end_time_date')
                    <li>{{ $message }}</li>
                @enderror
                <input type="date" name="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}">
            </label>
        </div>
        <br>
        <div>
            <label>終了時間
                @error('end_time_time')
                    <li>{{ $message }}</li>
                @enderror
                <input type="time" name="end_time_time" value="{{ $schedule->end_time->format('H:i') }}">
            </label>
        </div>

        <button>確定</button>
    </form>
</body>

</html>
