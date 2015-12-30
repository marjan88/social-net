<?php

namespace Modules\ImageAlbum\Model;

interface ImageAlbumInterface
{
    public function getName();
    public function setName($name);
    public function getUserId();
    public function setUserId($userId);
    public function getImageId();
    public function setImageId($imageId);
    public function getSlug();
    public function setSlug($slug);
}
