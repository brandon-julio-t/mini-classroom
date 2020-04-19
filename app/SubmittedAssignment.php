<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmittedAssignment extends Model
{
    public $timestamps = false;

    public function student()
    {
        return $this->hasOne('App\Student');
    }
}
