<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        $user = Auth::user();
        $user->api_token = $token;

        return response()->json($user);
    }

    public function register(Request $request)
    {
        // return $request;
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $token = Str::random(60);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'api_token' => hash('sha256', $token),
        ]);

        $token = Auth::login($user);
        $user->api_token = $token;
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'User created successfully',
        //     $user,
        //     'authorisation' => [
        //         'token' => $token,
        //         'type' => 'bearer',
        //     ]
        // ]);
        return response()->json($user);
    }

    public function verify_token(Request $request)
    {
        $token = trim(str_replace('Bearer', '', $request->header('authorization')));
        $user = Auth::user();
        $user->api_token = $token;
        // return response()->json([
        //     'status' => 'success',
        //      $user,
        //     'authorisation' => [
        //         'token' => $token,
        //         'type' => 'bearer',
        //     ]
        // ]);
        return response()->json($user);
    }
    public function refresh()
    {
        $user = Auth::user();
        $token = Auth::login($user);
        $user->api_token = $token;
        return response()->json($user);
    }
    public function logout()
    {
        try {
            Auth::logout();
        } catch (Throwable $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'logout faild'
            ]);
        }
        return response()->json(['success' => 'Successfully logged out'], 200);
    }
}
