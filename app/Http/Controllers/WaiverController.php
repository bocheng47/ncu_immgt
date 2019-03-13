<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class WaiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waivers = \App\Waiver::All()->sortByDesc('create_date');
        return view('course.waivers')->withWaivers($waivers);
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
                    'create_date' => 'required|date',
                    'file' => 'required|unique:course_waivers,filename'
                ]);

        if ($validator->fails()) {
            return redirect('course/waiver')->withErrors($validator)
                                            ->withInput();
        }

        $waiver = new \App\Waiver;

        if($file = $request->hasFile('file')) {
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $waiver->filename = $fileName ;
        }
        $waiver->title = $request->get('title');
        $waiver->create_date = $request->get('create_date');
        
        $request->file->storeAs('public/course/waivers', $request->file->getClientOriginalName());

        if ($waiver->save()) {
            return redirect('course/waiver')->withSuccess("新增成功!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waiver  $waiver
     * @return \Illuminate\Http\Response
     */
    public function show(Waiver $waiver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waiver  $waiver
     * @return \Illuminate\Http\Response
     */
    public function edit(Waiver $waiver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waiver  $waiver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'create_date' => 'required|date',
                    'file' => 'unique:course_waivers,filename'
                ]);

        if ($validator->fails()) {
            return redirect('course/waiver')
                        ->withErrors($validator)
                        ->withMessage($id)
                        ->withInput();
        }

        $waiver = \App\Waiver::find($id);

        if($file = $request->hasFile('file')) {
            Storage::delete("public/course/waivers/".$waiver->filename);
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $waiver->filename = $fileName ;
            $request->file->storeAs('public/course/waivers', $request->file->getClientOriginalName());
        }

        $waiver->title = $request->get('title');
        $waiver->create_date = $request->get('create_date');
        
        if ($waiver->save()) {
            return redirect('course/waiver')->withSuccess("修改成功!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waiver  $waiver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $waiver = \App\Waiver::find($id);
        $path = "public/course/waivers/".$waiver->filename;
        Storage::delete($path);
        $waiver->delete();
        return redirect('course/waiver')->withSuccess("刪除成功!");
    }
}
