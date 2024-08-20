<div class="menu">
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

    <nav class="header-navi">
        <ul>
            <li><a href="/login">ログイン</a></li>
            <li><a href="/register">会員登録</a></li>
            <li>
                <form action="/sell" method="get">
                    @csrf
                    <button class="header-navi__submit-btn">出品</button>
                </form>
            </li>
        </ul>
    </nav>
</div>