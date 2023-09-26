<header>
    @guest
        @if (Route::has('login'))
        <div class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
        </div>
        @endif 
    @else
         <h4>Xin chào! {{ Auth::user()->name }}</h4>
         <div class="nav-item">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Đăng xuất') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    @endguest
           
</header>