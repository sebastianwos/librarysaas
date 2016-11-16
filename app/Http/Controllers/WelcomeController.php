<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Http\Request;

use App\Http\Requests;

class WelcomeController extends Controller
{

    public function index()
    {
        $libraries = Library::all();
        return view('welcome', compact('libraries'));
    }

}
