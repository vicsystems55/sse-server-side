<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\ButtonClickedEvent;

class FireEventController extends Controller
{
    //

    public function fire_event(Request $request)
    {
        # code...

        
        event(new ButtonClickedEvent($request->email));

        return back()->with('msg', 'Message sent!!');

    }

    public function api_fire_event(Request $request)
    {
        # code...

        
        event(new ButtonClickedEvent($request->email));

        return 'sent';

    }
}
