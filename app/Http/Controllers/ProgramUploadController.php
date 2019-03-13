<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProgramUploadController extends Controller
{
    public function upload(Request $request){
			$validator = Validator::make($request->all(), [
		                'file' => 'required'
		            ]);

			if ($validator->fails()) {
	        return redirect('course/program')->withErrors($validator);
	    }

	    if($file = $request->hasFile('file')) {
	        $file = $request->file('file') ;
	        $request->file->storeAs('public/course/programs', "EC_Programs.pdf");
	        return redirect('course/program')->withSuccess("修改成功!");
	    }

   }
}
