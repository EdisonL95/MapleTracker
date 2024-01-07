<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\characters;
use App\Models\character_task;
use App\Models\Task;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function displayCharactersPage()
    {
        $userId = Auth::user()->id;
        $characters = characters::where('user_id', $userId)->get();
        $tasks = task::where('user_id', $userId)->get();
        $character_tasks = character_task::where('user_id', $userId)->get();
        return view("characters")->with([
            'characters' => $characters,
            'tasks' => $tasks,
            'character_tasks' => $character_tasks,
        ]);
    }
    
    public function createCharacter(Request $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Create a new character
        $characters = new Characters;
        $characters->level = $request->input("level");
        $characters->character_name = $request->input("character_name");
        $characters->class = $request->input("class");
        
        // Associate the character with the user
        $characters->user_id = $user->id;

        // Save the character
        $characters->save();

        return redirect("/characters");
    }

    public function editCharacter(request $request){
        $characters = characters::find($request->input("charId"));
        $characters->level = $request->input("level");
        $characters->character_name = $request->input("character_name");
        $characters->class = $request->input("class");
        $characters->save();
        return redirect("/characters");
    }

    public function searchCharacter(Request $request) {
        $searchTerm = $request->input('searchTerm');
        $userId = Auth::user()->id;
        $characters = characters::where('character_name', 'LIKE', '%' . $searchTerm . '%')
                     ->where('user_id', $userId)
                     ->get();
        return response()->json($characters);
    }

    public function deleteCharacter($id) {
        $user = Auth::user();
        $character = Characters::find($id);
        if ($user->id == $character->user_id){
            $character->delete();
        }
        return redirect("/characters");
    }
}

