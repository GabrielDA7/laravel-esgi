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
        /*
        Select * from (
        select * from homestead.users u where id != 1 and (email like '%Test%' or name like '%Test%')
        ) as filtered
        LEFT JOIN homestead.group_user gu on gu.user_id = filtered.id
        where gu.group_id is null or gu.group_id != 1
        */
        // Ajout condition : les users n'appartenant pas déjà au group
        if(strlen($request->keyword) >= 3){
          $result = DB::table('users')
                      ->leftJoin('group_user', 'users.id', '=', 'group_user.user_id')
                      ->where(function($query) use ($request){
                        $query->orWhere('name', 'like', '%' . $request->keyword .'%')
                                ->orWhere('email', 'like', '%' . $request->keyword .'%');
                      })
                      ->where(function($query) use ($request) {
                        $query->whereNull('group_user.group_id')
                              ->orWhere(function($query) use ($request){
                                $query->whereNotIn('group_user.group_id', $request->groups_id);
                              });
                      })
                      ->where('users.id', '!=', \Auth::id())->distinct('users.id')->get()->toArray();
        } else {
          $result = [];
        }
        return response()->json(['result'=>$result]);
    }

}
