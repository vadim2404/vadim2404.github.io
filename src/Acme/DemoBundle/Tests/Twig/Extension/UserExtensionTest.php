<?php

namespace Acme\DemoBundle\Tests\Twig\Extension;

use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Twig\Extension\UserExtension;

class UserExtensionTest extends \PHPUnit_Framework_TestCase
{
    protected $dispatcher;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
    }
    
    public function testGetName()
    {
        $this->dispatcher->expects($this->never())
            ->method('dispatch')
        ;
        
        $extension = new UserExtension($this->dispatcher);
        $this->assertStringEndsWith('userextension', $extension->getName());
    }
    
    public function testGetFunctions()
    {
        $this->dispatcher->expects($this->never())
            ->method('dispatch')
        ;
        
        $extension = new UserExtension($this->dispatcher);
        $functions = $extension->getFunctions();
        
        $this->assertNotEmpty($functions);
        foreach ($functions as $function) {
            $this->assertInstanceOf('\Twig_SimpleFunction', $function);
            $this->assertStringStartsWith('user', $function->getName());
        }
    }
    
    public function testNotify()
    {
        $user = (new User())->setName(rand());
        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo('greet.user'), $this->callback(function ($event) use ($user) {
                $this->assertInstanceOf('Acme\DemoBundle\Events\UserEvent', $event);
                $this->assertEquals($user, $event->getUser());
                return true;
            }))
        ;
        $extension = new UserExtension($this->dispatcher);
        $extension->notify($user);
    }
}
