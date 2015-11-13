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
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\ManyToOne(targetEntity="Answer", inversedBy="comments")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     **/
    private $answer;

    /**
     * @var ArrayCollection
     * Set-up as a one-to-many using many-to-many join table, as attachments can relate to both answers and comments
     * We want an attachment to relate to one-and-only one Comment
     * @ORM\ManyToMany(targetEntity="Attachment", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *  name="comment_attachment",
     *  joinColumns={
     *      @ORM\JoinColumn(
     *          name="comment_id",
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
     * @param Answer $answer
     * @param string $content
     * @param User $createdBy
     */
    public function __construct(Answer $answer, $content, $createdBy)
    {
        parent::__construct($createdBy);
        $this->answer = $answer;
        $this->content = $content;
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
     * @param Attachment $attachment
     * @return Comment
     */
    public function addAttachment(Attachment $attachment)
    {
        // Prevent duplicate attachments for this comment
        if (!$this->attachments->contains($attachment)) {
            $this->attachments->add($attachment);
        }
        return $this;
    }

    /**
     * @return Attachment[]
     */
    public function getAttachments()
    {
        return $this->attachments->toArray();
    }

}