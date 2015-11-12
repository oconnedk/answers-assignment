<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 12/11/15
 * Time: 09:40
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AnswerSearchStat;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAnswerSearchStatData extends AbstractFixture implements OrderedFixtureInterface
{
    const LOAD_ORDER = 20;

    public function load(ObjectManager $manager)
    {
        foreach ($manager->getRepository("AppBundle:Answer")->findAll() as $answer)
        {
            $createNumberOfStats = rand(1,20);
            for ($i = 0; $i < $createNumberOfStats; ++$i)
            {
                $stat = new AnswerSearchStat($answer);
                $manager->persist($stat);
            }
        }
       $manager->flush();
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