<?php

namespace Modules\Album\Model\DoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Modules\Image\Model\DoctrineORM\Entity\Image;
use Modules\Album\Model\DoctrineORM\AlbumInterface;

/**
 * @ORM\Entity(repositoryClass="Modules\Album\Model\DoctrineORM\Repository\AlbumRepository")
 * @ORM\Table(name="albums") 
 * @ORM\HasLifecycleCallbacks()
 */
class Album implements AlbumInterface
{

    /**
     * @ORM\OneToMany(targetEntity="Modules\Image\Model\DoctrineORM\Entity\Image", mappedBy="album")
     */
    protected $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\Column(name="title",type="string")
     */
    protected $title;

   /**
     * @ORM\Column(name="user_id",type="string")
     */
    protected $userId;

    /**
     * @ORM\Column(name="slug", type="string")
     */
    protected $slug;

    /**
     * @ORM\Column(name="is_visible", columnDefinition="TINYINT DEFAULT 1 NOT NULL")
     */
    protected $visible;

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

    public function setUserId($userId)
    {
        $this->user = $userId;
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

    public function getImages()
    {
        return $this->images;
    }

}
