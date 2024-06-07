<nav class="navbar navbar-expand-lg border-bottom border-bottom-dark sticky-top " style="background-color: #F5E344;">
    <div class="container bg-[#F5E344] ">
        <a class="navbar-brand fw-light " href="/"><span class="fas fa-brain me-1">
            </span>{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="{{ Route::is('login') ? 'active' : '' }} nav-link" href="{{ route('login') }}">Login</a>

                    </li>
                    <li class="nav-item">
                        <a class="{{ Route::is('register') ? 'active' : '' }} nav-link"
                            href="{{ route('register') }}">Register</a>

                    </li>
                @endguest

                @auth()
                    <li class="nav-item">
                        <a class="nav-link mx-4" href="{{ route('profile') }}">Welcome back, {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
