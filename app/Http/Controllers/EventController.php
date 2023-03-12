<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MyEvent;

class EventController extends Controller
{
    public function msg(Request $request)
    {
        $name = $request->input('name');
        $msg = $request->input('message');

        return event(new MyEvent($name, $msg));
    }
}
