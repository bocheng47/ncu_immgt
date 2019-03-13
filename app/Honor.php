<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    protected $table = 'homes';

    protected $fillable = ['title', 'content','category','filename'];
}
