<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
</head>

<body>
    <h2>新規入力ページ</h2>

    @error('title')
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @enderror

    <form method="POST" action="{{ route('store') }}">
        @csrf
        <label>映画タイトル</label>
        <input type="text" name="title" value="{{ old('title') }}">

        <label>画像URL</label>
        <input type="text" name="image_url" value="{{ old('image_url') }}">

        <label>公開年</label>
        <input type="text" name="published_year" value="{{ old('published_year') }}">

        <label>公開中かどうか</label>
        <input type="hidden" name="is_showing" id="上映予定" value="0">
        <input type="checkbox" name="is_showing" id="上映中" value="1">

        <label>概要</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <button>送信</button>
    </form>
</body>

</html>
