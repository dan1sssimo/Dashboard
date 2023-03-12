<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Companies;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Mail\CoworkersMsg;
use App\Mail\AdminMsg;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UsersImport implements ToModel, WithLimit, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function rules(): array
    {
        if(\Auth::user()->manager === "yes")
        {
            return [
                "name" => "required",
                'email' => "required",
                'company_manager' => "required",
                // 'teamlead' => "required",
                // 'employee' => "required",
                'department_chief' => "required",
                // 'department' => "required",
            ];
        }
        else if(\Auth::user()->chief == "yes")
        {
            return [
                "name" => "required",
                'email' => "required",
                // 'company_manager' => "required",
                'teamlead' => "required",
                'employee' => "required",
                // 'department_chief' => "required",
                // 'department' => "required",
            ];
        }
        else if(\Auth::user()->teamlead == "yes")
        {
            return [
                "name" => "required",
                'email' => "required",
                // 'company_manager' => "required",
                // 'teamlead' => "required",
                'employee' => "required",
                // 'department_chief' => "required",
                'department' => "required",
            ];
        }

        else
        {
            return [
                "name" => "required",
                'email' => "required",
                'company_manager' => "required",
                'teamlead' => "required",
                'employee' => "required",
                'department_chief' => "required",
                'department' => "required",
            ];
        }
    }

    public function customValidationMessages()
    {
        if(\Auth::user()->manager == "yes")
        {
            return [
                "name.required" => "Error",
                "email.required" => "Error",
                "company_manager.required" => "Error",
                // "teamlead.required" => "Error",
                // "employee.required" => "Error",
                "department_chief.required" => "Error",
                'department.required' => "Error",
            ];
        }

        else if(\Auth::user()->chief == "yes")
        {
            return [
                "name.required" => "Error",
                "email.required" => "Error",
                // "company_manager.required" => "Error",
                "teamlead.required" => "Error",
                "employee.required" => "Error",
                "department_chief.required" => "Error",
                // 'department.required' => "Error",
            ];
        }

        else if(\Auth::user()->teamlead == "yes")
        {
            return [
                "name.required" => "Error",
                "email.required" => "Error",
                // "company_manager.required" => "Error",
                // "teamlead.required" => "Error",
                "employee.required" => "Error",
                // "department_chief.required" => "Error",
                'department.required' => "Error",
            ];
        }

    }

    public function model(array $row)
    {
        if(\Auth::user()->manager === "yes")
        {
            $name = $row['name'];
            $email = $row['email'];
            $password = Hash::make($row['email']);
            $manager = $row['company_manager'];
            $teamlead = "no";
            $employee = "no";
            $chief = $row['department_chief'];
            $department = ($row['department'] != "") ? $row['department'] : "";

            if($manager == "yes")
            {
                $companyName = \Auth::user()->company_title;
                if(Companies::where("manager_email", $email)->first())
                {
                    DB::table('companies')->where("manager_email", $email)->update([
                        "title" => $companyName,
                        "manager" => $row['name'],
                        "manager_email" => $row['email']
                    ]);
                }
                else
                {
                    DB::table('companies')->insert([
                        "title" => $companyName,
                        "manager" => $row['name'],
                        "manager_email" => $row['email']
                    ]);
                }

                $link = env('LOGIN_URL');
                $test = 0;
                Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "company manager", $test, $department));
            }

            else if($chief == "yes")
            {
                $link = env('LOGIN_URL');
                $test = env('TEST_URL');
                Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "department chief", $test, $department));
            }

            $usersEmail = User::where("email", $email)->first();
            if($usersEmail)
            {
                DB::table(\Auth::user()->company_title)->where('email', $email)->update([
                    'name' => $name,
                    'manager' => $manager ?? null,
                    'teamlead' => $teamlead ?? null,
                    'employee' => $employee ?? null,
                    'chief' => $chief ?? null,
                    'department' => $department,
                    'supervisor' => "",
                ]);

                DB::table('users')
                    ->where('email', $email)
                    ->update([
                        'name' => $name,
                        'password' => $password,
                        'company_title' => \Auth::user()->company_title,
                        'manager' => $manager ?? null,
                        'teamlead' => $teamlead ?? null,
                        'employee' => $employee ?? null,
                        'chief' => $chief ?? null,
                        "tariff" => (\Auth::user()->tariff === 1) ? ($employee == "no") ? 1:0 : 0
                    ]);
            }

            else
            {
                DB::table(\Auth::user()->company_title)->insert(
                    ["name" => $name, "email" => $email, "manager" => $manager, "teamlead" => $teamlead, "employee" => $employee, "chief" => $chief, "department" => $department]);

                DB::table('users')
                    ->insert([
                        'name' => $name,
                        'password' => $password,
                        'company_title' => \Auth::user()->company_title,
                        'email' => $email,
                        'manager' => $manager ?? null,
                        'teamlead' => $teamlead ?? null,
                        'employee' => $employee ?? null,
                        'chief' => $chief ?? null,
                        "tariff" => (\Auth::user()->tariff === 1) ? ($employee == "no") ? 1:0 : 0
                    ]);
            }

            if($department == "" || DB::table("departments_".\Auth::user()->company_title)->where("title", $department)->first())
            {
                /* ... */
            }

            else
            {
                DB::table("departments_".\Auth::user()->company_title)->insert(['title'=> $department]);
            }
        }

        else if(\Auth::user()->chief == "yes")
        {
            $name = $row['name'];
            $email = $row['email'];
            $password = Hash::make($row['email']);
            $manager = "no";
            $teamlead = $row["teamlead"];
            $employee = $row["employee"];
            $chief = "no";
            $department = ($row['department'] != "") ? $row['department'] : "";

            if($manager == "yes")
            {
                $companyName = \Auth::user()->company_title;
                if(Companies::where("manager_email", $email)->first())
                {
                    DB::table('companies')->where("manager_email", $email)->update([
                        "title" => $companyName,
                        "manager" => $row['name'],
                        "manager_email" => $row['email']
                    ]);
                }
                else
                {
                    DB::table('companies')->insert([
                        "title" => $companyName,
                        "manager" => $row['name'],
                        "manager_email" => $row['email']
                    ]);
                }

                $link = env('LOGIN_URL');
                $test = 0;
                Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "company manager", $test, $department));
            }

            else if($chief == "yes")
            {
                $link = env('LOGIN_URL');
                $test = env('TEST_URL');
                Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "department chief", $test, $department));
            }

            $usersEmail = User::where("email", $email)->first();
            if($usersEmail)
            {
                DB::table(\Auth::user()->company_title)->where('email', $email)->update([
                    'name' => $name,
                    'manager' => $manager ?? null,
                    'teamlead' => $teamlead ?? null,
                    'employee' => $employee ?? null,
                    'chief' => $chief ?? null,
                    'department' => $department,
                    "supervisor" => "",
                ]);

                DB::table('users')
                    ->where('email', $email)
                    ->update([
                        'name' => $name,
                        'password' => $password,
                        'company_title' => \Auth::user()->company_title,
                        'manager' => $manager ?? null,
                        'teamlead' => $teamlead ?? null,
                        'employee' => $employee ?? null,
                        'chief' => $chief ?? null,
                        "tariff" => (\Auth::user()->tariff === 1) ? ($employee == "no") ? 1:0 : 0
                    ]);
            }

            else
            {
                DB::table(\Auth::user()->company_title)->insert(
                    ["name" => $name, "email" => $email, "manager" => $manager, "teamlead" => $teamlead, "employee" => $employee, "chief" => $chief, "department" => $department]);

                DB::table('users')
                    ->insert([
                        'name' => $name,
                        'password' => $password,
                        'company_title' => \Auth::user()->company_title,
                        'email' => $email,
                        'manager' => $manager ?? null,
                        'teamlead' => $teamlead ?? null,
                        'employee' => $employee ?? null,
                        'chief' => $chief ?? null,
                        "tariff" => (\Auth::user()->tariff === 1) ? ($employee == "no") ? 1:0 : 0
                    ]);
            }

            if($department == "" || DB::table("departments_".\Auth::user()->company_title)->where("title", $department)->first())
            {
                /* ... */
            }

            else
            {
                DB::table("departments_".\Auth::user()->company_title)->insert(['title'=> $department]);
            }
        }
        else if(\Auth::user()->teamlead == "yes")
        {
            $name = $row['name'];
            $email = $row['email'];
            $password = Hash::make($row['email']);
            $manager = "no";
            $teamlead = "no";
            $employee = $row["employee"];
            $chief = "no";
            $department = ($row['department'] != "") ? $row['department'] : "";

            if($manager == "yes")
            {
                $companyName = \Auth::user()->company_title;
                if(Companies::where("manager_email", $email)->first())
                {
                    DB::table('companies')->where("manager_email", $email)->update([
                        "title" => $companyName,
                        "manager" => $row['name'],
                        "manager_email" => $row['email']
                    ]);
                }
                else
                {
                    DB::table('companies')->insert([
                        "title" => $companyName,
                        "manager" => $row['name'],
                        "manager_email" => $row['email']
                    ]);
                }

                $link = env('LOGIN_URL');
                $test = 0;
                Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "company manager", $test, $department));
            }

            else if($chief == "yes")
            {
                $link = env('LOGIN_URL');
                $test = env('TEST_URL');
                Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "department chief", $test, $department));
            }

            $usersEmail = User::where("email", $email)->first();
            if($usersEmail)
            {
                DB::table(\Auth::user()->company_title)->where('email', $email)->update([
                    'name' => $name,
                    'manager' => $manager ?? null,
                    'teamlead' => $teamlead ?? null,
                    'employee' => $employee ?? null,
                    'chief' => $chief ?? null,
                    'department' => $department,
                    "supervisor" => \Auth::user()->name,
                ]);

                DB::table('users')
                    ->where('email', $email)
                    ->update([
                        'name' => $name,
                        'password' => $password,
                        'company_title' => \Auth::user()->company_title,
                        'manager' => $manager ?? null,
                        'teamlead' => $teamlead ?? null,
                        'employee' => $employee ?? null,
                        'chief' => $chief ?? null,
                        "tariff" => (\Auth::user()->tariff === 1) ? ($employee == "no") ? 1:0 : 0
                    ]);
            }

            else
            {
                DB::table(\Auth::user()->company_title)->insert(
                    ["name" => $name, "email" => $email, "manager" => $manager, "teamlead" => $teamlead, "employee" => $employee, "chief" => $chief, "department" => $department]);

                DB::table('users')
                    ->insert([
                        'name' => $name,
                        'password' => $password,
                        'company_title' => \Auth::user()->company_title,
                        'email' => $email,
                        'manager' => $manager ?? null,
                        'teamlead' => $teamlead ?? null,
                        'employee' => $employee ?? null,
                        'chief' => $chief ?? null,
                        "tariff" => (\Auth::user()->tariff === 1) ? ($employee == "no") ? 1:0 : 0
                    ]);
            }

            if($department == "" || DB::table("departments_".\Auth::user()->company_title)->where("title", $department)->first())
            {
                /* ... */
            }

            else
            {
                DB::table("departments_".\Auth::user()->company_title)->insert(['title'=> $department]);
            }
        }
        else
        {
            $name = $row['name'];
            $email = $row['email'];
            $password = Hash::make($row['email']);
            $manager = $row['company_manager'];
            $teamlead = $row['teamlead'];
            $employee = $row['employee'];
            $chief = $row['department_chief'];

            if(\Auth::user()->company_title) {
                if ($manager == "yes") {
                    $companyName = \Auth::user()->company_title;
                    if (Companies::where("manager_email", $email)->first()) {
                        DB::table('companies')->where("manager_email", $email)->update([
                            "title" => $companyName,
                            "manager" => $row['name'],
                            "manager_email" => $row['email']
                        ]);
                    } else {
                        DB::table('companies')->insert([
                            "title" => $companyName,
                            "manager" => $row['name'],
                            "manager_email" => $row['email']
                        ]);
                    }

                    $link = env('LOGIN_URL');
                    $test = 0;
                    Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "company manager", $test, $row["department"]));
                } else if ($teamlead == "yes") {
                    $link = env('LOGIN_URL');
                    $test = env('TEST_URL');
                    Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "teamlead", $test, $row["department"]));
                } else if ($chief == "yes") {
                    $link = env('LOGIN_URL');
                    $test = env('TEST_URL');
                    Mail::to($email)->send(new AdminMsg($name, $link, $email, $email, \Auth::user()->company_title, "department chief", $test, $row["department"]));
                } else {
                    $department = DB::table(\Auth::user()->company_title)->where("email", \Auth::user()->email)->value("department");
                    $supervisor = (\Auth::user()->teamlead === "yes") ? \Auth::user()->name : null;
                    $company = \Auth::user()->company_title;
                    // $link = env('TEST_URL');
                    Mail::to($email)->send(new CoworkersMsg($name, $department, $supervisor, $company));
                }

                $usersEmail = User::where("email", $email)->first();
                if ($usersEmail) {
                    DB::table(\Auth::user()->company_title)->where('email', $email)->update([
                        'name' => $name,
                        'manager' => $manager ?? null,
                        'teamlead' => $teamlead ?? null,
                        'employee' => $employee ?? null,
                        'chief' => $chief ?? null,
                    ]);

                    DB::table('users')
                        ->where('email', $email)
                        ->update([
                            'name' => $name,
                            'password' => $password,
                            'company_title' => \Auth::user()->company_title,
                            'manager' => $manager ?? null,
                            'teamlead' => $teamlead ?? null,
                            'employee' => $employee ?? null,
                            'chief' => $chief ?? null,
                            "tariff" => (\Auth::user()->tariff === 1) ? ($employee == "no") ? 1 : 0 : 0
                        ]);
                } else {
                    DB::table(\Auth::user()->company_title)->insert(
                        ["name" => $name, "email" => $email, "manager" => $manager, "teamlead" => $teamlead, "employee" => $employee, "chief" => $chief]);

                    DB::table('users')
                        ->insert([
                            'name' => $name,
                            'password' => $password,
                            'company_title' => \Auth::user()->company_title,
                            'email' => $email,
                            'manager' => $manager ?? null,
                            'teamlead' => $teamlead ?? null,
                            'employee' => $employee ?? null,
                            'chief' => $chief ?? null,
                            "tariff" => (\Auth::user()->tariff === 1) ? ($employee == "no") ? 1 : 0 : 0
                        ]);
                }
            }
        }
    }

    public function limit(): int
    {
        return 100;
    }
}
