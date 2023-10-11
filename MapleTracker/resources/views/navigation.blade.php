<div class = "container">
<div class="d-flex justify-content-center">
    <ul>
        @if (Auth::check()) <!-- Check if user is logged in -->
            <li ><a href="/" class="nav-link">Home</a></li>
            <li><a href="/logout" class="nav-link">Logout</a></li> 
        @else
            <li><a href="/" class="nav-link">Home</a></li>
            <li ><a href="/login" class="nav-link">Login</a></li>
            <li ><a href="/register" class="nav-link">Register</a></li>
        @endif
    </ul>
</div>
</div>