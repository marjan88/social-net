<?php

namespace Modules\ImageAlbum\Http\Controllers;

use Chatty\Http\Controllers\Controller;
use Modules\ImageAlbum\Repositories\ImageAlbumRepository;
use Modules\ImageAlbum\Http\Requests\ImageAlbumStoreRequest;

class ImageAlbumController extends Controller {

    protected $imageAlbumRepository;

    public function __construct(ImageAlbumRepository $imageAlbumRepository) {
        $this->imageAlbumRepository = $imageAlbumRepository;

        $this->middleware('auth');
    }

    public function index() {
        $albums = \Auth::user()->albums()->get();
        $images = \Auth::user()->images()->get();

        return view('image_album::index', compact('albums', 'images'));
    }

    public function create() {
        return view('image_album::create_edit');
    }

    public function store(ImageAlbumStoreRequest $request) {
        if (\Request::isMethod('post')) {
            if ($request->hasFile('images')) {
                $this->imageAlbumRepository->storeImages($request);
                return redirect()->back()->with('success', $request->name . ' album was successfully created');
            }
        }
        return redirect()->back();
    }

}
