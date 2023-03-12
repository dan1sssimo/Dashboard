<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Schema;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
        register as baseRegister;
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company_title' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::where('email', '=', $data['email'])->first();

        if ($user === null) {

            if(!Schema::hasTable($data['company_title']))
            {
                Schema::create($data['company_title'], function($table)
                {
                    $table->increments('id');
                    $table->string("name");
                    $table->string("email")->unique();
                    $table->string("department")->nullable();
                    $table->string("supervisor")->nullable();
                    $table->string("chief")->nullable();
                    $table->string("manager")->nullable();
                    $table->string("teamlead")->nullable();
                    $table->string("employee")->nullable();
                });
            }

            if(!Schema::hasTable("departments_".$data['company_title']))
            {
                Schema::create("departments_".$data['company_title'], function($table)
                {
                    $table->increments('id');
                    $table->string("title");
                });

                $titles = array(
                    "Marketing & Proposals Department",
                    "Sales Department",
                    "Project Department",
                    "Designing Department",
                    "Production Department",
                    "Maintenance Department",
                    "Store Department",
                    "Procurement Department",
                    "Quality Department",
                    "Inspection department",
                    "Packaging Department",
                    "Finance Department",
                    "Dispatch Department",
                    "Account Department",
                    "Research & Development Department",
                    "Information Technology Department",
                    "Human Resource Department",
                    "Security Department",
                    "Administration department"
                );

                foreach($titles as $title)
                {
                    \DB::table("departments_".$data["company_title"])->insert([
                        "title" => $title
                    ]);
                }
            }

            if(\DB::table($data['company_title'])->where("email", $data["email"])->first())
            {
                \DB::table($data['company_title'])->update([
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "manager" => "yes"
                ]);
            }
            else
            {
                \DB::table($data['company_title'])->insert([
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "manager" => "yes"
                ]);
            }

            if(\DB::table("companies")->where("manager_email", $data["email"])->first())
            {
                \DB::table("companies")->update([
                    "title" => $data['company_title'],
                    "manager" => $data["name"],
                    "manager_email" => $data["email"],
                ]);
            }
            else
            {
                \DB::table("companies")->insert([
                    "title" => $data['company_title'],
                    "manager" => $data["name"],
                    "manager_email" => $data["email"],
                ]);
            }

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'company_title' => $data['company_title'],
                'manager' => "yes",
                'password' => Hash::make($data['password']),
            ]);
        }
    }

    public function terminate($request, $response)
    {
        if ($this->sessionHandled() && $this->sessionConfigured() && ! $this->usingCookieSessions())
        {
            $this->manager->driver()->save();
        }
    }

    public function register(Request $request)
    {
        $notification = array(
            'message' => "Existed Email or Incorrect Password",
            'alert-type' => 'error'
        );
        try {
            return $this->baseRegister($request);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return view('auth.register', compact('notification'));
        }

    }
}
