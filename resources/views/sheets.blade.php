<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sheets</title>
</head>

<body>
    <h2>座席表</h2>

    <table style="text-align: center;">
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
                <td>{{ "{$sheet->row}-{$sheet->column}" }}</td>
            @endforeach
        </tr>
        <tr>
            @foreach ($sheetRowB as $sheet)
                <td>{{ "{$sheet->row}-{$sheet->column}" }}</td>
            @endforeach
        </tr>
        <tr>
            @foreach ($sheetRowC as $sheet)
                <td>{{ "{$sheet->row}-{$sheet->column}" }}</td>
            @endforeach
        </tr>
    </table>
</body>

</html>
