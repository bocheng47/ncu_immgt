<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BSapply_text extends Model
{
    protected $table = 'bsapply-text';

    protected $fillable = ['year', 'quota', 'num', 'rate', 'year2', 'low', 'high'];
}
