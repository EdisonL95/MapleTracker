<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\characters;
use App\Models\character_task;
use App\Models\Task;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    // Function used to display the character page, gets all characters associated with the user id and returns them.
    public function displayCharactersPage()
    {
        $userId = Auth::user()->id;
        $characters = characters::where('user_id', $userId)->get();
        // Required to get tasks for the daily/weekly counters on the character cards
        $tasks = task::where('user_id', $userId)->get();
        $character_tasks = character_task::where('user_id', $userId)->get();
        return view("characters")->with([
            'characters' => $characters,
            'tasks' => $tasks,
            'character_tasks' => $character_tasks,
        ]);
    }
    
    // Function used to create a character with the input requests
    public function createCharacter(Request $request)
    {
        $user = Auth::user();

        $characters = new Characters;
        $characters->level = $request->input("level");
        $characters->character_name = $request->input("character_name");
        $characters->class = $request->input("class");

        $characters->user_id = $user->id;

        $characters->save();

        return redirect("/characters");
    }

    // Function used to edit a character with the input requests
    public function editCharacter(request $request){
        $characters = characters::find($request->input("charId"));
        $characters->level = $request->input("level");
        $characters->character_name = $request->input("character_name");
        $characters->class = $request->input("class");
        $characters->save();
        return redirect("/characters");
    }

    
    // Function used to delete a character, $id is an id passed in by the route to delete that specific character
    public function deleteCharacter($id) {
        $user = Auth::user();
        $character = Characters::find($id);
        if ($user->id == $character->user_id){
            $character->delete();
        }
        return redirect("/characters");
    }
}

