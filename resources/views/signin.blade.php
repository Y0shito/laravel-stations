<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    <title>サインイン</title>
</head>

<body>
    <header>
        <p><a href="{{ route('index') }}">StationMovies</a></p>
    </header>

    <form method="POST" action="{{route('register')}}">
        @csrf

        <div class="input-name">
            <label>名前（フルネーム）</label>
            @error('name')
                <li>{{ $message }}</li>
            @enderror
            <input type="text" name="name" placeholder="名前を入力してください" value="{{ old('name') }}">
        </div>

        <div class="input-email">
            <label>メールアドレス</label>
            @error('email')
                <li>{{ $message }}</li>
            @enderror
            <input type="text" name="email" placeholder="メールアドレスを入力してください" value="{{ old('email') }}">
        </div>

        <div class="input-password">
            <label>パスワード</label>
            @error('password')
                <li>{{ $message }}</li>
            @enderror
            <input type="password" name="password" placeholder="8-16文字でを入力してください" value="{{ old('password') }}">
        </div>

        <div class="input-password-confirmation">
            <label>パスワード確認</label>
            @error('password_confirmation')
                <li>{{ $message }}</li>
            @enderror
            <input type="password" name="password_confirmation" placeholder="再度、パスワードを入力してください"
                value="{{ old('password_confirmation') }}">
        </div>

        <button>確定</button>
    </form>
</body>

</html>
