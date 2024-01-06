<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
 
use App\Models\User;
use App\Models\Task;
use App\Models\base_collection;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ])->with('loginFailed', true);
    }

    public function displayLoginPage()
    {
        return view("login");
    }
    
    public function displayRegisterPage()
    {
        return view("register");
    }

    public function redirectManage()
    {
        return redirect("/login");
    }

    public function registerUser(Request $request)
    {
        $emailCheck = User::where('email', $request->input("email"))->first();
        $nameCheck = User::where('name', $request->input("username"))->first();
        if ($emailCheck){
            return redirect("/register")->withErrors(['email' => 'The email is already registered.']);
        }
        if ($nameCheck){
            return redirect("/register")->withErrors(['name' => 'The name is already registered.']);
        }
        $user = new User;
        $user->password = Hash::make( $request->input("password") );
        $user->email = $request->input("email");
        $user->name = $request->input("username");
        $user->isAdmin = false;
        $user->save();

        $baseCollectionData = base_collection::all();
        foreach ($baseCollectionData as $baseItem) {
            $task = new Task;
            $task->user_id = $user->id; // Associate the task with the registered user
            $task->type = $baseItem->type;
            $task->description = $baseItem->description;
            $task->reward = $baseItem->reward;
            $task->priority = $baseItem->priority;
            $task->tags = $baseItem->tags;
            $task->save();
        }
        
        return redirect("/login");
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/login');
    }

}