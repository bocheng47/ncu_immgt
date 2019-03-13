<?php

namespace App\Http\Controllers;

use App\EMSexam;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class EMSexamController extends Controller
{
    public function index()
    {   
        $EMSexam = EMSexam::where('category' ,'碩士在職專班考試入學')->get();
        return view('enrollment.EMS.EMSexam', compact('EMSexam'));
    }

    public function store(Request $request)
    {
        $EMSexam = new EMSexam();

        $this->validate($request, [
        'upload_file'  => 'required'
        ]);

        $pdf = Input::file('upload_file');  
        $pdf_name = $pdf->getClientOriginalName();
        $pdf_path = public_path() .'/enrollmentpdf/emsexam/';
        $pdf->move($pdf_path , $pdf_name);

        $EMSexam->category = '碩士在職專班考試入學';
        $EMSexam->pdf_name = $pdf_name;
        $EMSexam->pdf_path = $pdf_path;
        $EMSexam->save();

        return redirect('enrollment/EMS/EMSexam');
    }

    public function destroy($id)
    {
        EMSexam::where('id', $id)->delete();

        return redirect('enrollment/EMS/EMSexam');
    }
}
