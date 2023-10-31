<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
 
use App\Models\User;
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
        ]);
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
        $user = new User;
        $user->password = Hash::make( $request->input("password") );
        $user->email = $request->input("email");
        $user->name = $request->input("username");
        $user->isAdmin = false;
        $user->save();

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