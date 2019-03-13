<?php

namespace App\Http\Controllers;

use App\Paperrule;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class PaperruleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('course.paperrules')->withPaperrules(Paperrule::All());
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
            'title' => 'required',
            'file' => 'required|unique:course_paperrules,filename'
        ]);

        if ($validator->fails()) {
            return redirect('course/paperrule')->withErrors($validator)
                                            ->withInput();
        }

        $paperrule = new \App\Paperrule;

        if($file = $request->hasFile('file')) {
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $paperrule->filename = $fileName ;
        }
        $paperrule->title = $request->get('title');

        
        $request->file->storeAs('public/course/paperrules', $request->file->getClientOriginalName());

        if ($paperrule->save()) {
            return redirect('course/paperrule')->withSuccess("新增成功!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\paperrule  $paperrule
     * @return \Illuminate\Http\Response
     */
    public function show(paperrule $paperrule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\paperrule  $paperrule
     * @return \Illuminate\Http\Response
     */
    public function edit(paperrule $paperrule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\paperrule  $paperrule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'file' => 'unique:course_paperrules,filename'
                ]);

        if ($validator->fails()) {
            return redirect('course/paperrule')
                        ->withErrors($validator)
                        ->withMessage($id)
                        ->withInput();
        }

        $paperrule = \App\Paperrule::find($id);

        if($file = $request->hasFile('file')) {
            Storage::delete("public/course/paperrules/".$paperrule->filename);
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $paperrule->filename = $fileName ;
            $request->file->storeAs('public/course/paperrules', $request->file->getClientOriginalName());
        }

        $paperrule->title = $request->get('title');

        
        if ($paperrule->save()) {
            return redirect('course/paperrule')->withSuccess("修改成功!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\paperrule  $paperrule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paperrule = \App\Paperrule::find($id);
        $path = "public/course/paperrules/".$paperrule->filename;
        Storage::delete($path);
        $paperrule->delete();
        return redirect('course/paperrule')->withSuccess("刪除成功!");
    }
}
