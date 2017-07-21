<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUsers extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function getOrder()
    {
        return 10;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.password_encoder');

        // 'John Smith' is the admin user allowed to access the EasyAdmin Demo
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('branko.janjic@fsd.rs');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setFirstName('admin');
        $user->setLastName('admin');
        $user->setCountry('Serbia');
        $user->setCity('Belgrade');
        $user->setStreet('Bulevar');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setPhoneNumbers(array('062356866'));
        $user->setEnabled(true);
        $user->setPassword($encoder->encodePassword($user, '1234'));
        $manager->persist($user);
        $manager->flush();
    }
}
