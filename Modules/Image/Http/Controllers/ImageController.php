<?php

namespace Modules\Image\Http\Controllers;

use Chatty\Http\Controllers\Controller;

class ImageController extends Controller
{

    public function index()
    {
        return view('page::index');
    }

}
