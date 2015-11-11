<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 14:42
 */

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adds an identifier to the entity
 * Class Identifiable
 * @package AppBundle\Entity\Traits
 */
trait Identifiable
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    private $id;

} 