<?php

namespace Modules\User\Services;

use Validator;
use Modules\User\Entities\User;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract
{

    public function validator(array $data)
    {
        return Validator::make($data, [
                    'username'   => 'required|max:255|unique:users',
                    'email'      => 'required|email|max:255|unique:users',
                    'password'   => 'required|confirmed|min:6',
                    'first_name' => 'required',
                    'last_name'  => 'required',
                    'location'   => 'required',
        ]);
    }

    public function create(array $data)
    {
        return User::create([
                    'username'   => $data['username'],
                    'email'      => $data['email'],
                    'password'   => bcrypt($data['password']),
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'location'   => $data['location'],
        ]);
    }

}
