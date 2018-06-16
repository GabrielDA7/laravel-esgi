<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VaultController extends Controller
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
   * Show the user vault.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $accounts = User::find(\Auth::id())->accounts()->get();
      return view('vault.vault', ['accounts'=>$accounts,"userAccounts"=>null, 'group'=>null,"action"=>"add", "title"=>"My keys"]);
  }

}
