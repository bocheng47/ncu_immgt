<?php

namespace App\Http\Controllers;

use App\BSsport;
use Illuminate\Http\Request;

class BSsportController extends Controller
{
    public function index()
    {
        $BSsport_text = BSsport::all();
        return view('enrollment.BS.BSsport', compact('BSsport_text'));
    }

    public function create()
    {
        return view('enrollment.BS.BSsport.create');
    }

    public function store(Request $request)
    {
        BSsport::create($request->all());   

        return redirect('enrollment/BS/BSsport');
    }

    public function edit($id)
    {
        $BSsport_text = BSsport::find($id);
        return view('enrollment.BS.BSsport.edit',compact('BSsport_text'));
    }

    public function update(Request $request,$id)
    {
        BSsport::where('id', $id)->update([
            'subject' => $request->get('subject'),
            'gender' => $request->get('gender'),
            'num' => $request->get('num'),
        ]);
        return redirect('enrollment/BS/BSsport');
    }

    public function destroy($id)
    {
        BSsport::where('id', $id)->delete();
        return redirect('enrollment/BS/BSsport');
    }
}
