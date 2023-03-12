<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContuctUs;
use Illuminate\Support\Facades\Mail;

class ContuctUsController extends Controller
{
    public function index()
    {
        return view('ContuctUs');
    }

    public function sendForm(Request $r)
    {
        $toEmail = "empulse@wercinstitute.org";
        $name = $r->input('name');
        $email = $r->input('email');
        $phone = $r->input('phone');
        Mail::to($toEmail)->send(new ContuctUs($name, $email, $phone));

        sleep(4);
        return redirect('home');
    }

    public function response()
    {
        return view('ContuctUs-response');
    }

}
