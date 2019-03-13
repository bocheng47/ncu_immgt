<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BSsport extends Model
{
    protected $table = 'bssport';

    protected $fillable = ['subject', 'gender','num'];

}
