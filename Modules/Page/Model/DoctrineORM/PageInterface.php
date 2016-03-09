<?php

namespace Modules\Page\Model\DoctrineORM;

interface PageInterface
{

    public function getTitle();

    public function setTitle($title);
    
    public function getName();

    public function setName($name);
    
    public function getContent();

    public function setContent($content);

    public function getUserId();

    public function setUserId($userId);

    public function getSlug();

    public function setSlug($slug);

    public function getVisible();

    public function setVisible($visible);
}
