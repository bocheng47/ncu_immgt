<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('about.index',compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(AboutRequest $request)
    {
        About::create($request->all());
        return redirect('about');
    }

    /**
     * Display the specified resource.
     *
     * @param  int id
     * @return Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int id
     * @return Response
     */
    public function edit($id)
    {
        $query = About::find($id);
        return view('about.edit',compact('query'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        About::where('id',$id)->update([
        'title' => $request->get('title'),
        'content' => $request->get('content')
        ]);
        return redirect ('about');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int id
     * @return Response
     */
    public function destroy($id)
    {
        About::where('id',$id)->delete();
        return redirect('about');
    }

    public function storeArticle1(Request $request)
    {
        $articleFile = "article1.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        Storage::disk('about')->put($articleFile, $articleContent);
        return redirect('about')->withSuccess("文章儲存成功!");
    }
    public function storeArticle2(Request $request)
    {
        $articleFile = "article2.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        Storage::disk('about')->put($articleFile, $articleContent);
        return redirect('about')->withSuccess("文章儲存成功!");
    }
    public function storeArticle3(Request $request)
    {
        $articleFile = "article3.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        Storage::disk('about')->put($articleFile, $articleContent);
        return redirect('about')->withSuccess("文章儲存成功!");
    }
    public function storeArticle4(Request $request)
    {
        $articleFile = "article4.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        Storage::disk('about')->put($articleFile, $articleContent);
        return redirect('about')->withSuccess("文章儲存成功!");
    }
    public function storeArticle5(Request $request)
    {
        $articleFile = "article5.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        Storage::disk('about')->put($articleFile, $articleContent);
        return redirect('about')->withSuccess("文章儲存成功!");
    }
    public function storeArticle6(Request $request)
    {
        $articleFile = "article6.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        Storage::disk('about')->put($articleFile, $articleContent);
        return redirect('about')->withSuccess("文章儲存成功!");
    }
}


