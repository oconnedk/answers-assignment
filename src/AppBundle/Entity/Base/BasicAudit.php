<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 14:35
 */

namespace AppBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User;

/**
 * Class BasicAudit
 * Represents basic "who created this?" and "at what time" attributes to avoid repetition
 * @package AppBundle\Entity\Base
 */
class BasicAudit
{
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    protected $createdBy;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @param User $createdBy
     */
    public function __construct($createdBy)
    {
        $this->createdBy = $createdBy;
        $this->createdAt = new \DateTime();
    }

    /**
     * @param User $createdBy
     * @return BasicAudit
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return User
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