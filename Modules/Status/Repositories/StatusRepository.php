<?php

namespace Modules\Status\Repositories;

use Modules\Status\Entities\Status;

class StatusRepository
{

    public function getAllStatuses()
    {
        return Status::getItems();
    }

    public function getAllStatusesAndReplies()
    {
        return Status::getAllStatuses();
    }

    public function findStatus($id)
    {
        return Status::getItem($id);
    }

    public function findStatusAndReply($id)
    {
        return Status::getItemAndReply($id);
    }

    public function saveReply($data)
    {
        return Status::storeItem($data);
    }

    public function deleteStatus($id)
    {
        return Status::deleteItem($id);
    }

}
