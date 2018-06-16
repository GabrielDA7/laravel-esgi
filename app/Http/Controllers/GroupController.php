<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Group;
use App\User;

class GroupController extends Controller
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
     * Show the user groups.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = User::find(\Auth::id())->groups()->get();
        return view('group.groups', ['groups'=>$groups]);
    }

    /**
     * Add the user group.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'name' => 'required|unique:groups|max:255',
        ]);

        if($validator->fails()) {
          return redirect()
                      ->route('groups')
                      ->withErrors($validator)
                      ->withInput();
        }

        $user = User::find(\Auth::id());
        $group = new Group(['name'=>$request->name]);
        $user->groups()->save($group);
        return redirect()->route('groups');
    }

    /**
     * Edit the group.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($group_id)
    {
        $group = Group::find($group_id);
        $accounts = $group->accounts;
        $userAccounts = User::find(\Auth::id())->accounts;
        return view('vault.vault', ['accounts'=>$accounts, 'userAccounts'=>$userAccounts, 'group'=>$group, 'action'=>'share','title'=>$group->name.'\' keys']);
    }

    /**
     * Delete the user group.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {

    }

    /**
     * Share the user group.
     *
     * @return \Illuminate\Http\Response
     */
    public function share(Request $request)
    {
      var_dump($request->groups);die;
    }
}
