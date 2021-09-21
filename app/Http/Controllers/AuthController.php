<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    function register(Request $request)
    {
        $data = $request->validate([
            'name' =>' required',
            'email' =>' required|unique:users,email,',
            'balance' =>'nullable|integer',
            'account_id' => 'nullable|unique:users,account_id,',
            'password' => 'required|string|confirmed',
        ]);
        $account_id = Str::random(10);
        $data['account_id'] = strtoupper($account_id);
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);



    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        $message = 'Logout successfully';
        return $message;
    }
}
