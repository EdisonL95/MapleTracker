@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#forumModal">
            Add a new character
        </button>
    </div>
</div>
@include('viewcomponents.forum_modals')
<div class="row">
    <div class="col-12">
        @foreach ($threads as $thread)
        @if ($thread->is_announcement)
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    <a href="">{{ $thread->title }}</a>
                </h2>
                <p class="card-text">Authour: {{ $thread->creater_name }}</p>
                <!-- Add other card content as needed -->
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<div id="line"></div>
<div class="row">
    <div class="col-12">
        @foreach ($threads as $thread)
        @if (!$thread->is_announcement)
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    <a href="">{{ $thread->title }}</a>
                </h2>
                <p class="card-text">Authour: {{ $thread->creater_name }}</p>
                <!-- Add other card content as needed -->
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
