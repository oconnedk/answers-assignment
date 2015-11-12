<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 20:22
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Attachment;
use AppBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAnswerData extends AbstractFixture implements OrderedFixtureInterface
{
    const LOAD_ORDER = 10;
    const BASE_PATH = "/path/to/the/attachments/";

    public function load(ObjectManager $manager)
    {
        $questionData = [
            ["What is the meaning of life?",                0, 0, 0],
            ["What number am I thinking of?",               0, 0, 1],
            ["Is this the real life? Is it just fantasy?",  0, 0, 2],
            ["Are you experienced?",                        0, 1, 0],
            ["Are you really experienced?",                 0, 1, 1],
            ["Where are my files?",                         1, 1, 1],
            ["Where is my mind?",                           1, 1, 2],
            ["Are we there yet?",                           2, 2, 2]
        ];
        foreach ($questionData as $questionEntry)
        {
            list ($question, $numAttachments, $numComments, $numCommentAttachments) = $questionEntry;
            $answerContent = "$question is the question and 5.346 is the answer";
            $answer = new Answer($question, $answerContent, self::getRandomUser());
            for ($i = 0; $i < $numAttachments; ++$i)
            {
                $answer->addAttachment($this->createAttachment($answer));
            }
            for ($i = 0; $i < $numComments; ++$i)
            {
                $answer->addComment($this->createComment($answer, $numCommentAttachments));
            }
            $manager->persist($answer);
        }
        $manager->flush();
    }

    /**
     * Create a comment (with a number of attachments, if specified)
     * @param Answer $answer
     * @param int $numAttachments
     * @return Comment
     */
    private static function createComment(Answer $answer, $numAttachments = 0)
    {
        $numComments = count($answer->getComments()) + 1;
        $comment = new Comment(
            $answer,
            "This is comment number $numComments for the question: ".$answer->getTitle(),
            self::getRandomUser()
        );
        for ($i = 0; $i < $numAttachments; ++$i){
            $comment->addAttachment(self::createAttachment($answer, $comment));
        }
        return $comment;
    }

    /**
     * Convenience method - create attachment via Answer and index data
     * @param Answer $answer
     * @param Comment $forComment
     * @return Attachment
     */
    private static function createAttachment(Answer $answer, Comment $forComment = null)
    {
        $commentAttachments = $forComment ? count($forComment->getAttachments()) : 0;
        $numAttachments = $commentAttachments + count($answer->getAttachments()) + 1;
        $file = self::generateUniquePathName($answer, $numAttachments);
        return new Attachment(
            $file,
            rand(1024,65535),
            pathinfo($file, PATHINFO_EXTENSION),
            self::getRandomUser()
        );
    }

    /**
     * Construct a unique file path from given answer's title
     * @param Answer $answer
     * @param int $index
     * @return string
     */
    private static function generateUniquePathName(Answer $answer, $index)
    {
        static $extensions = ["doc", "xls", "csv", "mp3", "m4v"];
        $randomExtension = $extensions[array_rand($extensions)];
        return self::BASE_PATH
        .preg_replace("/[^A-Za-z0-9]/", "", $answer->getTitle())
        .($index + 1)
        .".$randomExtension";
    }

    /**
     * @return string
     */
    public static function getRandomUser()
    {
        static $userNames = [
            "LTorvalds",
            "TBLee",
            "SBrin",
            "RLerdorf"
        ];
        return $userNames[array_rand($userNames, 1)];
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return self::LOAD_ORDER;
    }
}