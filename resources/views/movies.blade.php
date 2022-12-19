<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
    <title>StationMovies</title>
</head>

<body>
    <header>
        <p><a href="{{ route('index') }}">StationMovies</a></p>
    </header>

    <form method="GET" action="{{ route('index') }}">
        <input type="text" name="keyword" placeholder="タイトルを入力">
        <input type="radio" name="is_showing" value="" checked>すべて
        <input type="radio" name="is_showing" value="0">公開予定
        <input type="radio" name="is_showing" value="1">公開中
        <button>検索</button>
    </form>

    <table>
        <tr>
            <th>タイトル</th>
            <th>画像</th>
            <th>公開年</th>
            <th>公開状況</th>
            <th>概要</th>
        </tr>

        @isset($searchedMovies)
            @foreach ($searchedMovies as $movie)
                <tr>
                    <td>
                        <a href="{{ route('movie', ['id' => $movie->id]) }}">
                            {{ $movie->title }}
                        </a>
                    </td>
                    <td><img src={{ $movie->image_url }} width="100"></td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ $movie->is_showing == true ? '上映中' : '上映予定' }}
                    <td>{{ $movie->description }}</td>
                </tr>
                </a>
            @endforeach
        @endisset

        @isset($movies)
            @foreach ($movies as $movie)
                <tr>
                    <td>
                        <a href="{{ route('movie', ['id' => $movie->id]) }}">
                            {{ $movie->title }}
                        </a>
                    </td>
                    <td><img src={{ $movie->image_url }} width="100"></td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ $movie->is_showing == true ? '上映中' : '上映予定' }}
                    <td>{{ $movie->description }}</td>
                </tr>
                </a>
            @endforeach
        @endisset
    </table>
</body>

</html>
