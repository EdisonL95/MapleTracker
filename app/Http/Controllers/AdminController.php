<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\characters;
use App\Models\base_collection;
use App\Models\site_data;
use App\Models\Task;
use App\Models\Post;
use App\Models\User;
use App\Models\Threads;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function displayAdmin()
    {
        $userCount = User::count();
        $characterCount = Characters::count();
        $dailyCount = Task::where('type', 'LIKE', '%Daily%')->count();
        $weeklyCount = Task::where('type', 'LIKE', '%Weekly%')->count();
        $threadCount = Threads::count();
        $postCount = Post::count();
        $users = User::all();
        $base_collection = base_collection::all();
        $userData = [];
        foreach ($users as $user) {
            $userCharacters = Characters::where('user_id', $user->id)->count();
            $userPosts = Post::where('user_id', $user->id)->count();
            $userThreads = Threads::where('user_id', $user->id)->count();
            $userTasks = Task::where('user_id', $user->id)->count();
    
            $userData[] = [
                'username' => $user->name,
                'characters' => $userCharacters,
                'posts' => $userPosts,
                'threads' => $userThreads,
                'tasks' => $userTasks,
            ];
        }
    
        return view("admin")->with([
            'userCount' => $userCount,
            'characterCount' => $characterCount,
            'dailyCount' => $dailyCount,
            'weeklyCount' => $weeklyCount,
            'threadCount' => $threadCount,
            'postCount' => $postCount,
            'users' => $userData,
            'base_collection' => $base_collection
        ]);
    }
    
    public function changeLandingText(Request $request)
    {
        $landingText = site_data::first();
        $landingText->landing_page_text = $request->input("landingText");
        $landingText->save();
        return redirect("admin");
    }

    public function createBase(Request $request)
    {
        $base_collection = new base_collection;
        $base_collection->description = $request->input("task_name");
        $base_collection->reward = $request->input("reward") ?? 00;
        $base_collection->tags = $request->input("tags");
        $base_collection->type = $request->input("type");
        $base_collection->priority = $request->has("priority");

        // Save the character
        $base_collection->save();

        return redirect("/admin");
    }

    public function editBase(request $request){
        $base_collection = base_collection::find($request->input("taskId"));
        $base_collection->description = $request->input("task_name");
        $base_collection->reward = $request->input("reward") ?? 00;
        $base_collection->tags = $request->input("tags");
        $base_collection->type = $request->input("type");
        $base_collection->priority = $request->has("priority");
        $base_collection->save();
        return redirect("/admin");
    }

    public function deleteBase($id) {
        base_collection::where('id', $id)->delete();
        return redirect("/admin");
    }

}

