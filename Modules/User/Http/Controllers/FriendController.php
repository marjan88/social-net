<?php

namespace Modules\User\Http\Controllers;

use Chatty\Http\Controllers\Controller;

use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;

class FriendController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth');
    }

    public function index() {
        $friends = \Auth::user()->getFriends();
        $requests = \Auth::user()->getFriendRequests();
        return view('user::friends.index', compact('friends', 'requests'));
    }

}
