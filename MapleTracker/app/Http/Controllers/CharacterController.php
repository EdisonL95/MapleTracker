<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function displayCharactersPage()
    {
        return view("characters");
    }
    
}
