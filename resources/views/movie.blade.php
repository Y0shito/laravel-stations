<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>

<body>
    <h2>{{ $movie->title }}</h2>
    <img src={{ $movie->image_url }} width="400">
    <p>ID：{{ $movie->id }}</p>
    <p>公開日：{{ $movie->published_year }}</p>
    <p>上映状況：{{ $movie->is_showing == true ? '上映中' : '上映予定' }}</p>
    <p>概要：{{ $movie->description }}</p>
    <p>作成日：{{ $movie->created_at }}</p>
    <p>更新日：{{ $movie->updated_at }}</p>
</body>

</html>
