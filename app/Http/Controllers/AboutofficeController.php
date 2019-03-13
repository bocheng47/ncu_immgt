<?php

namespace App\Http\Controllers;

use App\Aboutoffice;
use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;
use Illuminate\Support\Facades\Redirect;

class AboutofficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Aboutoffice
            ::whereNull('name')
            ->get();

        $query2 = Aboutoffice
            ::whereNull('content')
            ->get();
        $query2 = Aboutoffice::all()->sortBy('rank'); 
        return view('about.office.aboutoffice', compact('query','query2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.office.createcontact');

    }
    public function createstaff()
    {
        return view('about.office.createstaff');
    }


      public function store(Request $request)
    {
        Aboutoffice::create($request->all());  
        return redirect('about/office/aboutoffice');
    }

    public function edit($id)
    {   
        $query = Aboutoffice::find($id);
        return view('about.office.editcontact',compact('query'));
    }

    public function editstaff($id)
    {
        $query2 = Aboutoffice::find($id);
        return view('about.office.editstaff',compact('query2'));
    }

    public function update(Request $request,$id)
    {
        Aboutoffice::where('id', $id)->update([
            'content' => $request->get('content'),
            'jobtitle' => $request->get('jobtitle'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'rank' => $request->get('rank')
        ]);
        return redirect('about/office/aboutoffice');
    }

    public function destroy($id)
    {
        Aboutoffice::where('id', $id)->delete();
        return redirect('about/office/aboutoffice');
    }

}