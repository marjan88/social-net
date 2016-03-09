<?php

namespace Modules\User\Http\Controllers;

use MqCMS\Http\Controllers\Controller;
use Modules\User\Http\Requests\EditProfileRequest;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;

class ProfileController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth');
    }

    public function getProfile($username)
    {
        $user = $this->userRepository->getUserByUsername($username);

        if (!$user) {
            abort(404);
        }
        $mutualFriends = $user->getFriends();
//        echo '<pre>';print_r($mutualFriends);exit;
        $numMutualFriends = [];
        foreach($mutualFriends as $mutualFriend){
            if(\Auth::user()->isFriendsWith($mutualFriend)) {
                $numMutualFriends[] = $mutualFriend->id;
            }
        }        
        $statuses = $user->statuses()->notReply()->get();
        $authUserIsFriend = \Auth::user()->isFriendsWith($user);
        return view('user::profile.index', compact('user', 'statuses', 'authUserIsFriend', 'numMutualFriends'));
    }

    public function getEdit()
    {
        return view('user::profile.edit', compact('user'));
    }

    public function postEdit(EditProfileRequest $request)
    {
        try {
            $user = $this->userRepository->updateUser($request, \Auth::user()->id);
            return redirect()->route('user.profile.edit')->with('success', 'You have successfully updated your profile.');
        } catch (Exception $e) {
            return redirect()->route('user.profile.edit')->with('error', $e->getMessage());
        }
    }

}
