<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $libraries = $request->user()->libraries;
        $borrowedBooks = $request->user()->books;
        return view('home', compact('libraries', 'borrowedBooks'));
    }
}
