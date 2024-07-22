<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
   public function register(Request $request)
    {
        $formData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
  
        $formData['password'] = bcrypt($request->password);
  
        $user = User::create($formData);        
  
        return response()->json([ 
            'user' => $user, 
            'message' => "Registration is Successful"
        ], 200);
          
    }

    public function login(Request $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];
  
        if (Auth::attempt($credentials)) 
        {
            $token = Auth::user()->createToken('passportToken')->accessToken;
             
            return response()->json([
                'user' => Auth::user(), 
                'token' => $token
            ], 200);
        }
  
        return response()->json([
            'error' => 'Unauthorised'
        ], 401);
  
    }

    public function user(){
        if (Auth::user()) {
            return response()->json([ 
                'user_details' => auth()->user(),
                'message' => 'User retrieved successfully.'
            ]);
        }
    }

    public function logout()
    {
        if (Auth::user()) {
            auth()->user()->token()->revoke();
            return response()->json([
                'message' => 'User logout successfully.'
            ]);
        }
    }
}
