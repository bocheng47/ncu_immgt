<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) { // 非系辦帳號無法使用本層
		    $user = Auth::user();
		    if($user->usertype == 0)
		    	return $next($request);
		    return redirect('/');
		});
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        return view('auth.usermanage')->withUsers(User::All());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUsers($id)
    {
        $users = User::findOrFail($id);

	    $users->delete();

		return view('auth.usermanage')->withUsers(User::All());
    }
}
