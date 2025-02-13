<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($login)) {
            $user = User::where('email', $login['email'])->first();
            $user->update(['status' => 1]);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau Password Salah']);
    }

    public function logout() {
        $user = Auth::user();
        if ($user) {
            $user->update(['status' => 0]);
        }
        Auth::logout();
        return redirect('/login');
    }
}
