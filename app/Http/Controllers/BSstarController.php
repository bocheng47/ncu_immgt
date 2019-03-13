<?php

namespace App\Http\Controllers;

use App\BSstar_pdf;
use App\BSstar_text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class BSstarController extends Controller
{
    public function index()
    {
        $BSstar_pdf = BSstar_pdf::where('category' ,'學士班繁星入學')->get();

        $BSstar_text = DB::table('bsstar-text')
            ->orderBy('year','ASC')
            ->get();

        return view('enrollment.BS.BSstar',compact('BSstar_pdf','BSstar_text'));
    }

    public function createNum()
    {
        return view('enrollment.BS.BSstar.createNum');
    }

    public function store(Request $request)
    {
        $BSstar_pdf = new BSstar_pdf();

        $this->validate($request, [
        'upload_file'  => 'required'
        ]);

        $pdf = Input::file('upload_file');  
        $pdf_name = $pdf->getClientOriginalName();
        $pdf_path = public_path() .'/enrollmentpdf/bsstar/';
        $pdf->move($pdf_path , $pdf_name);

        $BSstar_pdf->category = '學士班繁星入學';
        $BSstar_pdf->pdf_name = $pdf_name;
        $BSstar_pdf->pdf_path = $pdf_path;
        $BSstar_pdf->save();

        return redirect('enrollment/BS/BSapply');
    }

    public function storeText(Request $request)
    {
        BSstar_text::create($request->all());  

        return redirect('enrollment/BS/BSstar');
    }

    public function editNum($id)
    {   
        $query = BSstar_text::find($id);
        return view('enrollment.BS.BSstar.editNum',compact('query'));
    }

    public function updateText(Request $request,$id)
    {
        BSstar_text::where('id', $id)->update([
            'year' => $request->get('year'),
            'quota' => $request->get('quota'),
            'num' => $request->get('num'),
            'rate' => $request->get('rate'),
            'low' => $request->get('low'),
            'high' => $request->get('high'),
        ]);
        return redirect('enrollment/BS/BSstar');
    }

    public function destroy($id)
    {
        BSstar_pdf::where('id', $id)->delete();

        return redirect('enrollment/BS/BSstar');
    }


    public function destroyText($id)
    {
        BSstar_text::where('id', $id)->delete();

        return redirect('enrollment/BS/BSstar');
    }
}
