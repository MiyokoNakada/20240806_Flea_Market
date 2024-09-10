<div class="menu">
    <div class="header-logo_and_search">
        <div class="header-logo">
            <a href="/">
                <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH">
            </a>
        </div>

        <div class="header-search">
            <form class="search__form" action="/item/search" method="post">
                @csrf
                <input class="search__option" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
                <div class="error">
                    @error('keyword')
                    {{ $message }}
                    @enderror
                </div>
            </form>
        </div>
    </div>

    <nav class="header-navi">
        <ul class="header-navi__list">
            <li>
                @can ('admin')
                <a href="/admin">管理者</a>
                @endcan
            </li>
            <li>
                <form class="logout" action="/logout" method="post">
                    @csrf
                    <button class="header-navi__logout-btn">ログアウト</button>
                </form>
            </li>
            <li><a href="/mypage">マイページ</a></li>
            <li>
                <form action="/sell" method="get">
                    @csrf
                    <button class="header-navi__submit-btn">出品</button>
                </form>
            </li>
        </ul>
    </nav>
</div>