<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = false;

    protected function user()
    {
        return $this->belongsTo('App\User');
    }

    public function name()
    {
        return $this->user->name;
    }

    public function email()
    {
        return $this->user->email;
    }

    public function gender()
    {
        return $this->user->gender;
    }

    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }

    public function assignments()
    {
        return $this->hasManyThrough('App\Assignment', 'App\Classroom');
    }
}
