<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 12:12
 */

namespace AppBundle\Entity;
use AppBundle\Entity\Base\BasicAudit;
use AppBundle\Entity\Traits\Identifiable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="attachment")
 * @ORM\Entity
 * @UniqueEntity("path")   -- path needs to be unique to prevent existing files being over-written
 */
class Attachment extends BasicAudit
{
    use Identifiable;

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

    /**
     * @var string
     * @ORM\Column(length = 32)
     */
    private $extension;

    /**
     * @param string $path
     * @param int $size
     * @param string $extension
     * @param User $createdBy
     */
    public function __construct($path, $size, $extension, $createdBy)
    {
        parent::__construct($createdBy);
        $this->path = $path;
        $this->size = $size;
        $this->extension = $extension;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $extension
     * @return Attachment
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $path
     * @return Attachment
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param int $size
     * @return Attachment
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

}