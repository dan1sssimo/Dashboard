<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use App\Imports\UsersImport;
use App\Models\Companies;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->admin !== "yes" && Auth::user()->password !== "user")
        {
            $department = \DB::table(Auth::user()->company_title)->where("email", Auth::user()->email)->value("department");
            $department_d = str_replace("&amp;", "&", $department);
            $departments = \DB::table(Auth::user()->company_title)->where([["department", "!=", NULL],["department", "!=", ""]])->get();
            $teamleads = \DB::table(Auth::user()->company_title)->where("teamlead", "yes")->get();
            return view('home', ["department" => $department_d, "departments" => $departments->unique("department"), "teamleads" => $teamleads]);
        }

        else if(Auth::user()->admin === "yes")
        {
            $companies = \DB::table("companies")->select("title")->get();
            return view("home", ['companies' => $companies->unique()]);
        }

        return view('home');
    }

    public function updatePassword(Request $request, $email)
    {
        \DB::table("users")->where("email", $email)->update([
            "company_title" => $request->input("company_title"),
            "password" => Hash::make($request->input("new_password")),
            "manager" => "yes"
        ]);

        if(\Schema::hasTable($request->input("company_title")))
        {
            \DB::table($request->input("company_title"))->where("email", $email)
                ->update(["name" => \Auth::user()->name, "email" => $email, "manager" => "yes"]);
        } else
        {
            \Schema::create($request->input("company_title"), function($table)
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

            \DB::table($request->input("company_title"))->insert([
                "name" => \Auth::user()->name,
                "email" => $email,
                "manager" => "yes"
            ]);

            \Schema::create("departments_".$request->input("company_title"), function($table)
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
                \DB::table("departments_".$request->input("company_title"))->insert([
                    "title" => $title
                ]);
            }
        }




        if(Companies::where("manager_email", $email)->first())
        {
            \DB::table('companies')->where("manager_email", $email)->update([
                "title" => $request->input("company_title"),
                "manager" => \Auth::user()->name,
                "manager_email" => $email
            ]);
        } else
        {
            \DB::table('companies')->insert([
                "title" => $request->input("company_title"),
                "manager" => \Auth::user()->name,
                "manager_email" => $email
            ]);
        }

        return response()->redirectTo('home');
    }
}
