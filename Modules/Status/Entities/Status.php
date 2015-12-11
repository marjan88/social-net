<?php

namespace Modules\Status\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Status\Entities\StatusInterface;

class Status extends Model implements StatusInterface
{

    protected $table    = 'statuses';
    protected $fillable = ['body', 'user_id', 'parent_id'];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'user_id');
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
        if($status)
            return $status;
        return false;
    }
    
     public static function storeItem($request)
    {
         $data = [
             'body' => $request,
         ];         
        $statuses = Status::create($data)->user()->associate(\Auth::user());
        
        if($statuses)
            return $statuses;
        return false;
    }
    
    public function replies(){
        return $this->hasMany('Modules\Status\Entities\Status', 'parent_id');
    }


}
