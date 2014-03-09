<?php

namespace Acme\DemoBundle\Tests\Entity;

use Acme\DemoBundle\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testHideNameWithSmallName()
    {
        $user = (new User())->setName('a');
        
        $this->assertEquals(str_repeat('*', User::STARS), $user->hideName());
    }
    
    public function testHideWithLargeName()
    {
        $user = (new User())->setName('aaaaaaaa');
        
        $this->assertEquals('aaa' . str_repeat('*', User::STARS), $user->hideName());
    }
}
