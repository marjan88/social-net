<?php

namespace Modules\Album\Http\Controllers;

use MqCMS\Http\Controllers\Controller;
use Modules\Album\Http\Requests\AlbumStoreRequest;
use Modules\Album\Model\DoctrineORM\Repository\AlbumRepository;

class AlbumController extends Controller {

    protected $albumRepo;

    public function __construct(AlbumRepository $albumRepo) {
        $this->albumRepo = $albumRepo;

        $this->middleware('auth');
    }

    public function index() {
      
        $albums =  $this->albumRepo->findItemsByUserId(\Auth::id()); 
    foreach($albums as $album) {
        foreach($album->getImages() as $image) {
            echo '<pre>';print_r($image->getType());
        }
        
    }exit;
        $images = \Auth::user()->images()->get();

        return view('album::index', compact('albums', 'images'));
    }

    public function create() {
        return view('album::create_edit');
    }

    public function store(AlbumStoreRequest $request) {
        if (\Request::isMethod('post')) {
            if ($request->hasFile('images')) {
                $this->albumRepo->storeImages($request);
                return redirect()->back()->with('success', $request->name . ' album was successfully created');
            }
        }
        return redirect()->back();
    }

}
