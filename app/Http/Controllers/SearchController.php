<?php

namespace Chatty\Http\Controllers;

use Chatty\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Chatty\User;

class SearchController extends Controller
{

    public function getResults(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('home');
        }
        
        $users = User::searchForUser($query);
        
        return view('search.results', compact('users'));
    }

}
