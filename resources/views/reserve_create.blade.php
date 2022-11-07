<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席予約</title>
</head>

<body>
    <p>予約内容を入力してください</p>

    <form method="POST" action="{{ route('reserveStore') }}">
        @csrf

        <input type="hidden" name="movie_id" value="{{ $value->movie_id }}">
        <p>映画ID：{{ $value->movie_id }}</p>

        <input type="hidden" name="schedule_id" value="{{ $value->schedule_id }}">

        <input type="hidden" name="sheet_id" value="{{ $value->sheetId }}">
        <p>座席：{{ $sheetName }}</p>

        <input type="hidden" name="date" value="{{ $value->date }}">
        <p>日付：{{ $value->date }}</p>

        <div>
            <label>予約者氏名</label>
            @error('name')
                <li>{{ $message }}</li>
            @enderror
            <input type="text" name="name" placeholder="名前を入力してください" value="{{ old('name') }}">
        </div>
        <br>
        <div>
            <label>メールアドレス</label>
            @error('email')
                <li>{{ $message }}</li>
            @enderror
            <input type="text" name="email" placeholder="メールアドレスを入力してください" value="{{ old('email') }}">
        </div>
        <button>予約</button>
    </form>

</body>

</html>
