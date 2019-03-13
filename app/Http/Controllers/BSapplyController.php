<?php

namespace App\Http\Controllers;

use App\BSapply_pdf;
use App\BSapply_text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class BSapplyController extends Controller
{
    public function index()
    {
        $BSapply_pdf = BSapply_pdf::where('category' ,'學士班申請入學')->get();

        // 歷年報考人數data
        $BSapply_Num = BSapply_text
            ::whereNull('year2')
            ->orderBy('id','DEC')
            ->get();
        // 歷年錄取級分data
        $BSapply_Grade = BSapply_text
            ::whereNull('year')
            ->orderBy('id','DEC')
            ->get();

        return view('enrollment.BS.BSapply',compact('BSapply_Num','BSapply_Grade','BSapply_pdf'));
    }

    public function createNum()
    {
        return view('enrollment.BS.BSapply.createNum');
    }

    public function createGrade()
    {
        return view('enrollment.BS.BSapply.createGrade');
    }

    public function store(Request $request)
    {
        $BSapply_pdf = new BSapply_pdf();

        $this->validate($request, [
        'upload_file'  => 'required'
        ]);

        $pdf = Input::file('upload_file');  
        $pdf_name = $pdf->getClientOriginalName();
        $pdf_path = public_path() .'/enrollmentpdf/bsapply/';
        $pdf->move($pdf_path , $pdf_name);

        $BSapply_pdf->category = '學士班申請入學';
        $BSapply_pdf->pdf_name = $pdf_name;
        $BSapply_pdf->pdf_path = $pdf_path;
        $BSapply_pdf->save();

        return redirect('enrollment/BS/BSapply');
    }

    public function storeText(Request $request)
    {
        BSapply_text::create($request->all());  

        return redirect('enrollment/BS/BSapply');
    }

    public function editNum($id)
    {   
        $BSapply_Num = BSapply_text::find($id);
        return view('enrollment.BS.BSapply.editNum',compact('BSapply_Num'));
    }

    public function editGrade($id)
    {
        $BSapply_Grade = BSapply_text::find($id);
        return view('enrollment.BS.BSapply.editGrade',compact('BSapply_Grade'));
    }

    public function updateText(Request $request,$id)
    {
        BSapply_text::where('id', $id)->update([
            'year' => $request->get('year'),
            'quota' => $request->get('quota'),
            'num' => $request->get('num'),
            'rate' => $request->get('rate'),
            'year2' => $request->get('year2'),
            'low' => $request->get('low'),
            'high' => $request->get('high'),
        ]);
        return redirect('enrollment/BS/BSapply');
    }

    public function destroy($id)
    {
        BSapply_pdf::where('id', $id)->delete();

        return redirect('enrollment/BS/BSapply');
    }

    public function destroyText($id)
    {
        BSapply_text::where('id', $id)->delete();
        return redirect('enrollment/BS/BSapply');
    }
}
