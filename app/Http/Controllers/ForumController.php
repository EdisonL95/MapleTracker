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
        $threads = Threads::all();
        return view("forum", ['threads' => $threads]);
    }

    public function createThread(Request $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Create a new character
        $thread = new Threads;
        $thread->title = $request->input("title");
        $thread->creater_name = $user->name;
        $thread->date_posted = now();
        $thread->contents = $request->input("contents");
        $thread->is_announcement = $request->has("announcementcheck");
        // Associate the character with the user
        $thread->user_id = $user->id;

        // Save the character
        $thread->save();

        return redirect("/forum");
    }

}
