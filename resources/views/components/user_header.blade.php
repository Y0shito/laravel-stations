<header>
    <p><a href="{{ route('index') }}">StationMovies</a></p>
    <nav>
        <ul>
            @if (Auth::check())
                <li><a href="">マイページ</a></li>
            @else
                <li><a href="{{ route('showLogIn') }}">ログイン</a></li>
                <li><a href="{{ route('signIn') }}">サインイン</a></li>
            @endif
        </ul>
    </nav>
</header>
