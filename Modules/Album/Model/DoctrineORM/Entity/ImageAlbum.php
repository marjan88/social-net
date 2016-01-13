<?php

class ImageAlbum 
{

    protected $table    = 'albums';
    protected $fillable = ['name', 'user_id', 'image_id', 'slug'];

    public function images()
    {
        return $this->hasMany('Modules\Image\Entities\Image', 'album_id');
    }

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'user_id');
    }

    public static function storeItem($request)
    {
        $img = ImageAlbum::create($request);
        if ($img)
            return $img;
        return false;
    }

    public static function getItem($imgId)
    {
        $img = ImageAlbum::where('user_id', \Auth::id())->where('image_id', $imgId)->first();
        if ($img)
            return $img;
        return false;
    }

    public static function deleteItem($id)
    {
        
    }

}
