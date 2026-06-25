<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function regist(){
        return view('authentication.regist');
    }

    public function saveregist(Request $request){
       $request->validate([
        'username' => ['required', 'string', 'max:255', Rule::unique(User::class, 'username')],
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class, 'email')],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
       ], [
        'password.confirmed' => 'password tidak sama'
       ]);
       User::create([
        'username' => $request->username,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
       ]);
       return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function login(){
        return view('authentication.login');
    }

    public function savelogin(Request $request){
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'username' => 'username or password is incorrect',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
