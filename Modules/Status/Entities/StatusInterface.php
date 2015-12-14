<?php

namespace Modules\Status\Entities;

interface StatusInterface
{
    public static function getItem($id);
    public static function getItems();
    public static function storeItem($request);
    public static function deleteItem($id);
    
}
