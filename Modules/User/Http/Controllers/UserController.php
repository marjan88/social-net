<?php

namespace Modules\User\Http\Controllers;

use Chatty\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        return view('user::index');
    }

}
