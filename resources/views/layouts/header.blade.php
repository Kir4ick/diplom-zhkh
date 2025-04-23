<nav class="navbar navbar-expand-lg fixed-top custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="logo.png" height="50" alt="УК ДОМОВОЙ">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ request()->route()->getName() == 'home' ? '#' : route('home') }}">
                        Главная
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ request()->route()->getName() == 'home' ? '#services' : route('home') . '#services' }}">Услуги</a>
                </li>

                @if(!\Illuminate\Support\Facades\Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('feedback') }}">Отзывы</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('request') }}">Заявка</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('lk') }}">Личный кабинет</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Выйти из аккаунта</a></li>
                        </ul>
                    </li>
                @endif

                @if(\Illuminate\Support\Facades\Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('sign-in') }}">Вход</a></li>
                    <li class="nav-item"><a class="nav-link" href=" {{ route('sign-up')  }} ">Регистрация</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>


