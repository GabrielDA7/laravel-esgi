<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Group;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        if($groups->isEmpty()) {
          $groups = null;
        }
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
        $group = new Group(['name'=>$request->name, 'author'=>\Auth::id()]);
        $user->groups()->save($group);

        Session::flash('succes', 'Group successfully added');

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
        $groupMembers = $group->users()->where('id', '!=', \Auth::id())->get();
        if ($groupMembers->isEmpty()) {
          $groupMembers = null;
        }
        $userAccounts = User::find(\Auth::id())->accounts;
        if ($userAccounts->isEmpty()){
          $userAccounts = null;
        }
        return view('vault.vault', ['accounts'=>$accounts, 'userAccounts'=>$userAccounts, 'groupMembers'=>$groupMembers, 'group'=>$group,'title'=>$group->name.'\'s keys']);
    }

    /**
     * Delete the user group.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
      $group = Group::find($request->id);
      if($group->author == \Auth::id()){
        $group->delete();
      } else {
        $group->users()->toggle([\Auth::id()]);
        $list_accounts_ids = $group->accounts()->where('user_id', '=' ,\Auth::id())->pluck('id')->toArray();
        $group->accounts()->detach($list_accounts_ids);
      }

      Session::flash('succes', 'Group successfully deleted');

      return redirect()->route('groups');

    }

    /**
     * Share the user group.
     *
     * @return \Illuminate\Http\Response
     */
    public function share(Request $request)
    {
      if(!empty($request->user_added)) {
        $user_ids = explode(";", $request->user_added);
        foreach ($user_ids as $user_id) {
          if(!empty($user_id)) {
            $user = User::find($user_id);
            foreach($request->groups as $group_id => $group_name) {
              $group = Group::find($group_id);
              if(!$group->users->contains($user_id)) {
                $user->groups()->attach($group_id);
              }
            }
          }
        }
      }

      Session::flash('succes', 'Group successfully shared');

      return redirect()->route('groups');
    }

    /**
     * Manage the group members.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage(Request $request)
    {
      $group = Group::find($request->group_id);
      if(isset($group)) {
        foreach ($request->groupMembers as $member_id => $member_name) {
          $group->users()->detach($member_id);
          $list_accounts_ids = $group->accounts()->where('user_id', '=' ,$member_id)->pluck('id')->toArray();
          $group->accounts()->detach($list_accounts_ids);
        }
        Session::flash('succes', 'User(s) successfully excluded');
        return redirect()->route('group.show', ['group_id'=>$group->id]);
      }
      return redirect()->route('group');
    }
}
