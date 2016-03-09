<?php

namespace Modules\User\Http\Controllers\Api;

use MqCMS\Http\Controllers\Controller;

class ApiController extends Controller
{

    public function getRequests()
    {
        if (\Modules\User\Entities\User::count())
            return response()->json(['requests' => true, 'friends' => \Modules\User\Entities\User::all()]);
        return response()->json(['requests' => false]);
    }

}
