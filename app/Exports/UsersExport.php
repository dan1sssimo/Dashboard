<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        if(\Auth::user()->manager === "yes")
        {
            return view('company_table_example', [
                'user' => \DB::table("company_table_example")->select("name", "email", "manager", "teamlead", "employee", "chief", "department")
                    ->where("id", "<", 3)->get()
            ]);
        }
        else if(\Auth::user()->chief === "yes")
        {
            return view('company_table_example', [
                'user' => \DB::table("company_table_example")->select("name", "email", "manager", "teamlead", "employee", "chief", "department")
                    ->where("id", 3)->get()
            ]);
        }
        else if(\Auth::user()->teamlead === "yes")
        {
            return view('company_table_example', [
                'user' => \DB::table("company_table_example")->select("name", "email", "manager", "employee", "chief", "department")
                    ->where("id", 4)->get()
            ]);
        }
    }
}
