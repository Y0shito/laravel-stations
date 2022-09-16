<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies</title>
</head>

<body>
    <form method="GET" action="{{ route('index') }}">
        <input type="text" name="keyword" placeholder="タイトルを入力">
        <input type="radio" name="is_showing" value="" checked>すべて
        <input type="radio" name="is_showing" value="0">公開予定
        <input type="radio" name="is_showing" value="1">公開中
        <button>検索</button>
    </form>

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
        </tr>

        @isset($searchedMovies)
            @foreach ($searchedMovies as $movie)
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
                </tr>
            @endforeach
        @endisset

        @isset($movies)
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
                </tr>
            @endforeach
        @endisset
    </table>
</body>

</html>
