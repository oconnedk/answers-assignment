<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 12/11/15
 * Time: 15:14
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    const LOAD_ORDER = 0;
    const SUPER_USER_REF = 'SUPER_USER';

    /** @var ContainerInterface */
    private $container;
    /** @var ObjectManager */
    private static $objectManager;

    public function load(ObjectManager $manager)
    {
        self::$objectManager = $manager;
        $userNames = [
            "SuperUser" => true,
            "LTorvalds" => false,
            "TBLee" => false,
            "SBrin" => false,
            "RLerdorf" => false
        ];
        foreach ($userNames as $userName => $superUser)
        {
            $user = new User();
            $user->setUsername($userName);
            $user->setEmail(preg_replace("/[^A-Za-z0-9]/", "", $userName)."@work.com");
            $user->setEnabled(true);
            $user->setSuperAdmin($superUser);
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, 'secret_password'); // FIXME: just sample data for a test database
            $user->setPassword($password);
            $manager->persist($user);
            if ($superUser) {
                $this->addReference(self::SUPER_USER_REF, $user);
            }
        }
        $manager->flush();
    }

    /**
     * Allow for injection of container because we're ContainerAware
     *
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return User
     */
    public static function getRandomUser()
    {
        static $users = [];
        if (!$users)
        {
            $users = self::$objectManager->getRepository("AppBundle:User")->findAll();
        }
        return $users[array_rand($users, 1)];
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