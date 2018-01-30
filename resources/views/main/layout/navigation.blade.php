<div class="nav">
    <nav class="container">
        <div class="user-account">
            <i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i>
            @if(Auth::check())
            <h3 class="sign-text"><a class="sign-in" href="">پنل کاربری</a> <a class="logout" href="{{ route('logout') }}">خروج</a> </h3>
                @else
                    <h3 class="sign-text"><a class="sign-in" href="/login">ورود</a>/<a class="sign-up" href="/register">ثبت نام</a> </h3>
            @endif

        </div>
        <div class="logo">
            <a href="{{url('/v2')}}">
            <img src="/img/anifLogoWeb.png" alt="آنیف">
            </a>
        </div>
    </nav>
</div>