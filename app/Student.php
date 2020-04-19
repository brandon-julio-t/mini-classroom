<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    public function classrooms()
    {
        return $this->belongsToMany('App\Classroom');
    }

    public function submittedAssignments()
    {
        return $this->hasMany('App\SubmittedAssignment');
    }
}
