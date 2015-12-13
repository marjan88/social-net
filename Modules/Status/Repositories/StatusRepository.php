<?php

namespace Modules\Status\Repositories;

use Modules\Status\Entities\Status;

class StatusRepository
{

    public function getAllStatuses()
    {
        return $user = Status::getItems();
    }
    
    public function getAllStatusesAndReplies()
    {
        return $user = Status::getAllStatuses();
    }
    
    public function findStatus($id)
    {
        return $user = Status::getItem($id);
    }
    
    public function findStatusAndReply($id)
    {
        return $user = Status::getItemAndReply($id);
    }
    
     public function saveReply($data)
    {
        return $user = Status::storeItem($data);
    }

   

}
