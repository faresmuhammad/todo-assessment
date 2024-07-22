<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //validate the request
        //store user in the database
        $user = User::create($request->validated());

        //login
        auth()->login($user, true);

        return new JsonResponse(['message' => 'user successfully created'], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->safe()->only(['email', 'password']);
        $remember = $request->safe()->only(['remember']);

        if (auth()->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return new JsonResponse(['message' => 'You are now logged in']);
        }
        return new JsonResponse(['message' => 'Invalid credentials'], 401);
    }

}
