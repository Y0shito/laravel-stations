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

    <form method="POST" action="{{ route('adminReservationsStore') }}">
        @csrf
        <ul>
            <li>
                <label>スケジュール
                    @error('schedule_id')
                        <p>{{ $message }}</p>
                    @enderror
                    <select name="schedule_id">
                        @foreach ($schedules as $item)
                            <option value="{{ $item->id }}">
                                {{ "ID:{$item->id} 映画:{$item->movie->title} 上映時間:{$item->start_time}" }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </li>

            <li>
                <label>映画
                    <select name="movie_id">
                        @foreach ($movies as $item)
                            <option value="{{ $item->id }}">
                                {{ "映画:{$item->title}" }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </li>

            <li>
                <label>上映日
                    @error('screening_date')
                        <p>{{ $message }}</p>
                    @enderror
                    <input type="date" name="screening_date" value="{{ old('screening_date') }}">
                </label>
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
        </ul>
        <button>予約</button>
    </form>
</body>

</html>
