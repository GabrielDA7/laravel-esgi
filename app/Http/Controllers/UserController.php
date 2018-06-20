<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('profile');
    }

    /**
     * Get user by keyword
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if(strlen($request->keyword) >= 3){
          $result = DB::table('users')->where(function($query) use ($request){
                        $query->where('name', 'like', '%' . $request->keyword .'%')
                              ->orWhere('email', 'like', '%' . $request->keyword .'%');
                      })
                      ->where('users.id', '!=', \Auth::id())
                      ->get()->toArray();
        } else {
          $result = [];
        }
        return response()->json(['result'=>$result]);
    }

}
