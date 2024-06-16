<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function register(): Response
    {
        return Inertia::render('Register', [
            'csrf_token' => csrf_token()
        ]);
    }

    public function registerStore(UserRegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->validated('username'),
            'email' => $request->validated('email'),
            'password' => $request->validated('password')
        ]);

        if ($user) {
            Auth::login($user, (bool)$request->get('remember'));
            $request->session()->regenerate();

            return Inertia::render('Pet', [
                'csrf_token' => csrf_token()
            ]);
        }

        return Inertia::render('Register', [
            'errors' => 'User not register'
        ]);
    }

    public function login()
    {
        return Inertia::render('Auth');
    }

    public function loginStore(UserAuthRequest $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], (bool)$request->get('remember'))) {
            $request->session()->regenerate();

            return Inertia::render('Pet', [
                'csrf_token' => csrf_token()
            ]);
        }

        return Inertia::render('Auth', [
            'AuthError' => 'Почта или пароль неверны',
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Inertia::render('Auth');
    }
}
