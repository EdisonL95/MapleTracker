@extends("layout")

@section("content")
<div class="d-flex justify-content-center">
    @if (Auth::check())
    <h2>Welcome, {{ Auth::user()->name }}</h2>
    @else
    <h2>Get Started!</h2>
    @endif
</div>
<div class="d-flex justify-content-center" id="line">

</div>
<div class="d-flex justify-content-center" id="landing_text">
    @if (Auth::check())
    <p>Click Characters to get started. The tracker will display all your tasks and characters. To create new tasks, go
        to “Create Tasks” Chat with others using Discuss in the forum!</p>
    @else
    <p>Register and Login to get access to a variety of features. — Track your dailies, weeklies and discuss with
        others!</p>
    @endif
</div>
@endsection
