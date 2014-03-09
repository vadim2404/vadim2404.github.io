<?php

namespace Acme\DemoBundle\Twig\Extension;

use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Events\UserEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UserExtension extends \Twig_Extension
{
    /**
     * Event Dispatcher
     *
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    protected $dispatcher;
    
    /**
     * Constructor
     * 
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'acme_demo_twig_extension_userextension';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('user_notifier', [$this, 'notify']),
        ];
    }

    /**
     * Notify user
     */
    public function notify(User $user)
    {
        $this->dispatcher->dispatch('greet.user', new UserEvent($user));
    }
}
