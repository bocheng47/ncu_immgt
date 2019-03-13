<?php

namespace App\Http\Controllers;

use App\Goodpaper;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class GoodpaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goodpapers = \App\Goodpaper::All()->sortByDesc('acadYear');
        return view('course.goodpapers')->withGoodpapers($goodpapers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'acadYear' => 'required|integer',
            'title' => 'required',
            'file' => 'required|unique:course_goodpapers,filename'
        ]);

        if ($validator->fails()) {
            return redirect('course/goodpaper')->withErrors($validator)
                                            ->withInput();
        }

        $goodpaper = new \App\Goodpaper;

        if($file = $request->hasFile('file')) {
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $goodpaper->filename = $fileName ;
        }
        $goodpaper->acadYear = $request->get('acadYear');
        $goodpaper->title = $request->get('title');


        
        $request->file->storeAs('public/course/goodpapers', $request->file->getClientOriginalName());

        if ($goodpaper->save()) {
            return redirect('course/goodpaper')->withSuccess("新增成功!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Goodpaper  $goodpaper
     * @return \Illuminate\Http\Response
     */
    public function show(Goodpaper $goodpaper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goodpaper  $goodpaper
     * @return \Illuminate\Http\Response
     */
    public function edit(Goodpaper $goodpaper)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goodpaper  $goodpaper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                    'acadYear' => 'required|integer',
                    'title' => 'required',
                    'file' => 'unique:course_goodpapers,filename'
                ]);

        if ($validator->fails()) {
            return redirect('course/goodpaper')
                        ->withErrors($validator)
                        ->withMessage($id)
                        ->withInput();
        }

        $goodpaper = \App\Goodpaper::find($id);

        if($file = $request->hasFile('file')) {
            Storage::delete("public/course/goodpapers/".$goodpaper->filename);
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $goodpaper->filename = $fileName ;
            $request->file->storeAs('public/course/goodpapers', $request->file->getClientOriginalName());
        }

        $goodpaper->acadYear = $request->get('acadYear');
        $goodpaper->title = $request->get('title');

        
        if ($goodpaper->save()) {
            return redirect('course/goodpaper')->withSuccess("修改成功!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goodpaper  $goodpaper
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goodpaper = \App\Goodpaper::find($id);
        $path = "public/course/goodpapers/".$goodpaper->filename;
        Storage::delete($path);
        $goodpaper->delete();
        return redirect('course/goodpaper')->withSuccess("刪除成功!");
    }
}
