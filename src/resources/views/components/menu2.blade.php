<div class="menu">
    <div class="header-logo">
        <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH">
    </div>

    <div class="header-search">
        <form action="/search" method="post">
            @csrf
            <input type="text" placeholder="なにをお探しですか？">
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