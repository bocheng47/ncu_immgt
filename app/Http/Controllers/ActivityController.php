<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Validation\Activity;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($class = "all")
    {
        if ($class == "all") {
            $activities = DB::table('activities')->where('class', '>=', 0)->orderBy('time','DESC')->paginate(10);
        }else if ($class == "bachelor") {
            $activities = DB::table('activities')->where('class', '=', 0)->orderBy('time','DESC')->paginate(10);
        }else if ($class == "master") {
            $activities = DB::table('activities')->where('class', '=', 1)->orderBy('time','DESC')->paginate(10);
        }else if ($class == "emba") {
            $activities = DB::table('activities')->where('class', '=', 2)->orderBy('time','DESC')->paginate(10);
        }else if ($class == "other") {
            $activities = DB::table('activities')->where('class', '=', 3)->orderBy('time','DESC')->paginate(10);
        }
        return view('activity.index')->withActivities($activities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {
      
    
      
      $photoes = $request->picture;
      
      foreach ($photoes as $photo) {
        $p = new \App\Photo;

        $destinationPath = public_path().'/img/activity/'.$id;
        $p->pic = $photo->getClientOriginalName();
        $p->pic_id = $id;
        $photo->move($destinationPath,$photo->getClientOriginalName()); // 不確地
        $p->save();
      }

        return redirect('activity');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
                    'activityname' => 'required',
                    'time' => 'required',
                    'picture' => 'required | mimes:jpeg,jpg,png'
                ]);
      if ($validator->fails()) {
            return redirect('activity')->withErrors($validator)->withInput();
        }
        $activity = new \App\Activity;
        $p = new \App\Photo;
        $activity->activityname = $request->activityname;
        $activity->introduce = $request->introduce;
        $activity->time = $request->time;
        $activity->class = $request->class;
        $photoes = $request->picture;
        $name = $photoes->getClientOriginalName();
        $activity->picture = $name;
        
        $activity->save();
        

        $destinationPath = public_path().'/img/activity/'.$activity->id.'/';
        
        $p->pic = $activity->picture;
    
        $request->file('picture')->move($destinationPath,$name);
        $p->pic_id = $activity->id;
        $p->save();
        return redirect('activity');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($class)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function huan($id)
    {  
        $activities = \App\Activity::find($id);
        $photoes = DB::table('photoes')->where('pic_id', '=', $id)->get();
         return view('activity.huan')->withActivities($activities)->withPhotoes($photoes)->withPid($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       $validator = Validator::make($request->all(), [
                    'activityname' => 'required',
                    'time' => 'required',
                    'picture' => 'required | mimes:jpeg,jpg,png'
                ]);
      if ($validator->fails()) {
            return redirect('activity')->withErrors($validator)->withInput();
        }

            
       $activity = \App\Activity::find($id);
       $destinationPath = public_path().'/img/activity/'.$id;
        $activityname = $request->picture->getClientOriginalName();
        
        $activity->update(['activityname' => $request->activityname]);
        $activity->update(['introduce' => $request->introduce]);
        $activity->update(['time' => $request->time]);
        $activity->update(['class' => $request->class]);
       if($file = $request->hasFile('picture')) {

            Storage::delete(public_path()."/img/activity/".$id."/".$activity->picture);
            $activity->update(['picture' => $activityname]);
            $file = $request->file('picture') ;
            $picture = $file->getClientOriginalName() ;
            $activity->picture = $picture ;
            $request->picture->storeAs('public/img/activity/'.$id, $request->picture->getClientOriginalName());
            $request->file('picture')->move($destinationPath,$activityname);
        }
        $activity->save();
        return redirect('activity');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = \App\Activity::find($id);
        
        $path = public_path()."/img/activity/".$id.'/'.$activity->picture;    
        Storage::delete($path);
        
        $photoes = \App\Photo::where('pic_id', $id)->get();

        foreach ($photoes as $photo) {
            $path = public_path()."/img/activity/".$id.'/'.$photo->pic;
            Storage::delete($path);
            $photo->delete();
        }
        
        $activity->delete();
        return redirect('activity')->withSuccess("刪除成功!");
    }
    

    

    
}
