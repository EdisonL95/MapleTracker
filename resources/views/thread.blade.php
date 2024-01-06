@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#postModal">
            Create a Post
        </button>
    </div>
</div>
@include('viewcomponents.thread_modals')
<div class="row">
    <div class="col-12">
        @if ($thread)
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    {{ $thread->title }}
                </h2>
                <p class="card-text">Author: {{ $thread->creater_name }}, Created at: {{ $thread->date_posted }}</p>
                <p class="card-text">{{ $thread->contents }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
<div id="lineForum"></div>
<div class="row">
    <div class="col-12">
    @if ($posts && count($posts) > 0)
    @foreach ($posts as $post)
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Posted by: {{$post->post_creator}}
                </h4>
                <p class="card-text">Created at: {{ $post->date_posted }}</p>
                <p class="card-text">{{ $post->contents }}</p>
                @if ($post->user_id == Auth::user()->id || Auth::user()->isAdmin)
                    <div class="col-md-4 ms-auto d-flex justify-content-end">
                        <a href="/attempt_delete_post/{{$post->id}}" style="color: #FA9B9B; text-decoration: none;">Delete post</a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    @else
        <p>This thread is empty, add a post!</p>
    @endif
    </div>
    <div class="d-flex justify-content-center">
    {{$posts->links("pagination::bootstrap-5")}}
    </div>
</div>
@endsection
