<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use APP\Models\InterviewResult;

class ApiController extends Controller
{
    private $ApiToken;
    public function __construct(){
        $this->ApiToken = env("QUALTRICS_API_TOKEN");
    } 
    public function users(Request $request) 
    {
        echo $request->name;
        $usermodel = new User();
        $UserList = $usermodel->getUsersList(); 
        return view('test.index', compact("UserList"));
    }

    public function getInterviewResult() {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://yul1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/responses/R_82PTLMIL1ctcBdn",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => " ",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "X-API-TOKEN: OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy"
            ],
        ]);

        $response = curl_exec($curl);
        var_dump($response);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

}
