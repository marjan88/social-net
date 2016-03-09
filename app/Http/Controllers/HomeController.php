<?php

namespace MqCMS\Http\Controllers;

use MqCMS\Http\Controllers\Controller;
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
            return view('user::timeline.index');
        }
        return view('home');
    }

}
