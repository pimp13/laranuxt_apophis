<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // $request->authenticate();
        // $request->session()->regenerate();
        // return response()->noContent();
        $request->validate([
            "email" => ["required", "email", "exists:users,email"],
            'password' => ['required', Password::min(8)->letters()->numbers()],
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'کلمه عبور یا آدرس ایمیل نادرست میباشد.'
            ]);
        }
        $token = $user->createToken(strtolower($user->email));
        return response()->json([
            'message' => 'Login user is successfully',
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => "You are logged out."
        ]);
    }
}
