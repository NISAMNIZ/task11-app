<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('book.login');
    }
    public function dologin(Request $request)
    {
        $name = $request->input('name');
    $password = $request->input('password');

    $user = User::where('name', $name)->where('password', $password)->first();

    if ($user) {
        
        auth()->login($user);

        
        return redirect()->route('home.book')->with('message', 'Login successful!');
    } else {
        
        return redirect()->route('login.book')->with('message', 'Login is invalid');
    }
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('login.book');
    }
}
