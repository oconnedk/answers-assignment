<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 12:12
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="attachment")
 * @ORM\Entity
 */
class Attachment
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(length = 1024)
     */
    private $path;

    /**
     * @var int
     * @ORM\Column(type = "integer")
     */
    private $size;

    /** @ORM\Column(length = 32) */
    private $extension;

    /**
     * TODO: Replace string value once a user model has been chosen, link to that
     * @var string
     * @ORM\Column(length = 30, name="created_by")
     */
    private $createdBy;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @param string $path
     * @param int $size
     * @param string $extension
     * @param string $createdBy -- FIXME: will be User once user model chosen
     */
    public function __construct($path, $size, $extension, $createdBy)
    {
        $this->path = $path;
        $this->size = $size;
        $this->extension = $size;
        $this->createdBy = $createdBy;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $content
     * @return Attachment
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $createdBy
     * @return Attachment
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return string - FIXME: will return User once model chosen
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $title
     * @return Attachment
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

}