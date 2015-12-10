<?php

namespace Modules\User\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Modules\User\Entities\UserInterface;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, UserInterface
{

    use Authenticatable,
        Authorizable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'first_name', 'last_name', 'location'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getNameOrUsername()
    {
        return ($this->first_name && $this->last_name) ? $this->first_name . ' ' . $this->last_name : $this->username;
    }

    public static function searchForUser($query)
    {
        $users = User::where(\DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
                ->orWhere('username', 'LIKE', "%{$query}%")
                ->get();

        if (count($users) > 0) {
            return $users;
        }
        return false;
    }

    public function getAvatarUrl($size)
    {
        return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm&s=' . $size;
    }

    public static function getUser($username)
    {
        $users = User::where('username', $username)->first();
        if ($users) {
            return $users;
        }
        return false;
    }

    public static function storeUser()
    {
        ;
    }

    public static function updateUser($request, $id)
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'location'   => $request->location,
        ];
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            return true;
        }
        return false;
    }

    public static function deleteUser()
    {
        ;
    }

}
