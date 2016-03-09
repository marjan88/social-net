<?php

namespace Modules\Image\Http\Controllers;

use MqCMS\Http\Controllers\Controller;
use Modules\Image\Repositories\ImageRepository;
use Modules\Image\Http\Requests\ImgStoreRequest;

class ImageController extends Controller
{

    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;

        $this->middleware('auth');
    }

    public function storeImage(ImgStoreRequest $request)
    {
        if (\Request::isMethod('post')) {
            if ($request->hasFile('profile_image')) {               
                $this->imageRepository->storeImage($request);
                return redirect()->back()->with('success', 'Profile picture has been successfully changed.');
            }
        }
        return redirect()->back();
    }

}
