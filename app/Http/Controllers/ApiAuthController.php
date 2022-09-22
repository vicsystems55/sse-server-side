<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

use Auth;

class ApiAuthController extends Controller
{
    //

    public function register(Request $request)
    {

        try {
            //code...

                    
            $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'username' => 'required|string|max:255',
           
            'email' => 'required|string|email|max:255|unique:users',
            // 'referrer_code' => 'required',
            'password' => 'required|string|min:8',
            ]);


                
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);


        $token = $user->createToken('auth_token')->plainTextToken;
            
        return response()->json([
                    'access_token' => $token,
                    'user_data' => $user,
                    'token_type' => 'Bearer',
        ]);

        } catch (\Throwable $th) {
            //throw $th;

            return $th;
        }
            

    }



    public function login(Request $request)
    {
        # code...


        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
            'message' => 'Invalid login details'
                       ], 401);
        }else{

            $user = User::where('email', $request['email'])->firstOrFail();
            
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                       'access_token' => $token,
                       'user_data' => $user,
                       'token_type' => 'Bearer',
            ]);

        }
            

    }

}
