<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'index';
    protected $primarykey = 'id';
    protected $fillable = ['title','content'];
}
