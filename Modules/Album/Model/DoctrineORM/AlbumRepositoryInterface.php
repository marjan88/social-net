<?php

namespace Modules\Album\Model\DoctrineORM;

interface AlbumRepositoryInterface
{
  
    public function findItems($options);
}
