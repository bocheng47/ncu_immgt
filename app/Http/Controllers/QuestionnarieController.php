<?php

namespace App\Http\Controllers;

use App\Questionnarie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AboutRequest;

class QuestionnarieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 4;
        $query = Questionnarie::all();
        return view('questionnarie.index',compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questionnarie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Questionnarie::create($request->all());
        return redirect('questionnarie');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnarie $questionnarie)
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
        $query = Questionnarie::find($id);
        return view('questionnarie.edit',compact('query'));
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
        Questionnarie::where('id', $id)->update([
            'title' => $request->get('title'),
            'class1' => $request->get('class1'),
            'class2' => $request->get('class2'),
            'class3' => $request->get('class3'),
            'class4' => $request->get('class4'),
            'hreftocollege' => $request->get('hreftocollege'),
            'hreftoms' => $request->get('hreftoms'),
            'hreftophd' => $request->get('hreftophd'),
            'hreftoemba' => $request->get('hreftoemba'),
        ]);
        return redirect('questionnarie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Questionnarie::where('id',$id)->delete();
        return redirect('questionnarie');
    }
}
