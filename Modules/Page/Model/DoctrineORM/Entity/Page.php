<?php

namespace Modules\Page\Model\DoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Modules\Page\Model\DoctrineORM\PageInterface;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity(repositoryClass="Modules\Page\Model\DoctrineORM\Repository\PageRepository")
 * @ORM\Table(name="pages") 
 * @ORM\HasLifecycleCallbacks()
 */
class Page implements BlogInterface
{
    use Timestamps;
    
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
     * @ORM\Column(name="name",type="string", nullable=true)
     */
    protected $name;

   /**
     * @ORM\Column(name="user_id",type="string")
     */
    protected $userId;

    /**
     * @ORM\Column(name="slug", type="string", unique=true, nullable=false)
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
    
     public function getName()
    {
        return $this->name;
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
    
    public function setName($name)
    {
        $this->name = $name;
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
