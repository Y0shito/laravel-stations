<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    <title>ログイン</title>
</head>

<body>
    <header>
        <p><a href="{{ route('index') }}">StationMovies</a></p>
    </header>


    @if (session('message'))
        {{ session('message') }}
    @endif

    <form method="POST" action="{{ route('loginProcess') }}">
        @csrf

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

        <button>ログイン</button>
    </form>
</body>

</html>
