<?php

namespace Modules\User\Services;

use Validator;
use Modules\User\Jobs\SendMailConfirm;
use Modules\User\Model\DoctrineORM\Repository\UserRepository;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract
{

    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
                    'username'   => 'required|max:255',
                    'email'      => 'required|email|max:255|unique:Modules\User\Model\DoctrineORM\Entity\User,email',
                    'password'   => 'required|confirmed|min:6',
                    'first_name' => 'required',
                    'last_name'  => 'required',
        ]);
    }

    public function create(array $data)
    {
        $confirmation = \Config::get('module.user.auth.confirmation');        
        $key          = \Config::get('app.key');
        $item         = $this->userRepo->createItem();
        $item->setUsername($data['username']);
        $item->setEmail($data['email']);
        $item->setPassword(bcrypt($data['password']));
        $item->setFirstName($data['first_name']);
        $item->setLastName($data['last_name']);
        if ($confirmation)
            $item->setConfirmationCode(hash_hmac('sha256', str_random(40), $key));
        $item->setCreatedAt(new \DateTime);
        $item->setUpdatedAt(new \DateTime);

        $user = $this->userRepo->saveItem($item);
        
        // Send Mail Confirmation
        if ($confirmation)
            \Bus::dispatch(new SendMailConfirm($user));

        return $user;
    }

}
