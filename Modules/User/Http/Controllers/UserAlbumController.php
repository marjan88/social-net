<?php

namespace Modules\User\Http\Controllers;

use Chatty\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Modules\ImageAlbum\Entities\ImageAlbum;

class UserAlbumController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
       print_r($user->albums()->get());exit;
    }

}
