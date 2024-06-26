<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $request->user()->createToken('auth_token')->plainTextToken;
            return response()->json(['access_token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout() {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
        }

        Auth::guard('web')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}