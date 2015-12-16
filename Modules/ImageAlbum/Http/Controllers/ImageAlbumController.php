<?php

namespace Modules\ImageAlbum\Http\Controllers;

use Chatty\Http\Controllers\Controller;
use Modules\ImageAlbum\Repositories\ImageAlbumRepository;
use Modules\ImageAlbum\Http\Requests\ImageAlbumStoreRequest;


class ImageAlbumController extends Controller
{

    protected $imageAlbumRepository;

    public function __construct(ImageAlbumRepository $imageAlbumRepository)
    {
        $this->imageAlbumRepository = $imageAlbumRepository;

        $this->middleware('auth');
    }

    public function index()
    {
        print_r(\Auth::user()->albums());
    }

}
