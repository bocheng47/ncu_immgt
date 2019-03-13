<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    //
    protected $table = 'papers';
    protected $fillable = ['teacher_id','paper_title'];
}
