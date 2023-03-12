<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function layout()
    {
        return view('testik.layout');
    }
}
