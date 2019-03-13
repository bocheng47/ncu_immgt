<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = \App\Rule::All()->sortByDesc('acadYear');
        return view('course.rules')->withRules($rules);
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
                    'acadYear' => 'required|integer',
                    'title' => 'required',
                    'file' => 'required|unique:course_rules,filename'
                ]);

        if ($validator->fails()) {
            return redirect('course/rule')->withErrors($validator)->withInput();
        }

        $rule = new \App\Rule;

        if($file = $request->hasFile('file')) {
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $rule->filename = $fileName ;
        }
        $rule->acadType = $request->get('acadType');
        $rule->acadYear = $request->get('acadYear');
        $rule->title = $request->get('title');
        
        $request->file->storeAs('public/course/rules', $request->file->getClientOriginalName());

        if ($rule->save()) {
            return redirect('course/rule')->withReturned($request->get('acadType'))->withSuccess("新增成功!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit(Rule $rule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO: file: unique is not implemented yet. 
        $validator = Validator::make($request->all(), [
                    'acadType' => 'required|integer',
                    'acadYear' => 'required|integer',
                    'title' => 'required',
                    'file' => 'unique:course_rules,filename',
                ]);

        if ($validator->fails()) {
            return redirect('course/rule')
                        ->withErrors($validator)
                        ->withMessage($id)
                        ->withInput();
        }

        $rule = \App\Rule::find($id);

        if($file = $request->hasFile('file')) {
            Storage::delete("public/course/rules/".$rule->filename);
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
            $rule->filename = $fileName ;
            $request->file->storeAs('public/course/rules', $request->file->getClientOriginalName());
        }
        $rule->acadType = $request->get('acadType');
        $rule->acadYear = $request->get('acadYear');
        $rule->title = $request->get('title');
        
        if ($rule->save()) {
            return redirect('course/rule')->withSuccess("修改成功!")->withReturned($request->get('acadType'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rule = \App\Rule::find($id);
        $returnedType = $rule->acadType;
        $path = "public/course/rules/".$rule->filename;
        Storage::delete($path);
        $rule->delete();
        return redirect('course/rule')->withReturned($returnedType)->withSuccess("刪除成功!");
    }
}
