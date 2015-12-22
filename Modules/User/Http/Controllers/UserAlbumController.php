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
        $albums = $user->albums()->get();
        $images = $user->images()->get();

        return view('image_album::index', compact('albums', 'images'));
    }

}
