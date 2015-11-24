<?php

namespace Chatty\Http\Controllers;

use Chatty\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

}
