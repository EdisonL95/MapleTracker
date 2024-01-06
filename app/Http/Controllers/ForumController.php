<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Threads;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function displayForum()
    {
        $threads = Threads::paginate(5);;
        return view("forum", ['threads' => $threads]);
    }

    public function displayThread($threadId)
    {
        $thread = Threads::where('id', $threadId)->first();
        $posts = Post::where('thread_id', $threadId)->paginate(10);
        return view("thread")->with(['posts' => $posts, 'thread' => $thread]);
    }

    public function createThread(Request $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        $thread = new Threads;
        $thread->title = $request->input("title");
        $thread->creater_name = $user->name;
        $thread->date_posted = now();
        $thread->contents = $request->input("contents");
        $thread->is_announcement = $request->has("announcementcheck");
        $thread->user_id = $user->id;
        $thread->save();
        return redirect("/forum");
    }


    public function createPost(Request $request, $threadId)
    {
        // Get the currently logged-in user
        $user = Auth::user();
        $post = new Post;
        $post->post_creator = $user->name;
        $post->contents = $request->input("contents");
        $post->date_posted = now();
        $post->thread_id = $threadId;
        $post->user_id = $user->id;
        $post->save();
        return redirect("/post/$threadId");
    }


    public function deleteThread($threadId) {
        Threads::where('id', $threadId)->delete();
        return redirect("/forum");
    }

    public function deletePost($postId) {
        $post = Post::find($postId);
        $threadId = $post->thread_id;
        $post->delete();
        return redirect("/post/$threadId");
    }
}
