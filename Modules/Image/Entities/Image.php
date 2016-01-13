<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table    = 'images';
    protected $fillable = ['name', 'user_id', 'type', 'size', 'is_profile', 'album_id'];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'user_id');
    }

    public function album()
    {
        return $this->belongsTo('Modules\Album\Model\DoctrineORM\Entity\Album', 'album_id');
    }

    public static function storeItem($request)
    {
        $img = Image::create($request)->user()->associate(\Auth::user());
        if ($img)
            return $img;
        return false;
    }

    public static function getItem()
    {
        $img = Image::where('user_id', \Auth::id())->where('is_profile', true)->first();
        if ($img)
            return $img;
        return false;
    }
    
    
    public static function deleteItem($id)
    {
        
    }
    
    public function getImagePath() {
        return asset('appfiles/images/' .  \Auth::id() . '/'. $this->album->slug . '/' .$this->name . '.' . $this->type);
    }

    public function like()
    {
        return $this->morphMany('Modules\Status\Entities\Like', 'likeable');
    }

}
