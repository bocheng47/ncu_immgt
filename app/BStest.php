<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BStest extends Model
{
    protected $table = 'bstests';

    protected $fillable = ['subject','weight','order','year','grade','num'];

}
