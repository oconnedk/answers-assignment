<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 12:08
 */

namespace AppBundle\Entity;
use AppBundle\Entity\Base\BasicAudit;
use AppBundle\Entity\Traits\Identifiable;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment extends BasicAudit
{
    use Identifiable;

    /**
     * @var string
     * @ORM\Column(type = "text", length = 65535)
     */
    private $content;

    /**
     * @param string $content
     * @param string $createdBy -- FIXME: will be User once user model chosen
     */
    public function __construct($content, $createdBy)
    {
        parent::__construct($createdBy);
        $this->content = $content;
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

}