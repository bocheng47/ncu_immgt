<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/usermanage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->redirectTo = url()->previous();
        $this->middleware(function ($request, $next) { // 非系辦帳號無法使用本層 
            $user = Auth::user();
            if($user->usertype == 0)
                return $next($request);
            return redirect()->back();
        })->except('changeusernamepassword');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'usertype' => 'required|integer',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'usertype' => $data['usertype'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createTeacher(array $data, $teacher_id)
    {
        \Log::INFO('teacherid3='.$teacher_id);
        return User::create([
            'teacher_id' => $teacher_id,
            'username' => $data['username'],
            'usertype' => 1,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request) {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if(empty($user)) { // Failed to register user
            return redirect('usermanage')->withErrors($validator)->withInput();
        }

        return redirect('usermanage');
    }

    public function registerTeacher(Request $request, $teacher_id) {
        \Log::INFO('teacherid2='.$teacher_id);
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->createTeacher($request->all(), $teacher_id)));

        if(empty($user)) { // Failed to register user
            return $validator;
        }

        return 0;
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'username' => 'required|string|max:255',
                    'usertype' => 'required|integer',
                    'password' => 'nullable|string|min:6|confirmed',
                ]);

        if ($validator->fails()) {
            return redirect('usermanage')->withErrors($validator)->withInput()->withMessage($id);
        }


        $user->username = $request->username;

        if($user->teacher_id == null)
        {
            $user->name = $request->name;
        }
        else
        {
            $teacher = \App\Teacher::find($user->teacher_id);
            $teacher->name = $request->name;
            $teacher->save();
        }
        
        $user->usertype = $request->usertype;

        if ( ! $request->password == '')
        {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/usermanage')->withSuccess("修改成功!");
    }

    public function changeusernamepassword(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
                    'username' => 'required|string|max:255',
                    'passwordchanged' => 'nullable|string|min:6|confirmed',
                ]);


        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ( ! $request->passwordchanged == '')
        {
            $user->password = Hash::make($request->passwordchanged);
        }


        if ( ! $request->username == '')
        {
            $user->username = $request->username;
        }

        

        $user->save();

        return back();
    }

    public function changeTeacherName(Request $request, $teacher)
    {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                ]);

        if ($validator->fails()) {
            \Log::INFO("fail");
            return back()->withErrors($validator);
        }

        $teacher->name = $request->name;
        $teacher->save();
    }

}
