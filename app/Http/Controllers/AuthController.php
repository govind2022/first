<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate=$request ->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:8',
        ]);
        $user=User::create([
            'name'=>$validate['name'],
            'email'=>$validate['email'],
            'password'=>Hash::make($validate['password']),
        ]);
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Create Register successfully',
        ]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
            'message' => 'Invalid login details'
                       ], 401);
                   }
            
            $user = User::where('email', $request['email'])->firstOrFail();
            
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                       'access_token' => $token,
                       'token_type' => 'Login Create successfully',
            ]);
            }
            public function logout(Request $request)
            {
                Auth::logout();
                $user[] =  "logged out";
                return response()->json([
                    'access_token'=>$user,
                    'token_type'=>'Successfully logged out.',
                ]);
                
            }
}
