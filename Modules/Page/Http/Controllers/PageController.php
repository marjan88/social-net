<?php

namespace Modules\Page\Http\Controllers;

use Chatty\Http\Controllers\Controller;

class PageController extends Controller
{

    public function index()
    {
        return view('page::index');
    }

}
