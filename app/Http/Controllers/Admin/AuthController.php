<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
       $validated = $request->validate([
          'email' => 'required|email',
          'password' => 'required|string'
       ]);

       if(auth('admin')->attempt($validated)){
           $user = Admin::where('email', $validated['email'])->first();

           $token = $user->createToken('access_token')->plainTextToken;

           $user['access_token'] = $token;

           return response()->json($user);
       }

       return response()->json(['message' => 'Username or Password is incorrect.'], 403);
    }
}
