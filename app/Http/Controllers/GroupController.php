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
     * Show the user groups.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('groups');
    }

    /**
     * Add the user group.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('addGroup');
    }

    /**
     * Delete the user group.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        return view('addGroup');
    }
}
