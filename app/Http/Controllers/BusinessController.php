<?php

namespace App\Http\Controllers;

use App\Business;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = business::all();
        $businesses = $businesses->sortByDesc('id');
        $businesses = DB::table('businesses')->orderBy('time','DESC')->paginate(10);
        return view('business.index', compact('businesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $business = new \App\Business;
        $business->title = $request->title;
        $business->time = $request->time;
        $business->save();
        return redirect('business');
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       $business = \App\Business::find($id);
       $business->update(['title' => $request->title]);
       $business->update(['time' => $request->time]);
       $business->save();
       return redirect('business');    
    }

    
     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Business::where('id', $id)->delete();
        return redirect('business');
    }

     public function storeArticle(Request $request)
    {
        $atricleFile = "article.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        \Storage::disk('Business')->put($atricleFile, $articleContent);
        return redirect('business')->withSuccess("文章儲存成功!");
    }

     public function activity()
    {
        return view('business.activity');
    }

     public function storeArticle1(Request $request)
    {
        $atricleFile = "article1.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        \Storage::disk('Business')->put($atricleFile, $articleContent);
        return redirect('business/activity')->withSuccess("文章儲存成功!");
    }

    public function main()
    {
        return view('business.main');
    }

     public function storeArticle2(Request $request)
    {
        $atricleFile = "article2.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        \Storage::disk('Business')->put($atricleFile, $articleContent);
        return redirect('business/main')->withSuccess("文章儲存成功!");
    }

        public function strategy()
    {
        return view('business.strategy');
    }

     public function storeArticle3(Request $request)
    {
        $atricleFile = "article3.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        \Storage::disk('Business')->put($atricleFile, $articleContent);
        return redirect('business/strategy')->withSuccess("文章儲存成功!");
    }
         public function student()
    {
        return view('business.student');
    }

     public function storeArticle4(Request $request)
    {
        $atricleFile = "article4.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        \Storage::disk('Business')->put($atricleFile, $articleContent);
        return redirect('business/student')->withSuccess("文章儲存成功!");
    }

     public function news(Request $request)
    {  $business->where('id','=', $id); 
       $business->title;
       return view('business.news')->withBusinesses($businesses);
    }




}
