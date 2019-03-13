<?php

namespace App\Http\Controllers;

use App\Double;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DoubleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doubles = \App\Double::All();
        return view('course.doubles')->withDoubles($doubles);
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
                    'file' => 'required|unique:course_doubles,filename'
                ]);

        if ($validator->fails()) {
            return redirect('course/double')->withErrors($validator)
                                            ->withInput();
        }

        $double = new \App\Double;

        if($file = $request->hasFile('file')) {
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $double->filename = $fileName ;
        }
        
        $request->file->storeAs('public/course/doubles', $request->file->getClientOriginalName());

        if ($double->save()) {
            return redirect('course/double')->withSuccess("檔案新增成功!");
        }
    }

    /**
     * Store a newly created atcicle in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeArticle(Request $request)
    {
        $atricleFile = "article.blade.php";
        $articleContent= $request->content;
        \Storage::disk('course_double')->put($atricleFile, $articleContent);
        return redirect('course/double')->withSuccess("文章儲存成功!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Double  $double
     * @return \Illuminate\Http\Response
     */
    public function show(Double $double)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Double  $double
     * @return \Illuminate\Http\Response
     */
    public function edit(Double $double)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Double  $double
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                    'file' => 'unique:course_doubles,filename'
                ]);

        if ($validator->fails()) {
            return redirect('course/double')
                        ->withErrors($validator)
                        ->withMessage($id)
                        ->withInput();
        }

        $double = \App\Double::find($id);

        // 若 request 中有 file 就同名存檔，否則不修改
        if($file = $request->hasFile('file')) {
            Storage::delete("public/course/doubles/".$double->filename);
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $double->filename = $fileName ;
            $request->file->storeAs('public/course/doubles', $request->file->getClientOriginalName());
        }
        
        if ($double->save()) {
            return redirect('course/double')->withSuccess("修改成功!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Double  $double
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $double = \App\Double::find($id);
        $path = "public/course/doubles/".$double->filename;
        Storage::delete($path);
        $double->delete();
        return redirect('course/double')->withSuccess("刪除成功!");
    }
}
