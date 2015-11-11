<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 12:02
 */

namespace AppBundle\Entity;
use AppBundle\Entity\Base\BasicAudit;
use AppBundle\Entity\Traits\Identifiable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Table(name="answer")
 * @ORM\Entity
 * @UniqueEntity("title")   -- probably doesn't make sense to have exactly the same question more than once
 */
class Answer extends BasicAudit
{
    use Identifiable;

    /**
     * @var string
     * @ORM\Column(length = 255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type = "text", length = 65535)
     */
    private $content;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="answer")
     */
    private $comments;

    /**
     * @var ArrayCollection
     * Set-up as a one-to-many using many-to-many join table, as attachments can relate to both answers and comments
     * We want an attachment to relate to one-and-only one Answer
     * @ORM\ManyToMany(targetEntity="Attachment")
     * @ORM\JoinTable(
     *  name="answer_attachment",
     *  joinColumns={
     *      @ORM\JoinColumn(
     *          name="answer_id",
     *          referencedColumnName="id"
     *      )
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(
     *          name="attachment_id",
     *          referencedColumnName="id",
     *          unique = true  )
     *  }
     * )
     */
    private $attachments;

    /**
     * @param string $title
     * @param string $content
     * @param string $createdBy -- FIXME: will be User once user model chosen
     */
    public function __construct($title, $content, $createdBy)
    {
        parent::__construct($createdBy);
        $this->title = $title;
        $this->content = $content;
        $this->comments = new ArrayCollection();
        $this->attachments = new ArrayCollection();
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
     * @return Answer
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
     * @param string $title
     * @return Answer
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

}