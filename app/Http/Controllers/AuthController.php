<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function registerForm()
    {
        return view('registerForm');
    }

    public function ProcessRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in
        Auth::login($user);

        // Fire the Registered event (this sends verification email)
        event(new Registered($user));

        // Redirect to verification notice page
        return redirect()->route('login')
            ->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->withInput();
        }
        $user = Auth::user();
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Please verify your email before logging in.',
            ]);
        }
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Logged in successfully!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
