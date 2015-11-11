<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 14:35
 */

namespace AppBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BasicAudit
 * Represents basic "who created this?" and "at what time" attributes to avoid repetition
 * @package AppBundle\Entity\Base
 */
class BasicAudit
{
    /**
     * TODO: Replace string value once a user model has been chosen, link to that
     * @var string
     * @ORM\Column(length = 30, name="created_by")
     */
    protected $createdBy;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @param string $createdBy -- FIXME: will be User once user model chosen
     */
    public function __construct($createdBy)
    {
        $this->createdBy = $createdBy;
        $this->createdAt = new \DateTime();
    }

    /**
     * @param mixed $createdBy
     * @return BasicAudit
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
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

} 