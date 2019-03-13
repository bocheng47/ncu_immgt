<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
	protected $table = 'course_rules';
    protected $fillable = ['acadType', 'acadYear','title', 'filename'];
}
