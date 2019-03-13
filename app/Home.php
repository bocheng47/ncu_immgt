<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{	
	protected $table = 'homes';

    protected $primaryKey = 'id';

    protected $fillable = ['title','category','filename','content','top'];
}
