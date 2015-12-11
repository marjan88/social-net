<?php

namespace Modules\Status\Http\Controllers;

use Chatty\Http\Controllers\Controller;
use Modules\Status\Http\Requests\StoreStatusRequest;
use Modules\Status\Repositories\StatusRepository;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    protected $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function postStatus(StoreStatusRequest $request)
    {
        \Auth::user()->statuses()->create([
            'body' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status posted.');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, [
            'reply-' . $statusId => 'required|max:1000',
                ], [
            'required' => 'The reply body is required.'
        ]);

        $status = $this->statusRepository->findStatus($statusId);
        if (!$status)
         return redirect()->back();
 
        if (!\Auth::user()->isFriendsWith($status->user) && \Auth::user()->id !== $status->user->id) {
            return redirect()->back();
        }
        $data = $request->input("reply-{$statusId}");
       
        $reply = $this->statusRepository->saveReply($data);
        $status->replies()->save($reply);
        return redirect()->back();
    }

}
