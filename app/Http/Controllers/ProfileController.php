<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Get user profile view
    public function profile()
    {
    	return view('profile.profile');
    }
    public function editAuth()
    {
    	# code...
    }
    public function updateAuth(Request $request)
    {
    	$this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', ],
        ]);
    	$user = Auth::user();
    	$user->email = $request['email'];
    	$user->phone = $request['phone'];
    	$user->save();
    	return back();
    }
}
