<?php

namespace Acme\DemoBundle\Tests\Repository\Fixtures;

use Acme\DemoBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;


class LoadUserData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $manager->persist((new User())
            ->setName('old non-activated')
            ->setUpdatedAt(new \DateTime('-1 day'))
        );
        
        $manager->persist((new User())
            ->setName('new non-activated')
            ->setUpdatedAt(new \DateTime('now'))
        );
        
        $manager->persist((new User())
            ->setName('old activated')
            ->setActivated(true)
            ->setUpdatedAt(new \DateTime('-1 day'))
        );
        
        $manager->persist((new User())
            ->setName('new activated')
            ->setActivated(true)
            ->setUpdatedAt(new \DateTime('now'))
        );
        
        $manager->flush();
    }

}
