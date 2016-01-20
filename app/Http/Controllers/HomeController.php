<?php

namespace Chatty\Http\Controllers;

use Chatty\Http\Controllers\Controller;
use Modules\Status\Repositories\StatusRepository;

class HomeController extends Controller
{

    protected $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function index()
    {
        if (\Auth::check()) {            
            $statuses = $this->statusRepository->getAllStatuses();                  
            return view('user::timeline.index', compact('statuses'));
        }
        return view('home');
    }

}
