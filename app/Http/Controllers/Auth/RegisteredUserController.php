<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'first_name' => ['required', 'string', 'max:45'],
            'last_name' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()], // password_confirmation 
        ]);
        $user = User::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);
        $token = $user->createToken(strtolower($fields['email']));
        // event(new Registered($user));
        // Auth::login($user);
        return response()->json([
            'message' => 'Registered successfully',
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }
}
