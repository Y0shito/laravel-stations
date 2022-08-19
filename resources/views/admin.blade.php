<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>映画タイトル</th>
            <th>画像URL</th>
            <th>公開年</th>
            <th>上映中かどうか</th>
            <th>概要</th>
            <th>登録日時</th>
            <th>更新日時</th>
            <th>編集</th>
        </tr>
        <form method="GET">
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->title }}</td>
                    <td><img src={{ $movie->image_url }} width="100"></td>
                    <td>{{ $movie->published_year }}</td>
                    @if ($movie->is_showing == true)
                        <td>上映中</td>
                    @else
                        <td>上映予定</td>
                    @endif
                    <td>{{ $movie->description }}</td>
                    <td>{{ $movie->created_at }}</td>
                    <td>{{ $movie->updated_at }}</td>
                    <td>
                        <button value="{{ $movie->id }}" name="id" formaction="{{ route('edit', $movie->id) }}">編集
                        </button>
                    </td>
                </tr>
            @endforeach
        </form>
    </table>

</body>

</html>
