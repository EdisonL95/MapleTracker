<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\characters;
use App\Models\character_task;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function displayTasksPage()
    {
        $userId = Auth::user()->id;
        $characters = characters::where('user_id', $userId)->get();
        $tasks = task::where('user_id', $userId)->get();
        $character_tasks = character_task::where('user_id', $userId)->get();
        return view("tasks", ['characters' => $characters, 'tasks' => $tasks, 'character_tasks' => $character_tasks]);
    }

    public function displayTaskManagerPage()
    {
        $userId = Auth::user()->id;
        $tasks = task::where('user_id', $userId)->get();
        return view("taskmanager", ['tasks' => $tasks]);
    }

    public function createTask(Request $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Create a new character
        $task = new task;
        $task->description = $request->input("task_name");
        $task->reward = $request->input("reward") ?? 00;
        $task->tags = $request->input("tags");
        $task->type = $request->input("type");
        $task->priority = $request->has("priority");
        
        // Associate the character with the user
        $task->user_id = $user->id;

        // Save the character
        $task->save();

        return redirect("/taskmanager");
    }

    public function editTask(request $request){
        $task = task::find($request->input("taskId"));
        $task->description = $request->input("task_name");
        $task->reward = $request->input("reward") ?? 00;
        $task->tags = $request->input("tags");
        $task->type = $request->input("type");
        $task->priority = $request->has("priority");
        $task->save();
        return redirect("/taskmanager");
    }

    public function deleteTask($id) {
        task::where('id', $id)->delete();
        return redirect("/taskmanager");
    }

    public function deleteCharacterTask($taskId) {
        character_task::where('id', $taskId)->delete();
        return redirect("/tasks");
    }

    public function addCharacterTask($characterId, $taskId)
    {
        $user = Auth::user();
        $character_task = new character_task;
        $character_task->user_id = $user->id;
        $character_task->character_id = $characterId;
        $character_task->task_id = $taskId;
        $character_task->task_status = 0;
        $character_task->save();
        return redirect("/tasks");
    }

}
