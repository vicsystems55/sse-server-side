<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserProfileController extends Controller
{
    //

    public function userData(Request $request)
    {
        # code...

        $user = User::find($request->user()->id);

        return $user;


    }

    public function welcome(Request $request)
    {
        # code...

        $users = User::latest()->get();


        return view('welcome',[
            'users' => $users
        ]);
    }
}
