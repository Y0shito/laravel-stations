<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <title>映画新規入力</title>
</head>

<body>
    @include('components.header', ['title' => '映画新規入力'])

    @error('title')
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @enderror

    <form method="POST" action="{{ route('store') }}">
        @csrf
        <ul>
            <li>
                <label>映画タイトル</label>
                <input type="text" name="title" value="{{ old('title') }}">
            </li>

            <li>
                <label>画像URL</label>
                <input type="text" name="image_url" value="{{ old('image_url') }}">
            </li>

            <li>
                <label>公開年</label>
                <input type="text" name="published_year" value="{{ old('published_year') }}">
            </li>

            <li>
                <label>公開中かどうか</label>
                <input type="hidden" name="is_showing" id="上映予定" value="0">
                <input type="checkbox" name="is_showing" id="上映中" value="1">
            </li>

            <li>
                <label>概要</label>
                <textarea name="description">{{ old('description') }}</textarea>
            </li>

            <button>送信</button>
        </ul>
    </form>
</body>

</html>
