<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * Show the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('groups');
    }

    /**
     * Show the user vault.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('addGroup');
    }
}