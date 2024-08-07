<div class="menu3">

    @if (Auth::check())
    <form class="logout" action="/logout" method="post">
        @csrf
        <button>ログアウト</button>
    </form>
    
    @endif

    マイページ
    出品
</div>