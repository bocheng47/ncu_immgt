<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class PDFController extends Controller
{
    public function uploadFile(Request $request){
			$validator = Validator::make($request->all(), [
		                'file' => 'required'
		            ]);

			if ($validator->fails()) {
	        return redirect('business/teacher')->withErrors($validator);
	    }

	    if($file = $request->hasFile('file')) {
	        $file = $request->file('file') ;
	        $request->file->storeAs('public/course/programs', "A_Programs.pdf");
	        return redirect('business/teacher')->withSuccess("修改成功!");
	    }

   }
}
