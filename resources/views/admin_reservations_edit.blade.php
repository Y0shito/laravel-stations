<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約内容編集</title>
</head>

<body>
    <h2>予約内容編集</h2>
    <form method="POST" action="">
        @csrf

        <div>
            <label>スケジュール
                @error('schedule_id')
                    <li>{{ $message }}</li>
                @enderror
                <select name="schedule_id">
                    @foreach ($schedules as $item)
                        <option value="{{ $item->id }}" @if ($reservation->schedule_id === $item->id) selected @endif>
                            {{ "ID:{$item->id} 映画:{$item->movie->title} 上映時間:{$item->start_time}" }}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>

        <div>
            <label>映画
                <select name="movie_id">
                    @foreach ($movies as $item)
                        <option value="{{ $item->id }}" @if ($reservation->schedule->movie->id === $item->id) selected @endif>
                            {{ "映画:{$item->title}" }}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>

        <div>
            <label>上映日
                @error('screening_date')
                    <li>{{ $message }}</li>
                @enderror
                <input type="date" name="screening_date" value="{{ $reservation->screening_date->format('Y-m-d') }}">
            </label>
        </div>

        <div>
            <label>座席
                @error('sheet_id')
                    <li>{{ $message }}</li>
                @enderror
                <select name="sheet_id">
                    @foreach ($sheets as $item)
                        <option value="{{ $item->id }}" @if ($reservation->sheet_id === $item->id) selected @endif>
                            {{ strtoupper($item->row . $item->column) }}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>

        <div>
            <label>予約者氏名
                @error('name')
                    <li>{{ $message }}</li>
                @enderror
                <input type="text" name="name" placeholder="名前を入力してください" value="{{ $reservation->name }}">
            </label>
        </div>

        <div>
            <label>メールアドレス
                @error('email')
                    <li>{{ $message }}</li>
                @enderror
                <input type="text" name="email" placeholder="メールアドレスを入力してください" value="{{ $reservation->email }}">
            </label>
        </div>

        <button>変更確定</button>
    </form>
</body>

</html>
