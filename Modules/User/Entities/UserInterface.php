<?php

namespace Modules\User\Entities;

interface UserInterface
{

    public static function getUserByUsername($username);

    public static function storeUser();

    public static function updateUser($request, $id);

    public static function deleteUser();
}
