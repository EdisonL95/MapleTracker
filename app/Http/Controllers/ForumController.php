<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Threads;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    // Display the forum, paginate used to create pages of 5 threads when receiving the table data for regular threads, pages of three for announcements
    public function displayForum()
    {
        $threads = Threads::where('is_announcement', false)->paginate(5);
        $announcements = Threads::where('is_announcement', true)->get();
        return view("forum", ['announcements' => $announcements, 'threads' => $threads]);
    }

    // Display the thread with posts, paginate used to create pages of 10 posts when receiving table data
    public function displayThread($threadId)
    {
        $thread = Threads::where('id', $threadId)->first();
        $posts = Post::where('thread_id', $threadId)->paginate(10);
        return view("thread")->with(['posts' => $posts, 'thread' => $thread]);
    }

    // Create a thread given the input data
    public function createThread(Request $request)
    {
        $user = Auth::user();
        $announcementCount = Threads::where('is_announcement', true)->count();
        $thread = new Threads;
        $thread->title = $request->input("title");
        $thread->creater_name = $user->name;
        $thread->date_posted = now();
        $thread->contents = $request->input("contents");
        $thread->is_announcement = $request->has("announcementcheck");
        $thread->user_id = $user->id;
        if ($announcementCount < 3 && $thread->is_announcement){
            $thread->save();
        }
        else if ($announcementCount >= 3 && $thread->is_announcement) {
            return redirect("/forum");
        }
        $thread->save();
        return redirect("/forum");
    }

    // set a thread to announcement, un set if it is already one limit to three total threads
    public function setAnnouncement($threadId)
    {
        $thread = Threads::find($threadId);
        $announcementCount = Threads::where('is_announcement', true)->count();
        if($thread->is_announcement == 1){
            $thread->is_announcement = 0;
        }
        else if ($announcementCount < 3){
            $thread->is_announcement = 1;
        }
        $thread->save();
        return redirect("/forum");
    }

    // Create a post in a thread given input requests
    public function createPost(Request $request, $threadId)
    {
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


    // Delete a thread based on the threadid passed in
    public function deleteThread($threadId) {
        $user = Auth::user();
        $thread = Threads::find($threadId);
        if ($user->id == $thread->user_id || $user->isAdmin == 1){
            $thread->delete();
        }
        return redirect("/forum");
    }

    // Delete a post given the post id
    public function deletePost($postId) {
        $user = Auth::user();
        $post = Post::find($postId);
        $threadId = $post->thread_id;
        if ($user->id == $post->user_id || $user->isAdmin == 1){
            $post->delete();
        }
        return redirect("/post/$threadId");
    }
}
