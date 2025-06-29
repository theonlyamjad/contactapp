<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Clear any old session before creating a new user
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Create new user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    // DEBUG: Check if the user is being created
    if (!$user) {
        dd("User creation failed!");
    }

    // Log in the new user
    Auth::login($user);

    // DEBUG: Check if Auth::login() worked
    if (!Auth::check()) {
        dd("Login failed! Auth::user() is null.");
    }

    // Regenerate session
    $request->session()->regenerate();

    return redirect(RouteServiceProvider::HOME);
}


}
