<header>
    <p><a href="{{ route('adminMovies') }}">StationMovies/管理者画面/{{ $title }}</a></p>
    <nav>
        <ul>
            <li><a href="{{ route('showCreate') }}">映画新規入力</a></li>
            <li><a href="{{ route('schedules') }}">スケジュール一覧</a></li>
            <li><a href="{{ route('adminReservations') }}">予約一覧</a></li>
        </ul>
    </nav>
</header>
