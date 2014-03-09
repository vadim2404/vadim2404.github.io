<?php

namespace Acme\DemoBundle\EventListener;

use Acme\DemoBundle\Events\UserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserNotifierListener implements EventSubscriberInterface
{
    /**
     * Mailer
     *
     * @var \Swift_Mailer $mailer
     */
    private $mailer;
    
    /**
     * Constructor
     * 
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'greet.user' => ['onGreetUser', 0],
        ];
    }
    
    /**
     * Send email to user
     * 
     * @param \Acme\DemoBundle\Events\UserEvent $event
     */
    public function onGreetUser(UserEvent $event)
    {
        $user = $event->getUser();
        
        $message = \Swift_Message::newInstance()
            ->setSubject('Test')
            ->setFrom('no-reply@example.com')
            ->setTo($user->getEmail())
            ->setBody('Hello ' . $user->getName())
        ;
        
        $this->mailer->send($message);
    }
}
