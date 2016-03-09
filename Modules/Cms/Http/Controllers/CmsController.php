<?php

namespace Modules\Cms\Http\Controllers;

use MqCMS\Http\Controllers\Controller;

class CmsController extends Controller
{

    public function index()
    {
        return view('cms::backend.index');
    }

}
