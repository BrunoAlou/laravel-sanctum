<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AddressService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegistered;

class RegisterController extends Controller {
    protected $addressService;

    public function __construct(AddressService $addressService) {
        $this->addressService = $addressService;
    }

    public function showRegistrationForm() {
        return view('auth.register');
    }

    public function register(RegisterRequest $request) {
        $address = $this->addressService->getAddressByZip($request->zip);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $address,
        ]);

        Event::dispatch(new UserRegistered($user));

        return response()->json(['message' => 'User registered successfully']);
    }
}