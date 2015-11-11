<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 11/11/15
 * Time: 19:21
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Attachment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAttachmentData extends AbstractFixture implements OrderedFixtureInterface
{
    const LOAD_ORDER = 10;
    const BASE_PATH = "/path/to/the/attachments/";

    public function load(ObjectManager $manager)
    {
        $fileNames = [
            "analysis.xls",
            "chart.xls",
            "currencypairs.csv",
            "help.txt",
            "clientaccount.doc",
            "clientaccount2.doc",
            "song.mp3",
            "video.m4v",
            "picture.jpg",
            "logo.png",
            "smiley.gif"
        ];
        foreach ($fileNames as $fileName)
        {
            $fullPath = $this->getFullPath($fileName);
            $fileExtension = pathinfo($fullPath, PATHINFO_EXTENSION);
            $attach = new Attachment(
                $fullPath,
                rand(1024,65535),
                $fileExtension,
                self::getRandomUser()
            );
            $manager->persist($attach);
        }
        $manager->flush();
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function getFullPath($fileName)
    {
        return self::BASE_PATH.$fileName;
    }

    /**
     * @return string
     */
    private function getRandomUser()
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