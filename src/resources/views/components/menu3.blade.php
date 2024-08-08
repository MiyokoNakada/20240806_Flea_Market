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
        <ul class="header-navi__list">
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