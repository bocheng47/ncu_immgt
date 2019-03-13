<?php

namespace App\Http\Controllers;

use App\EMScredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class EMScreditController extends Controller
{
    public function index()
    {   
        $EMScredit = EMScredit::where('category' ,'碩士在職專班學分班')->get();
        return view('enrollment.EMS.EMScredit', compact('EMScredit'));
    }

    public function store(Request $request)
    {
        $EMScredit = new EMScredit();

        $this->validate($request, [
        'upload_file'  => 'required'
        ]);

        $pdf = Input::file('upload_file');  
        $pdf_name = $pdf->getClientOriginalName();
        $pdf_path = public_path() .'/enrollmentpdf/emscredit/';
        $pdf->move($pdf_path , $pdf_name);

        $EMScredit->category = '碩士在職專班學分班';
        $EMScredit->pdf_name = $pdf_name;
        $EMScredit->pdf_path = $pdf_path;
        $EMScredit->save();

        return redirect('enrollment/EMS/EMScredit');
    }

    public function destroy($id)
    {
        EMScredit::where('id', $id)->delete();

        return redirect('enrollment/EMS/EMScredit');
    }

}
