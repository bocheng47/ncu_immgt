<?php

namespace App\Http\Controllers;

use App\PhDselect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhDselectController extends Controller
{
    public function index()
    {   
        $PhDselect = PhDselect::where('category' ,'博士班甄試入學')->get();
        return view('enrollment.PhD.PhDselect', compact('PhDselect'));
    }

    public function store(Request $request)
    {
        $PhDselect = new PhDselect();

        $this->validate($request, [
        'upload_file'  => 'required'
        ]);

        $pdf = Input::file('upload_file');  
        $pdf_name = $pdf->getClientOriginalName();
        $pdf_path = public_path() .'/enrollmentpdf/phddelect/';
        $pdf->move($pdf_path , $pdf_name);

        $PhDselect->category = '博士班甄試入學';
        $PhDselect->pdf_name = $pdf_name;
        $PhDselect->pdf_path = $pdf_path;
        $PhDselect->save();

        return redirect('enrollment/PhD/PhDselect');
    }

    public function destroy($id)
    {
        PhDselect::where('id', $id)->delete();

        return redirect('enrollment/PhD/PhDselect');
    }
}
