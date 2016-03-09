<?php

namespace Modules\Blog\Http\Controllers;

use MqCMS\Http\Controllers\Controller;
use Modules\Blog\Model\DoctrineORM\Repository\BlogRepository;

class BlogController extends Controller
{

    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;

        $this->middleware('auth');
    }

    public function index()
    {
       
    }

}
