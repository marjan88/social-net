<?php

namespace Modules\ImageAlbum\Repositories;

use Modules\ImageAlbum\Entities\ImageAlbum;
use Modules\User\Entities\User;
use ImageCrop;

class ImageAlbumRepository
{

    public function getUserAlbums()
    {
     return  \Auth::user()->albums();
    }

}
