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
        $this->middleware('auth');
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

    public function getLike($statusId)
    {
        $status = $this->statusRepository->findStatusAndReply($statusId);
        if (!$status)
            return redirect('/');

        if (!\Auth::user()->isFriendsWith($status->user)) {
            return redirect('/');
        }
        if (\Auth::user()->hasLikedStatus($status))
            return redirect()->back();

        $like = $status->like()->create([]);
        \Auth::user()->likes()->save($like);
        return redirect()->back();
    }

    public function deleteLike($statusId)
    {
        $status = $this->statusRepository->findStatusAndReply($statusId);
        if (!$status)
            return redirect('/');

        if (!\Auth::user()->isFriendsWith($status->user)) {
            return redirect('/');
        }
        if (!\Auth::user()->hasLikedStatus($status))
            return redirect()->back();
        $status->like()->where('user_id', \Auth::user()->id)->where('likeable_id', $status->id)->delete();
        return redirect()->back();
    }

    public function getAllStatuses()
    {
        return $this->statusRepository->getAllStatuses();
    }

    public function deleteStatus()
    {
        if (\Request::isMethod('post')) {

            $deleteStatus = $this->statusRepository->deleteStatus(\Input::get('statusId'));

            if (!$deleteStatus)
                return back()->with('error', 'Status could not be deleted, try again.');
 
            return back()->with('success', 'Status successfully deleted.');
        }
        return redirect()->back();
    }

}
