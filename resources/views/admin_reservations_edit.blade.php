<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/admin_reservations_edit.css') }}">
    <title>予約編集確定</title>
</head>

<body>
    @include('components.header', ['title' => '予約編集確定'])

    <form method="POST" action="{{ route('adminReservationUpdate', $reservation->id) }}">
        @method('PATCH')
        @csrf

        <ul>
            <li>
                <input type="hidden" name="id" value="{{ $reservation->id }}">
                <p>予約ID:{{ $reservation->id }}</p>
            </li>

            <li>
                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                <p>スケジュールID:{{ $schedule->id }}</p>
            </li>

            <li>
                <p>映画名:{{ $schedule->movie->title }}</p>
            </li>

            <li>
                <input type="hidden" name="screening_date" value="{{ $schedule->start_time }}">
                <p>上映日:{{ $schedule->start_time->format('Y-m-d H:i') }}</p>
            </li>

            <p>上映スクリーン:{{ $schedule->screen_no }}</p>

            <li>
                <label>座席
                    @error('sheet_id')
                        <p>{{ $message }}</p>
                    @enderror
                    @foreach ($sheets as $item)
                        @if ($item->reservations_count === 1)
                            <label>
                                <input class="checkbox-disabled" type="checkbox" name="sheet_id"
                                    value="{{ $item->id }}" disabled="disabled">
                                <span>{{ strtoupper($item->row . $item->column) }}</span>
                            </label>
                        @else
                            <label>
                                <input type="checkbox" name="sheet_id" value="{{ $item->id }}">
                                {{ strtoupper($item->row . $item->column) }}
                            </label>
                        @endif
                    @endforeach
                </label>
            </li>

            <input type="hidden" name="name" value="{{ $name }}">
            <li class="input-name">
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
                <p>予約者氏名:{{ $name }}</p>
            </li>

            <input type="hidden" name="email" value="{{ $email }}">
            <li class="input-email">
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
                <p>メールアドレス:{{ $email }}</p>
                </label>
            </li>

            <button>編集確定</button>
        </ul>
    </form>

</body>

</html>
