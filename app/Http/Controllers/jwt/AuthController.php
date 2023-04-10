<?php

namespace App\Http\Controllers\jwt;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function __construct()
    {

        Config::set('auth.defaults.guard', 'api');

        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        // return $request;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $token = Str::random(60);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
