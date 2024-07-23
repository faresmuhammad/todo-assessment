<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    /**
     * Store a new user in the database
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        //validate the request
        //store user in the database
        $user = User::create($request->validated());

        //login
        auth()->login($user, true);

        return new JsonResponse(['message' => 'user successfully created'], 201);
    }

    /**
     * Authenticate a user
     * @param LoginRequest $request
     * @return JsonResponse
     */
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

    /**
     * Logout the authenticated user
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return new JsonResponse(['message' => 'You are now logged out']);
    }
}
