<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    //
    protected $table = 'seminars';
    protected $fillable = ['teacher_id','seminar_title'];
}
