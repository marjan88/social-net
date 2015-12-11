<?php

namespace Modules\Status\Repositories;

use Modules\Status\Entities\Status;

class StatusRepository
{

    public function getStatuses()
    {
        return $user = Status::getItems();
    }
    
    public function findStatus($id)
    {
        return $user = Status::getItem($id);
    }
    
     public function saveReply($data)
    {
        return $user = Status::storeItem($data);
    }

   

}
