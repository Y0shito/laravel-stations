<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/admin_reservations_create.css') }}">
    <title>予約新規作成</title>
</head>

<body>
    @include('components.header', ['title' => '予約新規作成'])

    @isset($schedule)
        <form method="POST" action="{{ route('adminReservationsStore') }}">
            @csrf

            <ul>
                <li>
                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                    <p>スケジュールID:{{ $schedule->id }}</p>
                </li>

                <li>
                    <input type="hidden" name="movie_id" value="{{ $schedule->movie->id }}">
                    <p>映画名:{{ $schedule->movie->title }}</p>
                </li>

                <li>
                    <input type="hidden" name="screening_date" value="{{ $schedule->start_time }}">
                    <p>上映日:{{ $schedule->start_time->format('Y-m-d H:i') }}</p>
                </li>

                <li>
                    <label>座席
                        @error('sheet_id')
                            <p>{{ $message }}</p>
                        @enderror
                        <select name="sheet_id">
                            @foreach ($sheets as $item)
                                <option value="{{ $item->id }}">
                                    {{ strtoupper($item->row . $item->column) }}
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
                        <input type="text" name="name" placeholder="名前を入力してください" value="{{ old('name') }}">
                    </label>
                </li>

                <li class="input-email">
                    <label>メールアドレス
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                        <input type="text" name="email" placeholder="メールアドレスを入力してください" value="{{ old('email') }}">
                    </label>
                </li>
                <button>予約</button>
            </ul>
        </form>
    @endisset

    @empty($schedule)
        <p>前の画面でスケジュールが選択されていません</p>
    @endempty
</body>

</html>
