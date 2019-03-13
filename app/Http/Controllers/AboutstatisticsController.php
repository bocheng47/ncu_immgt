<?php

namespace App\Http\Controllers;

use DB;
use App\Aboutstatistics;
use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;
use Illuminate\Support\Facades\Redirect;

class AboutstatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Aboutstatistics::All()->sortByDesc('year');
       
        $sum_menofyearcollege =  
        DB::table('aboutstatistics')->sum('menofyearcollege');
        $sum_womenofyearcollege =
        DB::table('aboutstatistics')->sum('womenofyearcollege');
       
        $sum_menofyearphd =
        DB::table('aboutstatistics')->sum('menofyearphd');
        $sum_womenofyearphd =
        DB::table('aboutstatistics')->sum('womenofyearphd');
        
        $sum_menofyearemba =  
        DB::table('aboutstatistics')->sum('menofyearemba'); 
        $sum_womenofyearemba =  
        DB::table('aboutstatistics')->sum('womenofyearemba');

        $sum_menofyearms =  
        DB::table('aboutstatistics')->sum('menofyearms');
        $sum_womenofyearms =  
        DB::table('aboutstatistics')->sum('womenofyearms');
        
        $sumofcollege = $sum_menofyearcollege + $sum_womenofyearcollege;
        $sumofphd = $sum_menofyearphd + $sum_womenofyearphd;
        $sumofemba = $sum_menofyearemba + $sum_womenofyearemba;
        $sumofms = $sum_menofyearms + $sum_womenofyearms;
        $total = $sumofcollege + $sumofphd + $sumofemba + $sumofms;
        return view('about.statistics.aboutstatistics',compact('query','sumofcollege','sumofphd','sumofemba','sumofms','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.statistics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        Aboutstatistics::create($request->all());  
        return redirect('about/statistics/aboutstatistics');
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show(About $about)
    {
        //
    }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aboutoffice  $query2
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $query = Aboutstatistics::find($id);
        return view('about.statistics.edit', compact('query'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aboutoffice  $query2
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        Aboutstatistics::where('id', $id)->update([
            'year' => $request->get('year'),
            'menofyearcollege' => $request->get('menofyearcollege'),
            'womenofyearcollege' => $request->get('womenofyearcollege'),
            'menofyearms' => $request->get('menofyearms'),
            'womenofyearms' => $request->get('womenofyearms'),
            'menofyearphd' => $request->get('menofyearphd'),
            'womenofyearphd' => $request->get('womenofyearphd'),
            'menofyearemba' => $request->get('menofyearemba'),
            'womenofyearemba' => $request->get('womenofyearemba'),
        ]);
        return redirect('about/statistics/aboutstatistics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int id
     * @return Response
     */
    public function destroy($id)
    {
        Aboutstatistics::where('id', $id)->delete();
        return redirect('about/statistics/aboutstatistics');

    }
}