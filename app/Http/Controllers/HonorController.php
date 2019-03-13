<?php

namespace App\Http\Controllers;

use App\Honor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class HonorController extends Controller
{
    public function index()
    {   
        $honor_post = Honor::orderBy('id', 'desc')->where('category','榮譽榜')->paginate(10);
        
        return view('honor.index', compact('honor_post'));
    }

    public function showContent($id)
    {
    	$honor_post = Honor::where('id',$id)
            ->first();
    	return view('honor.content', compact('honor_post'));
    }

    public function create()
    {
        return view('honor.create');
    }

    public function store(Request $request)
    {
        $honor = new Honor($request->input());  
        $honor->category = '榮譽榜';
        $honor->save();
        return redirect('honor');
    }

    public function storeContent(Request $request,$id)
    {
        Honor::where('id', $id)->update([
            'content' => $request->content,
        ]);
        return back();
    }

    public function edit($id)
    {
        $honor_post = Honor::find($id);
        return view('honor.edit',compact('honor_post'));
    }

    public function update(Request $request,$id)
    {
        Honor::where('id', $id)->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);
        return redirect('honor');
    }

    public function destroy($id)
    {
        Honor::where('id', $id)->delete();
        return redirect('honor');
    }

    public function storefile(Request $request,$id)
    {
        $this->validate($request, [
            'file'  => 'required'
        ]);

        $honor_post = Honor::where('id', $id)->first();

        $file = Input::file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = public_path() .'/honor_post/';
        $file->move($filePath, $fileName);
        $honor_post->filename = $fileName;
        $honor_post->save();

        if($honor_post->save()) 
        {
            return back();
        } else {
            return response()->json(null, 404);
        }
    }

    public function deletefile($id)
    {
        $honor_post = Honor::where('id', $id)->first();
        Storage::delete("public/honor_post/".$honor_post->filename);
        $honor_post->update(['filename' => null]);
        return back();
    }
}
