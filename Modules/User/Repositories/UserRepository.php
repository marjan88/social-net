<?php

namespace Modules\User\Repositories;

use Modules\User\Entities\User;

class UserRepository
{

    public function getUser($username)
    {
        $user = User::getUser($username);
        
        if (!$user)
             throw new \Exception('Something went wrong.');
        return $user;
    }

    public function updateUser($request, $id)
    {
        $user = User::updateUser($request, $id);
        if (!$user)
            throw new \Exception('Updating failed');
        return $user;
    }

}
