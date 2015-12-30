<?php

namespace Modules\Album\Model\DoctrineORM;

interface AlbumInterface
{

    public function getTitle();

    public function setTitle($title);

    public function getUserId();

    public function setUserId($userId);

    public function getSlug();

    public function setSlug($slug);

    public function getVisible();

    public function setVisible($visible);
}
