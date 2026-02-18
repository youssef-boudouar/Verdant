<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'email' =>  'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $user = User::create($validated);

        $user->assignRole('client');
        
        Auth::login($user);
        return redirect()->route('home');
    }
}

