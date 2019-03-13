<?php

namespace App\Http\Controllers;

use App\PhDexam;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhDexamController extends Controller
{
    public function index()
    {   
        $PhDexam = PhDexam::where('category' ,'博士班考試入學')->get();
        return view('enrollment.PhD.PhDexam', compact('PhDexam'));
    }

    public function store(Request $request)
    {
        $PhDexam = new PhDexam();

        $this->validate($request, [
        'upload_file'  => 'required'
        ]);

        $pdf = Input::file('upload_file');  
        $pdf_name = $pdf->getClientOriginalName();
        $pdf_path = public_path() .'/enrollmentpdf/phdexam/';
        $pdf->move($pdf_path , $pdf_name);

        $PhDexam->category = '博士班考試入學';
        $PhDexam->pdf_name = $pdf_name;
        $PhDexam->pdf_path = $pdf_path;
        $PhDexam->save();

        return redirect('enrollment/PhD/PhDexam');
    }

    public function destroy($id)
    {
        PhDexam::where('id', $id)->delete();

        return redirect('enrollment/PhD/PhDexam');
    }
}
