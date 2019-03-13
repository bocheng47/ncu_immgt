<?php

namespace App\Http\Controllers;

use App\Scholarship;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('course.scholarships')->withScholarships(Scholarship::All());
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
            'acadType' => 'required|integer',
            'title' => 'required',
            'file' => 'required|unique:course_scholarships,filename'
        ]);

        if ($validator->fails()) {
            return redirect('course/scholarship')->withErrors($validator)
                                            ->withInput();
        }

        $scholarship = new \App\Scholarship;
        // \Log::alert("STORE Filename: ".time().$request->file('file')->getClientOriginalName());

        if($file = $request->hasFile('file')) {
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $scholarship->filename = $fileName ;
        }
        $scholarship->acadType = $request->get('acadType');
        $scholarship->title = $request->get('title');


        
        $request->file->storeAs('public/course/scholarships', $request->file->getClientOriginalName());

        if ($scholarship->save()) {
            return redirect('course/scholarship')->withSuccess("新增成功!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function show(Scholarship $scholarship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function edit(Scholarship $scholarship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                    'acadType' => 'required|integer',
                    'title' => 'required',
                    'file' => 'unique:course_scholarships,filename'
                ]);

        if ($validator->fails()) {
            return redirect('course/scholarship')
                        ->withErrors($validator)
                        ->withMessage($id)
                        ->withInput();
        }

        $scholarship = \App\Scholarship::find($id);

        if($file = $request->hasFile('file')) {
            Storage::delete("public/course/scholarships/".$scholarship->filename);
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $scholarship->filename = $fileName ;
            $request->file->storeAs('public/course/scholarships', $request->file->getClientOriginalName());
        }

        $scholarship->acadType = $request->get('acadType');
        $scholarship->title = $request->get('title');

        
        if ($scholarship->save()) {
            return redirect('course/scholarship')->withSuccess("修改成功!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scholarship = \App\Scholarship::find($id);
        $path = "public/course/scholarships/".$scholarship->filename;
        Storage::delete($path);
        $scholarship->delete();
        return redirect('course/scholarship')->withSuccess("刪除成功!");
    }
}
