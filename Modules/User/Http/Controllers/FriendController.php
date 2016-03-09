<?php

namespace Modules\User\Http\Controllers;

use MqCMS\Http\Controllers\Controller;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;

class FriendController extends Controller {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;

        $this->middleware('auth');
    }

    public function index() {
        $friends = \Auth::user()->getFriends();
        $requests = \Auth::user()->getFriendRequests();
        return view('user::friends.index', compact('friends', 'requests'));
    }

    public function getAdd($username) {
        $user = $this->userRepository->getUserByUsername($username);
        if (!$user)
            return redirect('/')->with('info', 'That user could not be found.');

        if (\Auth::user()->id == $user->id)
            return redirect('/');

        if (\Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(\Auth::user())) {
            return redirect()->route('user.profile', ['username' => $user->username])
                            ->with('info', 'Friend request pending.');
        }

        if (\Auth::user()->isFriendsWith($user)) {
            return redirect()->route('user.profile', ['username' => $user->username])
                            ->with('info', 'You are already friends with ' . $user->getNameOrUsername());
        }

        \Auth::user()->addFriend($user);
        return redirect()->route('user.profile', ['username' => $user->username])
                        ->with('success', 'Friend request sent.');
    }

    public function getAccept($username) {
        $user = $this->userRepository->getUserByUsername($username);
        if (!$user)
            return redirect('/')->with('info', 'That user could not be found.');
        if (!\Auth::user()->hasFriendRequestReceived($user)) {
            return redirect('/');
        }

        \Auth::user()->acceptFriendRequest($user);
        return redirect()->route('user.friends')
                        ->with('success', 'You are now friends with ' . $user->getNameOrUsername());
    }

    public function deleteRequest() {
        if (\Request::isMethod('post')) {
            $username = \Input::get('username');
            $user = $this->userRepository->getUserByUsername($username);

            if (!$user)
                return redirect('/')->with('info', 'That user could not be found.');
            if (\Auth::user()->isFriendsWith($user) || \Auth::user()->hasFriendRequestPending($user) || \Auth::user()->hasFriendRequestReceived($user)) {
                $this->userRepository->deleteUser($user);
                return redirect()->back();
            }

            return redirect()->back();
            //
        }
         return redirect()->back();
    }

   

}
