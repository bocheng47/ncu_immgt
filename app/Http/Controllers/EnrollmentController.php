<?php

namespace App\Http\Controllers;

use App\Enrollment;
// use App\Home;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollment_post = enrollment::orderBy('id', 'desc')->take(11)->get();
        
        return view('enrollment.index', compact('enrollment_post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enrollment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_post = new Enrollment($request->input());  
        $new_post->category = '招生訊息';
        $new_post->save();

        return redirect('enrollment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_post = Enrollment::find($id);
        return view('enrollment.edit',compact('edit_post')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        Enrollment::where('id', $id)->update([
            'title' => $request->get('title'),
            'degree' => $request->get('degree')
        ]);
        return redirect('enrollment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Enrollment::where('id', $id)->delete();
        return redirect('enrollment');
    }
}