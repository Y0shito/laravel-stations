<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/reserve_sheet.css') }}">
    <title>座席予約</title>
</head>

<body>
    @if (session()->has('message'))
        <li>
            {{ session('message') }}
        </li>
    @endif

    <h2>座席表</h2>
    <p>座席を選んでください</p>

    <form method="GET">
        <div class="sheets">
            @foreach ($sheets as $sheet)
                @if ($sheet->reservations_count === 1)
                    <button
                        formaction="{{ route('reserveCreate', ['movie_id' => $movie_id, 'schedule_id' => $schedule_id]) }}"
                        name="sheetId" value="{{ $sheet->id }}" disabled>
                        {{ "{$sheet->row}-{$sheet->column}" }}
                    </button>
                @else
                    <button
                        formaction="{{ route('reserveCreate', ['movie_id' => $movie_id, 'schedule_id' => $schedule_id]) }}"
                        name="sheetId" value="{{ $sheet->id }}">
                        {{ "{$sheet->row}-{$sheet->column}" }}
                    </button>
                @endif
            @endforeach
        </div>
        <input type="hidden" name="screening_date" value="{{ $reservedDate }}">
    </form>
</body>

</html>
