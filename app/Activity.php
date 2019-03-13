<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Activity extends Model
{
  protected $table = 'activities';
  protected $primaryKey = 'id';
  protected $fillable = ['activityname','time','introduce','class','picture'];
}
