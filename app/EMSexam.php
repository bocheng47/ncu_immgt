<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EMSexam extends Model
{
    protected $table = 'enrollmentpdf';

    protected $primaryKey = 'id';

    protected $fillable = ['pdf_path', 'pdf_name'];
}
