{{-- <header class="main-header">
    <ul>

        <li><a href="{{ route('index') }}">index</a></li>
        <li><a href="{{ route('contact') }}">contact</a></li>
        <li><a href="{{ route('about') }}">about</a></li>
    </ul>
</header> --}}

<header id="main-header">

    <!--<a id="logo-header" href="#">
        <span class="site-name">FranciscoAMK</span>
        <span class="site-desc">Diseño web / WordPress / Tutoriales</span>
    </a>  / #logo-header -->

    <nav>
        <ul>
            <li><a href="{{ route('index') }}">index</a></li>
            <li><a href="{{ route('contact') }}">contact</a></li>
            <li><a href="{{ route('about') }}">about</a></li>
        </ul>
    </nav><!-- / nav -->
    @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

</header><!-- / #main-header -->
