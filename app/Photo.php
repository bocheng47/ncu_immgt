<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Photo extends Model
{
  protected $table = 'photoes';
  protected $primaryKey = 'id';
  protected $fillable = ['pic_id','pic'];
}
