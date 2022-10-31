<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席予約</title>
</head>

<body>
    <h2>座席表</h2>
    <p>座席を選んでください</p>

    <form method="GET">
        <table border="1" style="text-align: center;">
            <tr>
                <th>.</th>
                <th>.</th>
                <th>スクリーン</th>
                <th>.</th>
                <th>.</th>
            </tr>
            <tr>
                <td>:-:</td>
                <td>:-:</td>
                <td>:-:</td>
                <td>:-:</td>
                <td>:-:</td>
            </tr>
            <tr>
                @foreach ($sheetRowA as $sheet)
                    <td>
                        <button
                            formaction="{{ route('reserveCreate', ['movie_id' => $movie_id, 'schedule_id' => $schedule_id]) }}"
                            name="sheetId" value="{{ "{$sheet->row}-{$sheet->column}" }}">
                            {{ "{$sheet->row}-{$sheet->column}" }}
                        </button>
                    </td>
                @endforeach
            </tr>
            <tr>
                @foreach ($sheetRowB as $sheet)
                    <td>
                        <button
                            formaction="{{ route('reserveCreate', ['movie_id' => $movie_id, 'schedule_id' => $schedule_id]) }}"
                            name="sheetId" value="{{ "{$sheet->row}-{$sheet->column}" }}">
                            {{ "{$sheet->row}-{$sheet->column}" }}
                        </button>
                    </td>
                @endforeach
            </tr>
            <tr>
                @foreach ($sheetRowC as $sheet)
                    <td>
                        <button
                            formaction="{{ route('reserveCreate', ['movie_id' => $movie_id, 'schedule_id' => $schedule_id]) }}"
                            name="sheetId" value="{{ "{$sheet->row}-{$sheet->column}" }}">
                            {{ "{$sheet->row}-{$sheet->column}" }}
                        </button>
                    </td>
                @endforeach
            </tr>
        </table>

        <input type="hidden" name="date" value="{{ $reservedDate }}">
    </form>
</body>

</html>
