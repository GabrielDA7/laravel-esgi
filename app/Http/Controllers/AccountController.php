<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Group;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
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
  * Add an account.
  *
  * @return \Illuminate\Http\Response
  */
  public function add(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'username' => 'required',
      'password' => 'required'
    ]);

    if($validator->fails()) {
      return redirect()
      ->route('vault')
      ->withErrors($validator)
      ->withInput();
    }

    $account = new Account;
    $account->name = $request->name;
    $account->username = $request->username;
    $account->password = \CustomHash::encrypt_decrypt('encrypt', $request->password, \Auth::user()->password);
    $account->url = $request->url;
    $account->user_id = \Auth::id();
    $account->save();

    Session::flash('succes', 'Account successfully added');

    return redirect()->route('vault');
  }

  /**
  * Edit an account.
  *
  * @return \Illuminate\Http\Response
  */
  public function edit($account_id)
  {
    $account = Account::find($account_id);
    return view('account.editAccount', ['account' => $account]);
  }

  /**
  * Update an account.
  *
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $account_id)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'username' => 'required',
      'password' => 'required'
    ]);

    if($validator->fails()) {
      var_dump($validator);die;
      return redirect()
      ->route('account.edit', ['id' => $account_id])
      ->withErrors($validator)
      ->withInput();
    }

    $account = Account::find($account_id);
    $account->name = $request->name;
    $account->url = $request->url;
    $account->username = $request->username;
    $account->password = \CustomHash::encrypt_decrypt('encrypt', $request->password, $account->user->password);
    $account->save();

    Session::flash('succes', 'Account successfully updated');

    return redirect()->route('vault');
  }

  /**
  * Delete an account.
  *
  * @return \Illuminate\Http\Response
  */
  public function delete(Request $request)
  {
    $account = Account::find($request->id);
    $group = Group::find($request->group_id);
    Session::flash('succes', 'Account successfully deleted');
    if ($account->user_id == \Auth::id() || (isset($group) && $group->author == \Auth::id())) {
      if(!isset($group)){
        $account->delete();
        return redirect()->route('vault');
      }
      $group->accounts()->detach($account->id);
      return redirect()->route('groups', ['group_id'=>$group->id]);
    }
  }

  /**
  * Share accounts.
  *
  * @return \Illuminate\Http\Response
  */
  public function share(Request $request)
  {
    $group = Group::find($request->group_id);
    if(isset($group)){
      foreach ($request->userAccounts as $userAccount_id=>$userAccount) {
        if(!$group->accounts->contains($userAccount_id)) {
          $group->accounts()->attach($userAccount_id);
        }
      }
      Session::flash('succes', 'Account successfully shared');
      return redirect()->route('group.show', ['id'=>$group->id]);
    }
    return redirect()->route('group');
  }
}
