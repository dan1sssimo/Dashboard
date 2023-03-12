<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class TeamleadController extends Controller
{
    public function teamlead($email) 
    {
        $data = DB::table('users')
            ->select('name')
            ->where('email', $email)
            ->get();
        return view('roles.teamleadPanel', compact('data'));
    }
}
