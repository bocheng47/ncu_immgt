<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    public function index($id)
    {
    	$businesses = Business
            ::where('id',$id)
            ->first();
            
        return view('business.news', compact('businesses'));
    }

    public function update(Request $request,$id)
    {
        Business::where('id', $id)->update([
            'content' => $request->content,
        ]);
        
        return back();
    }
    public function storefile(Request $request,$id)
    {
        $this->validate($request, [
            'file'  => 'required'
        ]);

        $post = Business::where('id', $id)->first();

        $file = Input::file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = public_path() .'/business_post/';
        $file->move($filePath, $fileName);
        $post->filename = $fileName;
        $post->save();

        if($post->save()) 
        {
            return back();
        } else {
            return response()->json(null, 404);
        }
    }

    public function deletefile($id)
    {
        $post = Business::where('id', $id)->first();
        Storage::delete("public/business_post/".$post->filename);
        $post->update(['filename' => null]);
        return back();
    }
}