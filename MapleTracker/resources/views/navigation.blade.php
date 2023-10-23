<nav class="navbar navbar-expand-lg bg-light">
    <a class="navbar-brand" href="/">Mapletracker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
            @if (Auth::check())
            <!-- Check if user is logged in -->
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="/characters" class="nav-link {{ Request::is('characters') ? 'active' : '' }}">Characters</a>
            <a href="/logout" class="nav-link">Logout</a>
            @else
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a>
            <a href="/register" class="nav-link {{ Request::is('register') ? 'active' : '' }}">Register</a>
            @endif
        </div>
    </div>
</nav>
