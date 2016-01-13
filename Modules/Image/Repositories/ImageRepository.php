<?php

namespace Modules\Image\Repositories;

use Modules\Image\Entities\Image;
//use Modules\ImageAlbum\Entities\ImageAlbum;
use ImageCrop;

class ImageRepository
{

    public function storeImage($request)
    {
        
        $file        = $request->file('profile_image');
        $data        = [
            'name'       => md5($file->getClientOriginalName()),
            'size'       => filesize($file),
            'type'       => $file->getClientOriginalExtension(),            
            'is_profile' => 1,
        ];
        $previousImg = Image::getItem();
        if ($previousImg)
            $previousImg->update(['is_profile' => false]);
        $image    = Image::storeItem($data);
//        $album = ImageAlbum::firstOrCreate(['name' => 'Profile Pictures', 'slug' => 'profile-pictures']);
        $album->user()->associate(\Auth::user())->save();
        $image->album()->associate($album)->save();
        $filePath = public_path() . '/appfiles/images/' . \Auth::id() . '/' . $album->slug . '/';
        $fileName = $data['name'] . '.' . $data['type'];

        if (file_exists($filePath . $fileName))
            unlink($filePath . $fileName);

        $file->move($filePath, $fileName);

        $crop = ImageCrop::make($filePath . $fileName);
        $crop->fit(200, 200);
        $crop->save($filePath . $fileName);

        return;
    }

}
