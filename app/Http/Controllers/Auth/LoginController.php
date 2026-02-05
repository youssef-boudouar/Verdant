<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Config\Exception\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($validated)) {
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'These credentials do not match our records.',
    ])->onlyInput('email');
}
}
