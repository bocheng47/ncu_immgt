<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'homes';

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'content','category','filename','degree'];
}
