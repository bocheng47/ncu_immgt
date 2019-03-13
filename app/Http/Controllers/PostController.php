<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enrollment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index($id)
    {
    	$post = Enrollment
            ::where('id',$id)
            ->first();
            
        return view('enrollment.content', compact('post'));
    }

    public function update(Request $request,$id)
    {
        Enrollment::where('id', $id)->update([
            'content' => $request->content,
        ]);
        
        return back();
    }

    public function storefile(Request $request,$id)
    {
        $this->validate($request, [
            'file'  => 'required'
        ]);

        $post_file = Enrollment::where('id', $id)->first();

        $file = Input::file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = public_path() .'/enrollment_post/';
        $file->move($filePath, $fileName);
        $post_file->filename = $fileName;
        $post_file->save();

        if($post_file->save()) 
        {
            return back();
        } else {
            return response()->json(null, 404);
        }
    }

    public function deletefile($id)
    {
        $post_file = Enrollment::where('id', $id)->first();
        Storage::delete("public/enrollment_post/".$post_file->filename);
        $post_file->update(['filename' => null]);
        return back();
    }
}


