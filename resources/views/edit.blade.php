<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit</title>
</head>

<body>
    <h2>編集ページ</h2>

    @error('title')
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @enderror

    <form method="POST" action="{{ route('update', $movie->id) }}">
        @csrf
        @method('PATCH')

        <label>ID：{{ $movie->id }}</label>
        <input type="hidden" name="id" value="{{ $movie->id }}">

        <label>映画タイトル</label>
        <input type="text" name="title" value="{{ $movie->title }}">

        <label>画像URL</label>
        <input type="text" name="image_url" value="{{ $movie->image_url }}">

        <label>公開年</label>
        <input type="text" name="published_year" value="{{ $movie->published_year }}">

        <label>公開中かどうか</label>
        <input type="hidden" name="is_showing" value="0">
        <input type="checkbox" name="is_showing" value="1">

        <label>概要</label>
        <textarea name="description">{{ $movie->description }}</textarea>

        <button>送信</button>
    </form>
</body>

</html>
