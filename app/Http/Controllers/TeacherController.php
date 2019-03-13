<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Teacher;
use App\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($gp = "all")
    {
        $user = Auth::user();
        $teacher_id = 0;
        if($user && $user->usertype == 1){
            $teacher_id = $user->teacher_id;
        }

        $users = User::All();

        if($teacher_id == 0)
        {
            $d1 = DB::table('details')->where('type', '=', "期刊論文")->orderBy('year', 'DESC')->get();
            $d2 = DB::table('details')->where('type', '=', "研討會")->orderBy('year', 'DESC')->get();
            $d3 = DB::table('details')->where('type', '=', "著作")->orderBy('year', 'DESC')->get();
            $teachers = Teacher::all();

            if($gp == "all"){
                $teachers = DB::table('teacher')->orderBy('leader', 'DESC')->orderByRaw('CAST(CONVERT(`name` using big5) AS BINARY)')->get();
            }
            else if($gp == "gp1"){
                $teachers = DB::table('teacher')->where('gp', '=', 1)->orderByRaw('CAST(CONVERT(`name` using big5) AS BINARY)')->get();
            }
            else if($gp == "gp2"){
                $teachers = DB::table('teacher')->where('gp', '=', 2)->orderByRaw('CAST(CONVERT(`name` using big5) AS BINARY)')->get();
            }
            else if($gp == "gp3"){
                $teachers = DB::table('teacher')->where('gp', '=', 3)->orderByRaw('CAST(CONVERT(`name` using big5) AS BINARY)')->get();
            }
            else if($gp == "gp4"){
                $teachers = DB::table('teacher')->where('gp', '=', 4)->orderByRaw('CAST(CONVERT(`name` using big5) AS BINARY)')->get();
            }
            else if($gp == "gp5"){
                $teachers = DB::table('teacher')->where('gp', '=', 5)->orderByRaw('CAST(CONVERT(`name` using big5) AS BINARY)')->get();
            }
            else if($gp == "gp6"){
                $teachers = DB::table('teacher')->where('gp', '=', 6)->orderByRaw('CAST(CONVERT(`name` using big5) AS BINARY)')->get();
            }
            return view('teacher.index', compact('teachers','d1','d2','d3', 'users'));
        }
        else
        {
            [$teachers, $d1, $d2, $d3] = $this->showOneTeacher($teacher_id);
            $isTheTeacher = 1;
            return view('teacher.index', compact('teachers','d1','d2','d3','isTheTeacher', 'users'));
        }

        

        // return view('teacher.index')->withDetails($details);
    }

    // public function detail_index()
    // {
    //     \Log::INFO("detail");
    //     $details = Detail::all();
    //     // return view('detail',[ '$details' => $details]);
    //     return view('teacher.index')->withDetails($details);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response

     */

    public function create()
    {
        //
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
            'name' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'awards' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'office' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'leader' => 'nullable',
            'gp' => 'required',
            'position' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('teacher')->withErrors($validator)->withInput();
        }

        $teacher = new Teacher;
        $teacher->name = $request->name;
        $teacher->education = $request->education;
        $teacher->profession = $request->profession;
        $teacher->awards = $request->awards;
        $teacher->email = $request->email;
        $teacher->office = $request->office;
        $teacher->number = $request->number;
        $teacher->title = $request->title;
        $teacher->leader = ($request->leader == "on" ? "資管系系主任" : null);
        $teacher->gp = $request->gp;
        $teacher->position = $request->position;
        $teacher->visible =  ($request->hide == "on" ? 0 : 1);

        $teacher->save();
        \Log::INFO('teacherid='.$teacher->id);
        $validator = app('App\Http\Controllers\Auth\RegisterController')->registerTeacher($request, $teacher->id);

        if ($validator != 0) {
            $teacher->delete();
            return redirect('teacher')->withErrors($validator)->withInput();
        }

        if($request->teacher_img)
        {
            $destinationPath = public_path().'/img/teacher/';
            $name = $request->teacher_img->getClientOriginalName();
            $teacher->pic_name = $name;
            $request->file('teacher_img')->move($destinationPath,$name);
        }
        


        

        

        return redirect('teacher');
    }

    public function detail_store(Request $request, Teacher $teacher)
    {
        $dl = array();
        $yr = array();
        // $eq = $request->title;
        $dl = $request->title;
        $yr = $request->year;
        $i=count($dl);
        $j=0;
        do{
            
        $detail = new Detail;
        $type = $request->type;
        $id = $request->teacher_id;
        $detail->teacher_id = $id;
        $detail->title = $dl[$j];
        $detail->type = $type;
        $detail->year = $yr[$j];
        $detail->save();

        $j++;

        }while($j < $i);

        return redirect('teacher');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($group)
    {
        
        // return view('teacher.index');
        // return view('teacher.show',compact('teachers'));

        $teachers = DB::table('teachers')->get();

        if ($group==1){ 
            return view::with('Teacher.show')->where($group,'1');}
        if ($group==2){ 
            return view::with('Teacher.show')->where($group,'2');}
        if ($group==3){ 
            return view::with('Teacher.show')->where($group,'3');}
        if ($group==4){ 
            return view::with('Teacher.show')->where($group,'4');}
        if ($group==5){ 
            return view::with('Teacher.show')->where($group,'5');}
        if ($group==6){ 
            return view::with('Teacher.show')->where($group,'6');}

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function showOneTeacher($teacher_id)
    {
        $teachers = collect([Teacher::findOrFail($teacher_id)]);
        $d1 = DB::table('details')->where([['type', '=', "期刊論文"], ['teacher_id', $teacher_id]])->get();
        $d2 = DB::table('details')->where([['type', '=', "研討會"], ['teacher_id', $teacher_id]])->get();
        $d3 = DB::table('details')->where([['type', '=', "著作"], ['teacher_id', $teacher_id]])->get();
        // $isTheTeacher = 1;

        return [$teachers, $d1, $d2, $d3];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
        return view('teachers.edit', ['teacher' => $teacher]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'awards' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'office' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'leader' => 'nullable',
            'gp' => 'required',
            'position' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('teacher')->withErrors($validator)->withInput();
        }
        if($request->name)
        {
            app('App\Http\Controllers\Auth\RegisterController')->changeTeacherName($request, $teacher);
        }
        $teacher->update(['education' => $request->education]);
        $teacher->update(['profession' => $request->profession]);
        $teacher->update(['awards' => $request->awards]);
        $teacher->update(['email' => $request->email]);
        $teacher->update(['office' => $request->office]);
        $teacher->update(['number' => $request->number]);
        $teacher->update(['title' => $request->title]);
        $teacher->update(['leader' => $request->leader == "on" ? "資管系系主任" : null]);
        $teacher->update(['gp' => $request->gp]);
        $teacher->update(['position' => $request->position]);
        $teacher->update(['visible' => $request->hide == "on" ? 0 : 1]);

        if($request->teacher_img)
        {
            $destinationPath = public_path().'/img/teacher/';
            $name = $request->teacher_img->getClientOriginalName();
            // $type = $request->teacher_img->getClientOriginalExtension();
            $teacher->update(['pic_name' => $name]);
            // $teacher->update(['pic_type' => $type]);
            
            $request->file('teacher_img')->move($destinationPath,$name);
        }

        User::where('teacher_id', $teacher->id)->username = $request->username;
        app('App\Http\Controllers\Auth\RegisterController')->update($request, User::where('teacher_id', $teacher->id)->first()->id);

        return redirect('teacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
        $teacher->delete();
       return redirect('/teacher');
    }

    public function detail_destroy(Detail $detail)
    {
        //

        \Log::INFO("DELETEDETAIL");
        $detail->delete();
        return redirect('/teacher');
    }
}
