<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 13/11/15
 * Time: 10:57
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\UserToken;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserTokenData extends AbstractFixture implements OrderedFixtureInterface
{
    const LOAD_ORDER = 5;

    public function load(ObjectManager $manager)
    {
        $superUser = $this->getReference(LoadUserData::SUPER_USER_REF);
        foreach ($manager->getRepository("AppBundle:User")->findAll() as $user)
        {
            $token = new UserToken($user, $superUser);
            $manager->persist($token);
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