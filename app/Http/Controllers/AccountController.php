<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;

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
        'name' => 'required|unique:accounts|max:255',
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
      'name' => 'required|unique:accounts|max:255',
      'username' => 'required',
      'password' => 'required'
    ]);

    if($validator->fails()) {
      return redirect()
                  ->route('account.edit', ['id' => $account->id])
                  ->withErrors($validator)
                  ->withInput();
    }

    $account = Account::find($account_id);
    if($this->authorize('update', $account)) {
        $account->name = $request->name;
        $account->url = $request->url;
        $account->username = $request->username;
        $account->password = \CustomHash::encrypt_decrypt('encrypt', $request->password, \Auth::user()->password);
        $account->save();
        return redirect()->route('vault');
    } else {
      echo 'non autorisé';
    }
  }

  /**
   * Delete an account.
   *
   * @return \Illuminate\Http\Response
   */
  public function delete()
  {

  }
}
