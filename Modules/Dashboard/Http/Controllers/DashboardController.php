<?php

namespace Modules\Dashboard\Http\Controllers;

use Chatty\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin::backend.index');
    }

}
