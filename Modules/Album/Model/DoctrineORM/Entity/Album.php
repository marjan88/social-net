<?php

namespace Modules\Album\Model\DoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Modules\Image\Model\DoctrineORM\Entity\Image;
use Modules\Album\Model\DoctrineORM\AlbumInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="albums")
 * @Entity(repositoryClass="Modules\Album\Model\DoctrineORM\Repository\AlbumRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Album implements AlbumInterface
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
     * @ORM\Column(name="title",type="string")
     */
    private $title;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

    /**
     * @ORM\Column(name="visible", type="bool")
     */
    private $visible;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="albums", cascade={"persist"})
     * @var ArrayCollection|Theory[]
     */
    protected $images;

    public function __construct()
    {

        $this->images = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setUserId($user_id)
    {
        $this->userId = $user_id;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    public function addImage(Image $image)
    {
        if (!$this->images->contains($image)) {
            $image->setAlbum($this);
            $this->images->add($image);
        }
    }

    public function getImages()
    {
        return $this->images;
    }

}
