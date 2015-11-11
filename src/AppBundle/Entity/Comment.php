<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 12:08
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment
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
     * @ORM\Column(type = "text", length = 65535)
     */
    private $content;

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
     * @param string $content
     * @param string $createdBy -- FIXME: will be User once user model chosen
     */
    public function __construct($content, $createdBy)
    {
        $this->content = $content;
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
     * @return Comment
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
     * @return Comment
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

}