<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller {
    public function showLinkRequestForm() {
        return view('auth.password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request) {
        $status = Password::sendResetLink($request->only('email'));
        var_dump('Link de reset de senha enviado');
        exit;
    }
}
