<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ManagerController extends Controller
{
    public function manager($email) 
    {
        $data = DB::table('users')
            ->select('name')
            ->where('email', $email)
            ->get();
        return view('roles.managerPanel', compact('data'));
    }
}
