<?php

namespace Modules\ImageAlbum\Repositories;

use Modules\ImageAlbum\Entity\ImageAlbum;
//use Modules\Image\Entities\Image;
//use Modules\User\Entities\User;
use Doctrine\ORM\EntityManager;

class ImageAlbumRepository
{

    /**
     * @var string
     */
    private $class = 'Modules\ImageAlbum\Entity\ImageAlbum';

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function AlbumOfId($id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id
        ]);
    }

//    public function getUserAlbums() {
//        return \Auth::user()->albums();
//    }
//
//    public function storeImages($request) {
//
//        $albumData = [
//            'name' => $request->name,
//            'slug' => $this->slugify($request->name),
//            'visible' => $request->visible,
//        ];
//
//        $album = ImageAlbum::firstOrCreate($albumData);
//        $album->user()->associate(\Auth::user())->save();
//
//        $files = $request->file('images');
//        if (is_array($files)) {
//
//            foreach ($files as $file) {
//                $data = [
//                    'name' => md5($file->getClientOriginalName()),
//                    'size' => filesize($file),
//                    'type' => $file->getClientOriginalExtension(),
//                ];
//                $image = Image::storeItem($data);
//                $image->album()->associate($album)->save();
//                $filePath = public_path() . '/appfiles/images/' . \Auth::id() . '/' . $album->slug;
//                $fileName = $data['name'] . '.' . $data['type'];
//                $file->move($filePath, $fileName);
//            }
//        }
//
//        return true;
//    }
//
//    // GEENRATE SLUG
//    
//   public function slugify($text) {
//        // replace non letter or digits by -
//        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
//        // trim
//        $text = trim($text, '-');
//        // transliterate
//        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
//        // lowercase
//        $text = strtolower($text);
//        // remove unwanted characters
//        $text = preg_replace('~[^-\w]+~', '', $text);
//        if (empty($text)) {
//            return 'n-a';
//        }
//        return $text;
//    }
    
    /**
     * create ImageAlbum
     * @return ImageAlbum
     */
    private function prepareData($data)
    {
        return new ImageAlbum($data);
    }
}
