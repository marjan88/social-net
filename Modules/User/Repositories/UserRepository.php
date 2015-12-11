<?php

namespace Modules\User\Repositories;

use Modules\User\Entities\User;

class UserRepository
{

    public function getUserByUsername($username)
    {
        $user = User::getUserByUsername($username);
        
        if (!$user)
            return false;
        return $user;
    }

    public function updateUser($request, $id)
    {
        $user = User::updateUser($request, $id);
        if (!$user)
            throw new \Exception('User could not be updated.');
        return $user;
    }

}
