@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#forumModal">
            Create a Thread
        </button>
    </div>
</div>
@include('viewcomponents.forum_modals')
<div class="row">
    <div class="col-12">
        <h1>Announcements</h1>
        @foreach ($threads as $thread)
        @if ($thread->is_announcement)
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    <a href="/post/{{$thread->id}}" style="text-decoration: none;">{{ $thread->title }}</a>
                </h2>
                <p class="card-text">Author: {{ $thread->creater_name }}</p>
                <p class="card-text">Created at: {{ $thread->date_posted }}</p>
                @if ($thread->user_id == auth()->id() || Auth::user()->isAdmin)
                <div class="col-md-4 ms-auto d-flex justify-content-end">
                    @if (Auth::user()->isAdmin)
                    <a href="/attempt_set_announcement/{{$thread->id}}"
                        style="color: #A8FA9B; text-decoration: none;">Unset Anouncement</a> &nbsp;
                    @endif
                    <a href="/attempt_delete_thread/{{$thread->id}}"
                        style="color: #FA9B9B; text-decoration: none;">Delete thread</a>
                </div>
                @endif
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<div id="lineForum"></div>
<div class="row">
    <div class="col-12">
        <h1>Threads</h1>
        @foreach ($threads as $thread)
        @if (!$thread->is_announcement)
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    <a href="/post/{{$thread->id}}" style="text-decoration: none;">{{ $thread->title }}</a>
                </h2>
                <p class="card-text">Author: {{ $thread->creater_name }}</p>
                <p class="card-text">Created at: {{ $thread->date_posted }}</p>
                @if ($thread->user_id == auth()->id() || Auth::user()->isAdmin)
                <div class="col-md-4 ms-auto d-flex justify-content-end">
                    @if (Auth::user()->isAdmin)
                    <a href="/attempt_set_announcement/{{$thread->id}}"
                        style="color: #A8FA9B; text-decoration: none;">Set Anouncement</a> &nbsp;
                    @endif
                    <a href="/attempt_delete_thread/{{$thread->id}}"
                        style="color: #FA9B9B; text-decoration: none;">Delete thread</a>
                </div>
                @endif
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{$threads->links("pagination::bootstrap-5")}}
    </div>

</div>
@endsection
