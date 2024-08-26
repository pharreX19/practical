<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Auth\AuthenticationException;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->save();
        return response()->json($user, Response::HTTP_CREATED);
    }


    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new AuthenticationException('Invalid credentials');
        }

        $request->session()->regenerate();

        return response()->json(['message' => 'Logged in successfully']);
    }


    public function logout()
    {
        // auth()->user()->tokens()->delete();
        // auth()->user()->logout();
        request()->session()->invalidate();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
