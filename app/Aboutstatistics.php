<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutstatistics extends Model
{
    protected $table = 'aboutstatistics';
    protected $primarykey = 'id';
    protected $fillable = ['menofyearcollege','womenofyearcollege','menofyearms','womenofyearms','menofyearphd','womenofyearphd','menofyearemba','womenofyearemba','year'];
}
