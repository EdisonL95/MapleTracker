<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Mapletracker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav ms-auto">
            @if (Auth::check())
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="/characters" class="nav-link {{ Request::is('characters') ? 'active' : '' }}">Characters</a>
            <a href="/tasks" class="nav-link {{ Request::is('tasks') ? 'active' : '' }}">Tasks</a>
            <a href="/taskmanager" class="nav-link {{ Request::is('taskmanager') ? 'active' : '' }}">Task Manager</a>
            <a href="/forum" class="nav-link {{ Request::is('forum') ? 'active' : '' }}">Forum</a>
                @if ( Auth::user()->isAdmin)
                <a href="/admin" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">Admin Page</a>
                @endif
            <a href="/logout" class="nav-link">Logout</a>
            @else
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a>
            <a href="/register" class="nav-link {{ Request::is('register') ? 'active' : '' }}">Register</a>
            @endif
        </div>
    </div>
</nav>
