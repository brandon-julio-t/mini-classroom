<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['title', 'body', 'due', 'teacher_id'];

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
