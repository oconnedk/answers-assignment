<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 13/11/15
 * Time: 10:01
 */

namespace AppBundle\Entity;
use AppBundle\Entity\Base\BasicAudit;
use AppBundle\Entity\Traits\Identifiable;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="user_token", indexes={@ORM\Index(name="token_lookup", columns={"token"})})
 * @ORM\Entity
 */
class UserToken extends BasicAudit
{
    use Identifiable;

    const TOKEN_SIZE = 64;
    const LIFETIME_MINS = 15;

    /**
     * @param User
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

    /**
     * @var string
     * @ORM\Column(length = 128)
     */
    private $token;


    /**
     * @var \DateTime
     * @ORM\Column(type = "datetime")
     */
    private $expiryDate;

    /**
     * @param User $for
     * @param User $createdBy
     */
    public function __construct(User $for, User $createdBy)
    {
        parent::__construct($createdBy);
        $this->user = $for;
        $this->token = $token = bin2hex(openssl_random_pseudo_bytes(self::TOKEN_SIZE/2));
        $this->expiryDate = new \DateTime("+".self::LIFETIME_MINS."min");
    }

    /**
     * @return \DateTime
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}