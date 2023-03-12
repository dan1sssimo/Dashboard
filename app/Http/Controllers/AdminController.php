<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\Companies;
use App\Mail\CoworkersMsg;
use App\Mail\AdminMsg;
use Illuminate\Support\Facades\Mail;
use App\Imports\UsersImport;
use MongoDB\Driver\Session;

class AdminController extends Controller
{
    public function update_coworkers()
    {
        $company = \Auth::user()->company_title;
        if($company && \Auth::user()->manager === "yes")
        {
            $departments = DB::table("departments_".$company)->select("title")->get();
            $users = DB::table($company)
                ->select('*')
                ->where("manager", "yes")
                ->orWhere("chief", "yes")
                ->orderBy("id", 'asc')
                ->paginate(25);

            return view('roles.adminPanel', ['users' => $users, 'departments' => $departments]);
        }
        else if($company && \Auth::user()->chief === "yes")
        {
            $departments = DB::table("departments_".$company)->select("title")->get();
            $users = DB::table($company)
                ->select('*')
                ->where([["teamlead", "yes"], ["department", DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department")]])
                ->orWhere([["employee", "yes"], ["department", DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department")]])
                ->orderBy("id", 'asc')
                ->paginate(25);

            $manager = DB::table($company)->where([["id", 1], ["manager", "yes"]])->value("name");

            return view('roles.adminPanel', ['users' => $users, 'departments' => $departments, "manager" => $manager]);
        }
        else if($company && \Auth::user()->teamlead === "yes")
        {
            $departments = DB::table("departments_".$company)->select("title")->get();
            $users = DB::table($company)
                ->select('*')
                ->where([["employee", "yes"], ["supervisor", \Auth::user()->name]])
                ->orderBy("id", 'asc')
                ->paginate(25);

            $depo = DB::table($company)->where("email", \Auth::user()->email)->value("department");
            $chief = DB::table($company)->where([["department", $depo], ["chief", "yes"]])->value("name");
            $manager = DB::table($company)->where([["id", 1], ["manager", "yes"]])->value("name");

            return view('roles.adminPanel', ['users' => $users, 'departments' => $departments, "chief" => $chief, "manager" => $manager]);
        }
        else if(\Auth::user()->admin === "yes")
        {
            $users = DB::table('users')
                ->select('*')
                ->where("manager", "yes")
                ->orWhere("admin", "yes")
                ->orderBy("id", 'asc')
                ->paginate(25);

            return view('roles.adminPanel', compact('users'));
        }
    }

    public function usersPagination(Request $request)
    {
        if($request->ajax())
        {
            $company = \Auth::user()->company_title;
            if($company && \Auth::user()->manager === "yes")
            {
                $departments = DB::table("departments_".$company)->select("title")->get();
                $users = DB::table($company)
                    ->select('*')
                    ->where("manager", "yes")
                    ->orWhere("chief", "yes")
                    ->orderBy("id", 'asc')
                    ->paginate(25);

                return view('roles.adminPanel', ['users' => $users, 'departments' => $departments]);
            }
            else if($company && \Auth::user()->teamlead === "yes")
            {
                $departments = DB::table("departments_".$company)->select("title")->get();
                $users = DB::table($company)
                    ->select('*')
                    ->where([["employee", "yes"], ["supervisor", \Auth::user()->name]])
                    ->orderBy("id", 'asc')
                    ->paginate(25);

                return view('roles.adminPanel', ['users' => $users, 'departments' => $departments]);
            }
            else if($company && \Auth::user()->chief === "yes")
            {
                $departments = DB::table("departments_".$company)->select("title")->get();
                $users = DB::table($company)
                    ->select('*')
                    ->where([["teamlead","yes"], ["employee","yes"], ["department", DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department")]])
                    ->orWhere([["employee", "yes"], ["department", DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department")]])
                    ->orderBy("id", 'asc')
                    ->paginate(25);

                return view('roles.adminPanel', ['users' => $users, 'departments' => $departments]);
            }
            else if(\Auth::user()->admin === "yes")
            {
                $users = DB::table('users')
                    ->select('*')
                    ->where("manager", "yes")
                    ->orWhere("admin", "yes")
                    ->orderBy("id", 'asc')
                    ->paginate(25);

                return view('roles.adminPanel', compact('users'));
            }
        }
    }

    public function delete($email)
    {
        $company = \Auth::user()->company_title;
        if($company)
        {
            DB::table($company)->where("email", $email)->delete();
            DB::table('users')->where("email", $email)->delete();
            DB::table('companies')->where("manager_email", $email)->delete();

            $maxUsers = DB::table("users")->max("id") + 1;
            $maxCompanies = DB::table("companies")->max("id") + 1;
            $max = DB::table($company)->max("id") + 1;

            DB::statement("ALTER TABLE users AUTO_INCREMENT = $maxUsers");
            DB::statement("ALTER TABLE companies AUTO_INCREMENT = $maxCompanies");
            DB::statement("ALTER TABLE $company AUTO_INCREMENT = $max");
        } else
        {
            DB::table('users')->where("email", $email)->delete();
            DB::table('companies')->where("chief_email", $email)->delete();

            $maxUsers = DB::table("users")->max("id") + 1;
            $maxCompanies = DB::table("companies")->max("id") + 1;
            $max = DB::table($company)->max("id") + 1;

            DB::statement("ALTER TABLE users AUTO_INCREMENT = $maxUsers");
            DB::statement("ALTER TABLE companies AUTO_INCREMENT = $maxCompanies");
        }

        return response()->redirectTo("/users");
    }

    public function updateUser(Request $r, $email)
    {
        $company = \Auth::user()->company_title;

        $name = $r->name;
        $newEmail = $r->email;
        $manager = $r->manager;
        $chief = $r->chief;
        $teamlead = $r->teamlead;
        $employee = $r->employee;
        $department = $r->department;
        $supervisor = $r->supervisor;

        if($company)
        {
            DB::table($company)
                ->where("email", $email)
                ->update(["name" => $name, "email" => $newEmail, "manager" => $manager, "chief" => $chief, "teamlead" => $teamlead, 'employee' => $employee, 'department' => $department, 'supervisor' => $supervisor]);

            DB::table('users')
                ->where("email", $email)
                ->update(["name" => $name, "email" => $newEmail, "manager" => $manager, "chief" => $chief, "teamlead" => $teamlead, 'employee' => $employee, "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);
        } else {
            DB::table('users')
                ->where("email", $email)
                ->update(["name" => $name, "email" => $newEmail, "manager" => $manager, "chief" => $chief, "teamlead" => $teamlead, 'employee' => $employee, "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);
        }

        if($employee == "yes")
        {
            User::where("email", $email)->update(["tariff" => 0]);
        } else
        {
            User::where("email", $email)->update(["tariff" => 1]);
        }

        if($employee == "yes" || $teamlead == "yes" || $chief == "yes")
        {
            Companies::where("manager_email", $email)->delete();
            $maxCompanies = DB::table("companies")->max("id") + 1;
            DB::statement("ALTER TABLE companies AUTO_INCREMENT = $maxCompanies");
        } else {
            \DB::table('companies')->insert([
                "title" => $company,
                "manager" => $name,
                "manager_email" => $newEmail
            ]);
        }

        return response()->json(['result' => 'Data updated!']);
    }

    public function add_worker(Request $request)
    {
        if($request->employee == "yes")
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->company_title = \Auth::user()->company_title;
            $user->manager = $request->manager;
            $user->teamlead = $request->teamlead;
            $user->employee = $request->employee;
            $user->chief = $request->chief;
            $user->save();
        }
        else
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->company_title = \Auth::user()->company_title;
            $user->manager = $request->manager;
            $user->teamlead = $request->teamlead;
            $user->employee = $request->employee;
            $user->chief = $request->chief;
            $user->tariff = (\Auth::user()->tariff === 1) ? 1:0;
            $user->save();
        }

        $company = \Auth::user()->company_title;

        if($company)
        {
            DB::table($company)->insert([
                "name" => $request->name,
                "email" => $request->email,
                "employee" => $request->employee,
                "manager" => $request->manager,
                "teamlead" => $request->teamlead,
                "chief" => $request->chief,
                "supervisor" => (\Auth::user()->chief == "yes" || \Auth::user()->manager == "yes") ? "" : \Auth::user()->name,
                "department" => (\Auth::user()->manager === "yes") ? $request->department : DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department")
            ]);

            if($request->chief == "yes")
            {
                $status = "department chief";
                $link = env('LOGIN_URL');
                $test = env('TEST_URL');
                Mail::to($request->email)->send(new AdminMsg($request->name, $link, $request->email, $request->password, $company, $status, $test, $request->department));
            }

            else if($request->teamlead == "yes")
            {
                $status = "teamlead";
                $link = env('LOGIN_URL');
                $test = env('TEST_URL');
                $department = DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department");
                Mail::to($request->email)->send(new AdminMsg($request->name, $link, $request->email, $request->password, $company, $status, $test, $department));
            }

            else if($request->manager == "yes")
            {

                if(Companies::where("manager_email", $request->email)->first())
                {
                    Companies::where("manager_email", $request->email)->update([
                        "title" => \Auth::user()->company_title,
                        "manager" => $request->name,
                        "manager_email" => $request->email
                    ]);
                }

                else
                {
                    Companies::where("manager_email", $request->email)->insert([
                        "title" => \Auth::user()->company_title,
                        "manager" => $request->name,
                        "manager_email" => $request->email]);
                }

                $status = "company manager";
                $link = env('LOGIN_URL');
                $test = 0;
                Mail::to($request->email)->send(new AdminMsg($request->name, $link, $request->email, $request->password, $company, $status, $test, $request->department));
            }

            else
            {
                $department = DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department");
                $supervisor = (\Auth::user()->teamlead === "yes") ? \Auth::user()->name : null;
                $company = \Auth::user()->company_title;
                // $link = env('TEST_URL');
                Mail::to($request->email)->send(new CoworkersMsg($request->name, $department, $supervisor, $company));
            }
        }

        return response()->json(['success' => "New worker added!"]);
    }

    public function companies()
    {
        $companies = DB::table('companies')->get();
        return view('roles.companies', compact('companies'));
    }

    public function addCompanies(Request $request)
    {
        $managerEmail = Companies::where("manager_email", $request->input("email"))->first();
        if($managerEmail)
        {
            $companyOldName = Companies::where("manager_email", $request->input("email"))->value("title");
            if(\Schema::hasTable($companyOldName) && $companyOldName != $request->input("title"))
            {
                \Schema::rename($companyOldName, $request->input("title"));

                DB::table($request->input("title"))->where("email", $request->input("email"))
                    ->update(["name"=>$request->input("manager"), "email"=>$request->input("email"), "manager" => "yes"]);

                DB::table("companies")->where("manager_email", $request->input("email"))->update([
                    "title" => $request->input("title"),
                    "manager" => $request->input("chief"),
                    "manager_email" => $request->input("email"),
                ]);
                DB::table("users")
                    ->where("email", $request->input("email"))
                    ->update(["chief" => "no", "manager" => "yes", "company_title" => $request->input("title"), "name" => $request->input("chief"), "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);
            } else {
                DB::table($request->input("title"))->where("email", $request->input("email"))
                    ->update(["name"=>$request->input("chief"), "manager" => "yes"]);

                DB::table("companies")->where("manager_email", $request->input("email"))->update([
                    "title" => $request->input("title"),
                    "manager" => $request->input("chief"),
                    "manager_email" => $request->input("email"),
                ]);
                DB::table("users")
                    ->where("email", $request->input("email"))
                    ->update(["chief" => "no", "manager" => "yes", "company_title" => $request->input("title"), "name" => $request->input("chief"), "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);
            }

            if(!(\Schema::hasTable("departments_".$request->input("title"))))
            {
                \Schema::create("departments_".$request->input("title"), function($table)
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
                    \DB::table("departments_".$request->input("title"))->insert([
                        "title" => $title
                    ]);
                }
            }
        }

        else
        {
            $company = new Companies();
            $company->title = $request->input("title");
            $company->manager = $request->input("chief");
            $company->manager_email = $request->input("email");
            $company->save();

            DB::table("users")->insert([
                "name" => $request->input("chief"),
                "email" => $request->input("email"),
                "manager" => "yes",
                "company_title" => $request->input("title"),
                "tariff" => 0,
                "password" => Hash::make($request->input("email")),
            ]);

            if(\Schema::hasTable($request->input("title")))
            {
                DB::table($request->input("title"))
                    ->insert(["name"=>$request->input("chief"), "email"=>$request->input("email"), "manager" => "yes"]);
            }

            else
            {
                \Schema::create($request->input("title"), function($table)
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

                DB::table($request->input("title"))
                    ->insert(["name"=>$request->input("chief"), "email"=>$request->input("email"), "manager" => "yes"]);
            }

            if(!(\Schema::hasTable("departments_".$request->input("title"))))
            {
                \Schema::create("departments_".$request->input("title"), function($table)
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
                    \DB::table("departments_".$request->input("title"))->insert([
                        "title" => $title
                    ]);
                }
            }
        }

        $link = env('LOGIN_URL');
        $test = 0;
        $department = DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department");
        \Mail::to($request->input("email"))->send(new AdminMsg($request->input("chief"), $link, $request->input("email"), $request->input("email"), $request->input("title"), "company manager", $test, $department));

        return response()->redirectToRoute("add-company");
    }

    public function updateCompanyTitle(Request $request, $title)
    {
        if($title === $request->input("newTitle"))
        {
            return back();
        }

        else {
            $newTitle = $request->input("newTitle");
            DB::table("users")->where("company_title", $title)->update(["company_title" => $newTitle]);
            DB::table("companies")->where("title", $title)->update(["title" => $newTitle]);

            \Schema::rename($title, $newTitle);
            \Schema::rename("departments_" . $title, "departments_" . $newTitle);

            return back();
        }


    }

    public function deleteCompany($title)
    {
        DB::table("users")->where("company_title", $title)->delete();
        $maxUsers = DB::table("users")->max("id") + 1;
        DB::statement("ALTER TABLE users AUTO_INCREMENT = $maxUsers");

        DB::table("companies")->where("title", $title)->delete();
        $maxCompanies = DB::table("companies")->max("id") + 1;
        DB::statement("ALTER TABLE companies AUTO_INCREMENT = $maxCompanies");

        \Schema::dropIfExists($title);
        \Schema::dropIfExists("departments_".$title);

        return back();
    }

    public function deleteCompanyManager($email)
    {
        $co = DB::table("users")->where("email", $email)->value("company_title");
        DB::table($co)->where("email", $email)->delete();
        $max = DB::table($co)->max("id") + 1;
        DB::statement("ALTER TABLE $co AUTO_INCREMENT = $max");

        if(DB::table($co)->where("manager", "yes")->count() === 0)
        {
            \Schema::dropIfExists($co);
            \Schema::dropIfExists("departments_".$co);
        }

        DB::table("users")->where("email", $email)->delete();
        $maxUsers = DB::table("users")->max("id") + 1;
        DB::statement("ALTER TABLE users AUTO_INCREMENT = $maxUsers");

        DB::table("companies")->where("manager_email", $email)->delete();
        $maxCompanies = DB::table("companies")->max("id") + 1;
        DB::statement("ALTER TABLE companies AUTO_INCREMENT = $maxCompanies");

        return back();
    }

    public function test($email)
    {
        $name = DB::table("users")->where("email", $email)->value("name");
        $email = DB::table("users")->where("email", $email)->value("email");
        $company = DB::table("users")->where("email", $email)->value("company_title");
        $supervisor = DB::table($company)->where("email", $email)->value("supervisor");
        $manager = DB::table($company)->where("id", 1)->value("name");
        $department = DB::table($company)->where("email", $email)->value("department");

        return view('test', ['name' => $name, 'email' => $email, 'company' => $company, 'supervisor' => $supervisor, 'manager' => $manager, 'department' => $department]);
    }

    public function manager_status(Request $r, $email)
    {
        $company = \Auth::user()->company_title;

        if($company)
        {
            DB::table('users')
                ->where('email', $r->email)
                ->update(['manager' => "yes", 'chief' => "no", 'teamlead' => "no", 'employee' => "no", "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);

            DB::table($company)
                ->where('email', $r->email)
                ->update(['manager' => "yes", 'chief' => "no", 'teamlead' => "no", 'employee' => "no", "department" => ""]);
        } else {
            DB::table('users')
                ->where('email', $r->email)
                ->update(['manager' => "yes", 'chief' => "no", 'teamlead' => "no", 'employee' => "no", "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);
        }

        $newChiefName = User::where("email", $r->email)->value("name");
        DB::table('companies')->insert([
            "title" => $company,
            "manager" => $newChiefName,
            "manager_email" => $r->email,
        ]);

        return response()->json(['success' => 'success']);
    }

    public function teamlead_status(Request $r, $email)
    {
        $company = \Auth::user()->company_title;

        if($company) {
            DB::table('users')
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "no", 'teamlead' => "yes", 'employee' => "no", "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);

            DB::table($company)
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "no", 'teamlead' => "yes", 'employee' => "no"]);
        } else {
            DB::table('users')
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "no", 'teamlead' => "yes", "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);
        }

        $chief = Companies::where("manager_email", $email)->first();
        if($chief)
        {
            Companies::where("manager_email", $email)->delete();
            $maxCompanies = DB::table("companies")->max("id") + 1;
            DB::statement("ALTER TABLE companies AUTO_INCREMENT = $maxCompanies");
        }

        return response()->json(['success' => 'success']);
    }
    public function chief_status(Request $r, $email)
    {
        $company = \Auth::user()->company_title;

        if($company) {
            DB::table('users')
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "yes", 'teamlead' => "no", "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);

            DB::table($company)
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "yes", 'teamlead' => "no"]);
        } else {
            DB::table('users')
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "yes", 'teamlead' => "no", "tariff" => (\Auth::user()->tariff === 1) ? 1:0,]);
        }

        $chief = Companies::where("manager_email", $email)->first();
        if($chief)
        {
            $maxCompanies = DB::table("companies")->max("id") + 1;
            Companies::where("manager_email", $email)->delete();
            DB::statement("ALTER TABLE companies AUTO_INCREMENT = $maxCompanies");
        }

        return response()->json(['success' => 'success']);
    }

    public function employee_status(Request $r, $email)
    {
        $company = \Auth::user()->company_title;

        if($company) {
            DB::table('users')
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "no", 'teamlead' => "no", 'employee' => "yes", "tariff" => 0]);

            DB::table($company)
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "no", 'teamlead' => "no", 'employee' => "yes"]);
        } else {
            DB::table('users')
                ->where('email', $r->email)
                ->update(['manager' => "no", 'chief' => "no", 'teamlead' => "no", 'employee' => "yes", "tariff" => 0]);
        }

        $chief = Companies::where("manager_email", $email)->first();
        if($chief)
        {
            Companies::where("manager_email", $email)->delete();
            $maxCompanies = DB::table("companies")->max("id") + 1;
            DB::statement("ALTER TABLE companies AUTO_INCREMENT = $maxCompanies");
        }

        return response()->json(['success' => 'success']);
    }

    public function uploaded_users(Request $request)
    {
        try {
            \Excel::import(new UsersImport, $request->file('file'));
            return back();
        } catch (\Illuminate\Validation\ValidationException $e) {
//            return redirect("/import-error");
            \Session::put('error', 'message');
            return redirect()->back();
        }
    }

    public function departments()
    {
        $departments = DB::table('departments_'.\Auth::user()->company_title)->select("id", "title")->orderBy("id", "asc")->get();
        return view("roles.departments", ["departments" => $departments]);
    }

    public function addDepartment(Request $request)
    {
        if($request->input("title") == "")
        {
            back();
        }

        else
        {
            DB::table('departments_'.\Auth::user()->company_title)->insert([
                "title" => $request->input("title")
            ]);
        }

        return back();
    }

    public function deleteDepartment($title)
    {
        DB::table('departments_'.\Auth::user()->company_title)->where("title", $title)->delete();
        DB::table(\Auth::user()->company_title)->where("department", $title)->update(["department" => ""]);
        return back();
    }

    public function updateDepartment(Request $request, $title)
    {
        if($request->input("newTitle") == "")
        {
            DB::table('departments_'.\Auth::user()->company_title)->where("title", $title)->update(["title" => $title]);
            return back();
        }

        else
        {
            DB::table('departments_'.\Auth::user()->company_title)->where("title", $title)->update(["title" => $request->input("newTitle")]);
            return back();
        }

    }

    public function updateCompanyManager(Request $request, $manager)
    {
        $company = Companies::where("manager", $manager)->value("title");
        DB::table($company)->where("name", $manager)->update(["name" => $request->input("newManager")]);
        DB::table("users")->where("name", $manager)->update(["name" => $request->input("newManager")]);
        DB::table("companies")->where("manager", $manager)->update(["manager" => $request->input("newManager")]);

        return back();
    }

    public function updateCompanyManagerEmail(Request $request, $manager_email)
    {
        $company = Companies::where("manager_email", $manager_email)->value("title");
        DB::table($company)->where("email", $manager_email)->update(["email" => $request->input("newManagerEmail")]);
        DB::table("users")->where("email", $manager_email)->update(["email" => $request->input("newManagerEmail")]);
        DB::table("companies")->where("manager_email", $manager_email)->update(["manager_email" => $request->input("newManagerEmail")]);

        return back();
    }

    public function changeName_chief(Request $request, $name)
    {
        $company = DB::table("users")->where("name", $name)->value("company_title");
        $newName = $request->name;
        DB::table($company)->where("name", $name)->update(["name" => $newName]);
        DB::table("users")->where("name", $name)->update(["name" => $newName]);

        return response()->json(["success" => "$name is $newName now!"]);
    }

    public function changeEmail_chief(Request $request, $email)
    {
        $company = DB::table("users")->where("email", $email)->value("company_title");
        $newEmail = $request->email;
        DB::table($company)->where("email", $email)->update(["email" => $newEmail]);
        DB::table("users")->where("email", $email)->update(["email" => $newEmail]);

        return response()->json(["success" => "$email is $newEmail now!"]);
    }


}
