<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\characters;
use App\Models\character_task;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display the tasks page with the characters, their tasks, income, based on the user id of the currently logged user
    public function displayTasksPage()
    {
        $userId = Auth::user()->id;
        $characters = characters::where('user_id', $userId)->get();
        $tasks = task::where('user_id', $userId)->get();
        $character_tasks = character_task::where('user_id', $userId)->get();
        $income = 0;
        foreach ($character_tasks as $character_task) {
            foreach ($tasks as $task){
                if ($character_task->task_id === $task->id && $character_task->task_status){
                    $income += $task->reward;
                }
            }
        }
        return view("tasks", ['characters' => $characters, 'tasks' => $tasks, 'character_tasks' => $character_tasks, 'income' => $income]);
    }

    // Display the task manager page with the tasks associated with the current user
    public function displayTaskManagerPage()
    {
        $userId = Auth::user()->id;
        $tasks = task::where('user_id', $userId)->get();
        return view("taskmanager")->with(['tasks' => $tasks]);
    }

    // Create a task with the input data
    public function createTask(Request $request)
    {
        $user = Auth::user();

        $task = new task;
        $task->description = $request->input("task_name");
        $task->reward = $request->input("reward") ?? 00;
        $task->tags = $request->input("tags");
        $task->type = $request->input("type");
        $task->priority = $request->has("priority");
        
        $task->user_id = $user->id;

        $task->save();

        return redirect("/taskmanager");
    }

    // Edit a task based on the id provided
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

    // Delete a task based on id provided
    public function deleteTask($id) {
        $user = Auth::user();
        $task = Task::find($id);
        if ($user->id == $task->user_id || $user->isAdmin == 1){
            $task->delete();
        }
        return redirect("/taskmanager");
    }

    // Delete a task associated with a character based on id provided
    public function deleteCharacterTask($taskId) {
        $user = Auth::user();
        $character_task = character_task::find($taskId);
        if ($user->id == $character_task->user_id){
            $character_task->delete();
        }
        return redirect("/tasks");
    }

    // Add a task to a character based on the character id and task id provided
    public function addCharacterTask($characterId, $taskId)
    {
        $user = Auth::user();
        $character = characters::find($characterId);
        $task = Task::find($taskId);
        if ($user->id == $character->user_id && $user->id == $task->user_id){
            $character_task = new character_task;
            $character_task->user_id = $user->id;
            $character_task->character_id = $characterId;
            $character_task->task_id = $taskId;
            $character_task->task_status = 0;
            $character_task->save();
        }

        return redirect("/tasks");
    }

    // Set the status of a task, incomplete or complete
    public function setTaskStatus($taskId) {
        $user = Auth::user();
        $character_task = character_task::find($taskId);
        if ($user->id == $character_task->user_id){
            $character_task->task_status = !$character_task->task_status;
            $character_task->save(); 
        }
        return redirect("/tasks");
    }

    // Calculate the weekly income of the user
    public function calculateWeeklyIncome()
    {
        $userId = Auth::user()->id;
        
        $tasks = task::where('user_id', $userId)->get();
        $character_tasks = character_task::where('user_id', $userId)->get();
        $income = 0;
        $tasks_list = $tasks->where('id', $character_tasks->task_id);
        foreach ($tasks_list as $task) {
            foreach ($character_tasks as $character_task){
                if ($character_task->task_id == $task->id){
                    if($character_task->status == 1){
                        $income += $task->reward;
                    }
                }
            }
        }
        return $income;
    }

}
