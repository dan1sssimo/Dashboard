<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class InterviewResult extends Model
{
    use HasFactory;

    public function saveInterviewResult() {
        return DB::table("interview_result")->get();
    }

}
