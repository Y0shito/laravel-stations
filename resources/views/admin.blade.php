<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>

<body>
    @if (session()->has('message'))
        <li>
            {{ session('message') }}
        </li>
    @endif

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
            <th>削除</th>
        </tr>

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
                    <form method="GET">
                        <button value="{{ $movie->id }}" name="id" formaction="{{ route('edit', $movie->id) }}">
                            編集
                        </button>
                    </form>
                </td>
                <td>
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button value="{{ $movie->id }}" name="id" onclick="return articleDelete();"
                            formaction="{{ route('destroy', $movie->id) }}">
                            削除
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

</body>
<script>
    'use strict';
    const articleDelete = () => {
        var ret = confirm("削除を実行しますか？");
        return ret;
    }
</script>

</html>
