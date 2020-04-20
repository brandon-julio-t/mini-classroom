<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmittedAssignment extends Model
{
    protected $fillable = ['path', 'created_at', 'student_id', 'assignment_id'];

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function assignment()
    {
        return $this->hasOne('App\Assignment');
    }
}
