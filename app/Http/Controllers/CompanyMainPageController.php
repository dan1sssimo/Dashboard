<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyMainPageController extends Controller
{
    public function companyPage()
    {
        return view('roles.company_main_page');
    }
}
