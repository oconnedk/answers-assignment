<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 12:31
 */

namespace AppBundle\Entity;
use AppBundle\Entity\Traits\Identifiable;
use Doctrine\ORM\Mapping as ORM;


/**
 * This entity represents an answer which has been search-upon (and retrieved as a result of that search)
 * @ORM\Table(name="answer_search_stat")
 * @ORM\Entity
 */
class AnswerSearchStat
{
    use Identifiable; // Having an ID here allows us to easily identify a given row

    /**
     * @var Answer
     * @ORM\OneToOne(targetEntity="Answer")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     */
    private $answer;

    /**
     * @var \DateTime
     * @ORM\Column(type = "datetime", name = "search_time")
     */
    private $searchTime;

    /**
     * @param Answer $answer
     */
    public function __construct($answer)
    {
        $this->answer = $answer;
        $this->searchTime = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Answer $answer
     * @return AnswerSearchStat
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

}