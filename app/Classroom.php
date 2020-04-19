<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'code'];

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
}
