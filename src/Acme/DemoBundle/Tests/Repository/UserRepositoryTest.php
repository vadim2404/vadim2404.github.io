<?php

namespace Acme\DemoBundle\Tests\Repository;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * @group db
 */
class UserRepositoryTest extends WebTestCase
{
    public function testFindNewNonActivatedUsers()
    {
        $client = static::createClient();
        
        $this->loadFixtures([
            'Acme\DemoBundle\Tests\Repository\Fixtures\LoadUserData',
        ]);
        
        $users = $client->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository('AcmeDemoBundle:User')
            ->findNewNonActivatedUsers()
        ;
        
        $this->assertCount(1, $users);
        $this->assertEquals('new non-activated', $users[0]->getName());
    }
}
