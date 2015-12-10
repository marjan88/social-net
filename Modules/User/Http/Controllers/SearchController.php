<?php

namespace Modules\User\Http\Controllers;

use Chatty\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Entities\User;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getResults(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('home');
        }

        $users = User::searchForUser($query);

        return view('user::search.results', compact('users'));
    }

}
