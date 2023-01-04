<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/reserve_create.css') }}">
    <title>座席予約</title>
</head>

<body>
    <header>
        <p><a href="{{ route('index') }}">StationMovies</a></p>
    </header>

    <p>予約内容を入力してください</p>

    <form method="POST" action="{{ route('reserveStore') }}">
        @csrf

        <input type="hidden" name="movie_id" value="{{ $reservationDetail->movie_id }}">
        <p>タイトル：{{ $reservedMovie->title }}</p>
        <img src={{ $reservedMovie->image_url }} width="400">

        <input type="hidden" name="schedule_id" value="{{ $reservationDetail->schedule_id }}">

        <p>スクリーン：{{ $reservedSheet->screen_no }}</p>

        <input type="hidden" name="sheet_id" value="{{ $reservationDetail->sheetId }}">
        <p>座席：{{ strtoupper($reservedSheet->row . $reservedSheet->column) }}</p>

        <input type="hidden" name="screening_date" value="{{ $reservationDetail->screening_date }}">
        <p>公開日：{{ $reservationDetail->screening_date }}</p>

        <div class="input-name">
            <label>予約者氏名</label>
            @error('name')
                <li>{{ $message }}</li>
            @enderror
            <input type="text" name="name" placeholder="名前を入力してください" value="{{ old('name') }}">
        </div>

        <div class="input-email">
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
