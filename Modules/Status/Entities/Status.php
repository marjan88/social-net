<?php

namespace Modules\Status\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Status\Entities\StatusInterface;

class Status extends Model implements StatusInterface
{

    protected $table    = 'statuses';
    protected $fillable = ['body', 'user_id', 'parent_id',];
    protected $appends  = [
        'user_name',
        'full_name',
        'avatar',
        'when_created',
    ];

    public function getAvatarAttribute()
    {
        return $this->user()->where('id', $this->user_id)->first()->getProfilePicture();
    }

    public function getUserNameAttribute()
    {
        return $this->user()->where('id', $this->user_id)->first()->username;
    }

    public function getFullNameAttribute()
    {
        return $this->user()->where('id', $this->user_id)->first()->first_name . ' ' . $this->user()->where('id', $this->user_id)->first()->last_name;
    }

    public function getWhenCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'user_id');
    }

    public function getAllStatuses()
    {
        $statuses = Status::all();
        if (!$statuses->count())
            return false;
        return $statuses;
    }

    public static function getItems()
    {
        $statuses = Status::where(function($query) {
                    return $query->where('user_id', \Auth::user()->id)
                                    ->orWhereIn('user_id', \Auth::user()->getFriends()->lists('id'));
                })->whereNull('parent_id')->orderBy('created_at', 'desc')->get();

        if (!$statuses->count())
            return false;
        return $statuses;
    }

    public static function getItem($id)
    {
        $status = Status::whereNull('parent_id')->find($id);
        if ($status)
            return $status;
        return false;
    }

    public static function getItemAndReply($id)
    {
        $status = Status::find($id);
        if ($status)
            return $status;
        return false;
    }

    public static function storeItem($request)
    {
        $data     = [
            'body' => $request,
        ];
        $statuses = Status::create($data)->user()->associate(\Auth::user());

        if ($statuses)
            return $statuses;
        return false;
    }

    public static function deleteItem($id)
    {
        $status = Status::getItemAndReply($id);
        if ($status) {
            if ($status->user_id !== \Auth::id())
                return false;
            if ($status->replies()->count())
                $status->deleteRepliesAndLikes();
            $status->like()->delete();
            $status->delete();
            return true;
        }
        return false;
    }

    public function deleteRepliesAndLikes()
    {
        $replies = $this->replies()->get();
        foreach ($replies as $reply) {
            $reply->like()->delete();
        }
        $this->replies()->delete();
        
    }

    public function replies()
    {
        return $this->hasMany('Modules\Status\Entities\Status', 'parent_id');
    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function like()
    {
        return $this->morphMany('Modules\Status\Entities\Like', 'likeable');
    }

}
