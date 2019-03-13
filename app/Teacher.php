<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	protected $table = 'teacher';
    // protected $fillable = ['name','education','profession','awards','email','office','number','leader','group','position','pic_name','pic_type'];
    protected $fillable = ['name','depart','position','education','office','profession','number','email','visible','title','photo','awards','gp','pic_name'];
    public $timestamps = false;
}
