<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Model;

class Image extends Model 
{

    protected $table    = 'images';
    protected $fillable = ['name', 'user_id', 'type', 'size',];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'user_id');
    }
   
    public static function storeItem($request)
    {
        
    }

    public static function deleteItem($id)
    {
        
    }

    public function like()
    {
        return $this->morphMany('Modules\Status\Entities\Like', 'likeable');
    }

}
