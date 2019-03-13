<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Business extends Model
{
  protected $table = 'businesses';
  protected $primaryKey = 'id';
  protected $fillable = ['title','time','content','filename'];
  protected $dates = ['created_at'];
}
