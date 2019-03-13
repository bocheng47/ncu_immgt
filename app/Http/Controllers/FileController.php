<?php

namespace App\Http\Controllers;

use App\File;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('file.index')->withFiles(\App\File::All());
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
                    'filetype' => 'required|integer',
                    'title' => 'required',
                    'file' => 'required_without:fileurl|unique:files,filename',
                    'fileurl' => 'required_without:file'
                ]);

        if ($validator->fails()) {
            return redirect('files')->withErrors($validator)->withInput();
        }

        $newfile = new \App\File;

        if($file = $request->hasFile('file')) {
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $newfile->filename = $fileName ;
            $request->file->storeAs('public/files/downloads', $request->file->getClientOriginalName());
        }
        else
        {
            $newfile->fileurl = $request->fileurl ;
        }

        $newfile->filetype = $request->get('filetype');
        $newfile->title = $request->get('title');

        if ($newfile->save()) {
            return redirect('files')->withReturned($request->get('filetype'))->withSuccess("新增成功!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                    'filetype' => 'required|integer',
                    'title' => 'required',
                    'file' => 'unique:files,filename'
                ]);

        if ($validator->fails()) {
            return redirect('files')
                        ->withErrors($validator)
                        ->withMessage($id)
                        ->withInput();
        }

        $newfile = \App\File::find($id);

        if($file = $request->hasFile('file')) {
            if (!is_null($newfile->filename)) {
                Storage::delete("public/files/downloads/".$newfile->filename);
            }

            $newfile->fileurl = NULL;
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $newfile->filename = $fileName ;
            $request->file->storeAs('public/files/downloads', $request->file->getClientOriginalName());
        }
        else
        {
            if (!is_null($newfile->filename)) {
                Storage::delete("public/files/".$newfile->filename);
                $newfile->filename = NULL;
            }
            $newfile->fileurl = $request->fileurl ;
        }

        $newfile->filetype = $request->get('filetype');
        $newfile->title = $request->get('title');
        
        if ($newfile->save()) {
            return redirect('files')->withSuccess("修改成功!")->withReturned($request->get('filetype'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = \App\File::find($id);
        $returnedType = $file->filetype;
        if (!is_null($file->filename)) {
            $path = "public/files/downloads/".$file->filename;
            Storage::delete($path);
        }

        $file->delete();
        return redirect('files')->withReturned($returnedType)->withSuccess("刪除成功!");
    }
}
