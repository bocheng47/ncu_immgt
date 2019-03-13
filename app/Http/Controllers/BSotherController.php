<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class BSotherController extends Controller
{
    public function index()
    {
        return view('enrollment.BS.BSother');
    }

    public function storeArticle(Request $request)
    {
    	$atricleFile = "article.blade.php";
        $articleContent= $request->content;
        \Log::INFO($request);
        \Storage::disk('BSother')->put($atricleFile, $articleContent);
        return redirect('enrollment/BS/BSother')->withSuccess("文章儲存成功!");
    }
}
