<?php

namespace Modules\Image\Model\DoctrineORM;

interface ImageInterface
{

    public function getName();

    public function setName($name);

    public function getUserId();

    public function setUserId($userId);

    public function getType();

    public function setType($type);

    public function getSize();

    public function setSize($size);
    
    public function getAlbumId();

    public function setAlbumId($albumId);
    
    public function getIsProfile();

    public function setIsProfile($isProfile);
}
