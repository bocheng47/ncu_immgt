<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutoffice extends Model
{
    protected $table = 'aboutoffice';
    protected $primarykey = 'id';
    protected $fillable = ['jobtitle','content','email','name','rank'];
 }
