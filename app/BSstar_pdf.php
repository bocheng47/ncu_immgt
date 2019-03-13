<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BSstar_pdf extends Model
{
	protected $table = 'enrollmentpdf';

    protected $primaryKey = 'id';

    protected $fillable = ['pdf_path', 'pdf_name'];
    //
}
