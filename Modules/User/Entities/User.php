<?php

namespace Modules\User\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Modules\User\Entities\UserInterface;
use Modules\Status\Entities\Status;
use Modules\Image\Entities\Image;
use Modules\Album\Model\DoctrineORM\Entity\Album;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="Album", mappedBy="users", cascade={"persist"})
     * @var ArrayCollection|Album[]
     */
    protected $albums;
    
     public function __construct()
    {

        $this->albums = new ArrayCollection;
    }
    
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

    public function statuses()
    {
        return $this->hasMany('Modules\Status\Entities\Status', 'user_id');
    }
    
    public function getAlbums() {
        return $this->albums;
    }
    
//    public function albums(){
//        return $this->hasMany('Modules\Album\Model\DoctrineORM\Entity\Album', 'user_id');
//    }

    public function getNameOrUsername()
    {
        return ($this->first_name) ? $this->first_name : $this->username;
    }

    public function getFullName()
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

    public function getProfilePicture()
    {
        $image = $this->images()->where('is_profile', true)->first();
        if($image && $image->album)
            return asset('/appfiles/images/' . $this->id . '/' . $image->album->slug . '/' . $image->name . '.' . $image->type);
        return $this->getAvatarUrl();
    }

    public function getAvatarUrl($size = 200)
    {
        return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm&s=' . $size;
    }

    public static function getUserByUsername($username)
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

    public function getFriendsOfMine()
    {
        return $this->belongsToMany('Modules\User\Entities\User', 'friends', 'user_id', 'friend_id');
    }

    public function getFriendOf()
    {
        return $this->belongsToMany('Modules\User\Entities\User', 'friends', 'friend_id', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('Modules\Status\Entities\Like', 'user_id');
    }

    public function images()
    {
        return $this->hasMany('Modules\Image\Entities\Image', 'user_id');
    }

    public function getFriends()
    {
        return $this->getFriendsOfMine()->wherePivot('accepted', true)->get()
                        ->merge($this->getFriendOf()->wherePivot('accepted', true)->get());
    }

    public function getFriendRequests()
    {
        return $this->getFriendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function getFriendRequestPending()
    {
        return $this->getFriendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->getFriendRequestPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->getFriendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->getFriendOf()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->getFriendsOfMine()->detach($user);
        $this->getFriendOf()->detach($user);
        return true;
    }

    public function acceptFriendRequest(User $user)
    {
        $this->getFriendRequests()->where('id', $user->id)->first()->pivot->update(['accepted' => true]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->getFriends()->where('id', $user->id)->count();
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->like()->where('likeable_id', $status->id)
                        ->where('likeable_type', get_class($status))
                        ->where('user_id', $this->id)->count();
    }

}
