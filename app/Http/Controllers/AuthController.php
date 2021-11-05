<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User as Users;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (!Auth::attempt($login)) {
            return response()->json(401);
        }

        return response()->json([
            'token' => auth()->user()->createToken('token')->plainTextToken
        ]);
    }

    public function getUsers(Request $request)
    {
        /* return response()->json([
            'ca passe bien ici'
        ]); */
        return new Users($request->user());
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'Effectué' => 'Token detruit'
        ];
    }
}
