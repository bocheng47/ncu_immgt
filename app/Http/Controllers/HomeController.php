<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use App\Enrollment;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;


class HomeController extends Controller
{
    //
    public function index()
    {
        // side bar
        $reward = DB::table('homes')->where('category', '=', '榮譽榜')->orderBy('created_at', 'DESC')->first();
        $speech = DB::table('homes')->where('category', '=', '演講訊息')->orderBy('created_at', 'DESC')->first();

        $homes = DB::table('homes')->orderBy('created_at', 'DESC')->get();
        $tops = DB::table('homes')->where('top','=', "top")->orderBy('created_at','DESC')->get();

        return view('welcome', compact('homes','reward','speech','tops'));
    }
    
    public function all_index()
    {
        $home = DB::table('homes')->where('id', '>=', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('news')->withHomes($home);
    }

    public function honor_index()
    {
        $honor = DB::table('homes')->where('category', '=', '榮譽榜')->orderBy('created_at', 'DESC')->paginate(20);
        return view('home.honor', compact('honor'));
    }


    public function store(Request $request)
    {
        \Log::INFO("NEW STORING");
        $home = new Home;
        $home->title = $request->title;
        $home->category = $request->category;
        $home->title = $request->title;
        $home->content = $request->content;
        $home->top = $request->top;
        if(is_null($request->new_file))
        {

        }
        else
        {
            $destinationPath = public_path().'/upload/';
            $name = $request->new_file->getClientOriginalName();
            $type = $request->new_file->getClientOriginalExtension();
            $home->filename = $name;
            $home->file_type = $type;

            $request->file('new_file')->move($destinationPath,$name);
        }

        $home->time = $request->time;
        $home->place = $request->place;        

     $home->save();
        return redirect('/');
    }
    public function edit($id)
    {
        $home = Home::find($id);
        return view('editnews',compact('home'));
    }

    public function update(Request $request,$id)
    {
        Home::where('id', $id)->update([
            'title' => $request->get('title'),
            'category' => $request->get('category'),
            'time' => $request->get('time'),
            'place' => $request->get('place'),
            'content' => $request->get('content'),
            'top' => $request->get('top'),
            'filename' => $request->get('file_name'),
            'file_type' => $request->get('file_type'),

        ]);
        return redirect('news');
    }
    public function destroy($id)
    {
        Home::where('id', $id)->delete();
        return redirect('news');
    }
    public function ShowPostContent($id)
    {
        $query = Home
            ::where('id',$id)
            ->first();
            
        return view('newpost', compact('query'));
    }

    public function StorePostContent(Request $request,$id)
    {
        Home::where('id', $id)->update([
            'content' => $request->content,
        ]);
        
        return back();
    }





    public function storefile(Request $request,$id)
    {
        $this->validate($request, [
            'file'  => 'required'
        ]);

        $post = Home::where('id', $id)->first();

        $file = Input::file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = public_path() .'/newpost/';
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
        $post = Home::where('id', $id)->first();
        Storage::delete("public/newpost/".$post->filename);
        $post->update(['filename' => null]);
        return back();
    }

}
