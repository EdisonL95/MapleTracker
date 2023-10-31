<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\characters;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function displayTasksPage()
    {
        $userId = Auth::user()->id;
        $characters = characters::where('user_id', $userId)->get();
        return view("tasks", ['characters' => $characters]);
    }
}
