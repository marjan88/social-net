<?php

namespace Modules\Page\Http\Controllers;

use MqCMS\Http\Controllers\Controller;
use Modules\Page\Model\DoctrineORM\Repository\PageRepository;

class PageController extends Controller
{

    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;

        $this->middleware('auth');
    }

    public function index()
    {
       
    }

}
