<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class VaultController extends Controller
{
  /**
   * Show the user vault.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $accounts = Account::where('user_id', '=', \Auth::id())->get();
      return view('vault.vault', ['accounts'=>$accounts]);
  }

}
