<?php

namespace App\Http\Controllers;

use App\MSselect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MSselectController extends Controller
{
    public function index()
    {   
        $MSselect = MSselect::where('category' ,'碩士班甄試入學')->get();
        return view('enrollment.MS.MSselect', compact('MSselect'));
    }

    public function store(Request $request)
    {
        $MSselect = new MSselect();

        $this->validate($request, [
        'upload_file'  => 'required'
        ]);

        $pdf = Input::file('upload_file');  
        $pdf_name = $pdf->getClientOriginalName();
        $pdf_path = public_path() .'/enrollmentpdf/msselect/';
        $pdf->move($pdf_path , $pdf_name);

        $MSselect->category = '碩士班甄試入學';
        $MSselect->pdf_name = $pdf_name;
        $MSselect->pdf_path = $pdf_path;
        $MSselect->save();

        return redirect('enrollment/MS/MSselect');
    }

    public function destroy($id)
    {
        MSselect::where('id', $id)->delete();

        return redirect('enrollment/MS/MSselect');
    }
    
    // public function update(Request $request,$id)
    // {
    //     $this->validate($request, [
    //     'select_file'  => 'required|image|mimes:jpg,png,gif|max:2048'
    //     ]);

    //     $image = $request->file('select_file');
    //     $name = $image->getClientOriginalName();
    //     $extension = rand() . '.' . $image->getClientOriginalExtension();
    //     $path = public_path() .'/img/MSselect/';

    //     MSselect::where('id', $id)->update([
    //         'pic_path' => $path ,
    //         'pic_name' => $name ,
    //         'pic_type' => $extension
    //     ]);

    //     Storage::delete("public/img/MSselect/".\App\MSselect::find($id)->pic_name);
      
    //     $request->file('select_file')->move($path,$extension);

    //     return redirect('enrollment/MS/MSselect');
}
