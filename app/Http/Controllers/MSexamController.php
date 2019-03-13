<?php

namespace App\Http\Controllers;

use App\MSexam;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MSexamController extends Controller
{
    public function index()
    {   
        $MSexam = MSexam::where('category' ,'碩士班考試入學')->get();
        return view('enrollment.MS.MSexam', compact('MSexam'));
    }

    public function store(Request $request)
    {
        $MSexam = new MSexam();

        $this->validate($request, [
        'upload_file'  => 'required'
        ]);

        $pdf = Input::file('upload_file');  
        $pdf_name = $pdf->getClientOriginalName();
        $pdf_path = public_path() .'/enrollmentpdf/msexam/';
        $pdf->move($pdf_path , $pdf_name);

        $MSexam->category = '碩士班考試入學';
        $MSexam->pdf_name = $pdf_name;
        $MSexam->pdf_path = $pdf_path;
        $MSexam->save();

        return redirect('enrollment/MS/MSexam');
    }

    public function destroy($id)
    {
        MSexam::where('id', $id)->delete();

        return redirect('enrollment/MS/MSexam');
    }

    // public function update(Request $request,$id)
    // {
    //     $this->validate($request, [
    //     'select_file'  => 'required|image|mimes:jpg,png,gif|max:2048'
    //     ]);

    //     $image = $request->file('select_file');
    //     $name = $image->getClientOriginalName();
    //     $extension = rand() . '.' . $image->getClientOriginalExtension();
    //     $path = public_path() .'/img/MSexam/';

    //     MSexam::where('id', $id)->update([
    //         'pic_path' => $path ,
    //         'pic_name' => $name ,
    //         'pic_type' => $extension
    //     ]);

    //     Storage::delete("public/img/MSexam/".\App\MSexam::find($id)->pic_name);
      
    //     $request->file('select_file')->move($path,$extension);

    //     return redirect('enrollment/MS/MSexam');
    // }
}
