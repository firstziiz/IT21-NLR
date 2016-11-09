<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends MainController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.login');
    }

    public function abc()
    {
        return "6666";
    }
}
