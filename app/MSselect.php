<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSselect extends Model
{
    protected $table = 'enrollmentpdf';

    protected $primaryKey = 'id';

    protected $fillable = ['pdf_path', 'pdf_name'];
    
}
