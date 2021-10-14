<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate(20));
    }
    public function customers()
    {
        return UserResource::collection(User::where('status',1)->paginate(20));
    }
    public function show(User $user)
    {
        return UserResource::collection(User::find($user));
    }
    /**
     * Register
     */
    public function register(Request $request)
    {
        // var_dump($request->name);
        $request->validate([
             'name' => ['required'],
             'email' => ['required', 'email', 'unique:users'],
             'password' => ['required', 'min:8', 'confirmed']
         ]);

         User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password)
         ]);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        }

        /* throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.']
        ]); */
    }

    public function logout()
    {
        Auth::logout();
    }
}