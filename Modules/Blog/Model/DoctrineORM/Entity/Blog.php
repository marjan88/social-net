<?php

namespace Modules\Blog\Model\DoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Modules\Blog\Model\DoctrineORM\BlogInterface;

/**
 * @ORM\Entity(repositoryClass="Modules\Blog\Model\DoctrineORM\Repository\BlogRepository")
 * @ORM\Table(name="posts") 
 * @ORM\HasLifecycleCallbacks()
 */
class Blog implements BlogInterface
{
    
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
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

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
    
    public function getContent()
    {
        return $this->content;
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
    
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }


}
