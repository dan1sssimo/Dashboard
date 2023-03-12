<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Schema;

class PaymentController extends Controller
{
    public function payment()
    {
        return view('payment');
    }

    public function responses()
    {
        return view('responses');
    }

    public function responses_error()
    {
        return view('responses_error');
    }

    public function stripe(Request $request)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.stripe.com/v1/charges',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer sk_test_51LxWB4EUQY6PFC8sn89WkNaPnjUY4cWeYQxNb6lnWDgms0QArO6D0Gr6YvXMgGcWreNvD0OTXMfS3wz67x6CWNYL00x1tm0x4o'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        $amount = $result['data'][0]['amount'];

        try
        {
            if($amount == 19900 || $amount == 89900)
            {
                DB::table("users")->where("company_title", \Auth::user()->company_title)->update(["tariff" => 1]);
                return redirect('/home/response');
            }

            else
            {
                return redirect('/home/response_error');
            }
        }

        catch(\Exception $e)
        {
            return $e->getMessage();
        }

    }
}
