<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnarie extends Model
{
    protected $table = 'questionnaire';
    protected $primarykey = 'id';
    protected $fillable = ['title','hreftocollege','hreftoms','hreftophd','hreftoemba','class1','class2','class3','class4','count'];
}
