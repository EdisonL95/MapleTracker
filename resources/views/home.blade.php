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
    <p>{{$siteData->landing_page_text}}</p>
    @else
    <p>Register and Login to get access to a variety of features. — Track your dailies, weeklies and discuss with
        others!</p>
    @endif
</div>
@endsection
