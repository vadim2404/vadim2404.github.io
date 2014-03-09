<?php

namespace Acme\DemoBundle\Tests\EventListener;

use Acme\DemoBundle\EventListener\UserNotifierListener;
use Acme\DemoBundle\Events\UserEvent;

class UserNotifierListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSubscribedEvents()
    {
        $this->assertArrayHasKey('greet.user', UserNotifierListener::getSubscribedEvents());
    }
    
    public function testOnGreetUser()
    {
        $user = $this->getMockBuilder('Acme\DemoBundle\Entity\User')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $user->expects($this->once())
            ->method('getName')
            ->will($this->returnValue($name = (string) rand ()))
        ;
        
        $user->expects($this->once())
            ->method('getEmail')
            ->will($this->returnValue($email = 'test@example.com'))
        ;
        
        $mailer = $this->getMockBuilder('\Swift_Mailer')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        
        $mailer->expects($this->once())
            ->method('send')
            ->with($this->callback(function ($message) use($name, $email) {
                $this->assertInstanceOf('\Swift_Message', $message);
                $this->assertArrayHasKey($email, $message->getTo());
                $this->assertStringEndsWith($name, $message->getBody());
                return true;
            }))
        ;
            
        (new UserNotifierListener($mailer))->onGreetUser(new UserEvent($user));
    }
}
