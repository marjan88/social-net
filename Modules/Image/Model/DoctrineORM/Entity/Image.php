<?php

namespace Modules\Image\Model\DoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Modules\Image\Model\DoctrineORM\Entity\Album;
use Modules\Image\Model\DoctrineORM\ImageInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="images")
 * @ORM\HasLifecycleCallbacks()
 */
class Image implements ImageInterface
{

    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @ORM\Column(name="name",type="string")
     */
    private $name;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @ORM\Column(name="size", type="integer")
     */
    private $size;

    /**
     * @ORM\Column(name="is_profile", type="tinyInt")
     */
    private $isProfile;

    /**
     * @ORM\Column(name="album_id", type="integer")
     */
    private $albumId;

    /**
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="images")
     * @var Album
     */
    protected $album;

    public function __construct()
    {

        $this->album = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getAlbumId()
    {
        return $this->albumId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setAlbumId($albumId)
    {
        $this->userId = $albumId;
    }

    public function getIsProfile()
    {
        return $this->isProfile;
    }

    public function setIsProfile($isProfile)
    {
        $this->isProfile = $isProfile;
    }

    public function setAlbum(Album $album)
    {
        $this->album = $album;
    }

    public function getAlbum()
    {
        return $this->album;
    }

}
