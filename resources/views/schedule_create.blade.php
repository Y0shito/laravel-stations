<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール新規作成</title>
</head>

<body>
    <h2>{{ $movie->title }}の上映スケジュール新規作成</h2>

    <form method="POST" action="{{ route('scheduleStore', $movie->id) }}">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $movie->id }}">

        <div>
            <label>開始日付
                @error('start_time_date')
                    <li>{{ $message }}</li>
                @enderror
                <input type="date" name="start_time_date" value="{{ old('start_time_date') }}">
            </label>
        </div>
        <br>
        <div>
            <label>開始時間
                @error('start_time_time')
                    <li>{{ $message }}</li>
                @enderror
                <input type="time" name="start_time_time" value="{{ old('start_time_time') }}">
            </label>
        </div>
        <br>
        <div>
            <label>終了日付
                @error('end_time_date')
                    <li>{{ $message }}</li>
                @enderror
                <input type="date" name="end_time_date" value="{{ old('end_time_date') }}">
            </label>
        </div>
        <br>
        <div>
            <label>終了時間
                @error('end_time_time')
                    <li>{{ $message }}</li>
                @enderror
                <input type="time" name="end_time_time" value="{{ old('end_time_time') }}">
            </label>
        </div>

        <button>確定</button>
    </form>
</body>

</html>