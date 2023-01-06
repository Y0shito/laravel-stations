<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/admin_reservations_pre_edit.css') }}">
    <title>予約内容編集</title>
</head>

<body>
    @include('components.header', ['title' => '予約内容編集'])

    <h3>予約内容</h3>
    <ul class="reservation">
        <li>予約ID:{{ $reservation->id }}</li>
        <li>スケジュールID:{{ $reservation->schedule_id }}</li>
        <li>映画名:{{ $reservation->schedule->movie->title }}</li>
        <li>上映スクリーン:{{ $reservation->schedule->screen_no }}</li>
        <li>座席:{{ strtoupper($reservation->sheet->row . $reservation->sheet->column) }}</li>
        <li>予約者氏名:{{ $reservation->name }}</li>
        <li>メールアドレス:{{ $reservation->email }}</li>
    </ul>

    <h3>編集</h3>

    <form method="POST" action="{{ route('adminReservationsEdit', $reservation->id) }}">
        @csrf

        <ul>
            <li>
                <label>スケジュール
                    @error('schedule_id')
                        <p>{{ $message }}</p>
                    @enderror
                    <select name="schedule_id">
                        @foreach ($schedules as $item)
                            <option value="{{ $item->id }}" @if ($reservation->schedule_id === $item->id) selected @endif>
                                {{ "ID:{$item->id} 映画:{$item->movie->title} 上映時間:{$item->start_time}" }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </li>

            <li class="input-name">
                <label>予約者氏名
                    @error('name')
                        <p>{{ $message }}</p>
                    @enderror
                    <input type="text" name="name" placeholder="名前を入力してください"
                        value="{{ $errors->has('*') ? old('name') : $reservation->name }}">
                </label>
            </li>

            <li class="input-email">
                <label>メールアドレス
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                    <input type="text" name="email" placeholder="メールアドレスを入力してください"
                        value="{{ $errors->has('*') ? old('email') : $reservation->email }}">
                </label>
            </li>

            <button>変更</button>
        </ul>
    </form>
</body>

</html>
