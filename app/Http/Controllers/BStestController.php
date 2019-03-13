<?php

namespace App\Http\Controllers;

use App\BStest;
use Illuminate\Http\Request;

class BStestController extends Controller
{
    public function index()
    {
        //考科與加權data
    	$BStest_Sub = BStest
    		::whereNull('year')
    		->orderBy('order','ASC')
    		->get();

        //歷年指考入學錄取最低分數data
    	$BStest_Grade = BStest
    		::whereNull('subject')
    		->orderBy('id','DEC')
    		->get();

        return view('enrollment.BS.BStest', compact('BStest_Sub','BStest_Grade'));
    }

    public function create()
    {
    	return view('enrollment.BS.BStest.createSub');
    }

    public function createGrade()
    {
    	return view('enrollment.BS.BStest.createGrade');
    }

    public function store(Request $request)
    {
        BStest::create($request->all());  

        return redirect('enrollment/BS/BStest');
    }

    public function edit($id)
    {	
        $query = BStest::find($id);
        return view('enrollment.BS.BStest.editSub',compact('query'));
    }

    public function editGrade($id)
    {
    	$query = BStest::find($id);
        return view('enrollment.BS.BStest.editGrade',compact('query'));
    }

    public function update(Request $request,$id)
    {
        BStest::where('id', $id)->update([
            'subject' => $request->get('subject'),
            'weight' => $request->get('weight'),
            'order' => $request->get('order'),
            'year' => $request->get('year'),
            'grade' => $request->get('grade'),
            'num' => $request->get('num'),
        ]);
        return redirect('enrollment/BS/BStest');
    }

    public function destroy($id)
    {
        BStest::where('id', $id)->delete();
        return redirect('enrollment/BS/BStest');
    }
}
