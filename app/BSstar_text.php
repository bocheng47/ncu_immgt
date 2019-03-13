<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BSstar_text extends Model
{
    protected $table = 'bsstar-text';

    protected $fillable = ['year', 'quota', 'num', 'rate', 'low', 'high'];

}
