<?php

namespace Acme\DemoBundle\Events;

use Acme\DemoBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event
{
    /**
     * User object
     * 
     * @var \Acme\DemoBundle\Entity\User 
     */
    private $user;
    
    /**
     * Constructor
     * 
     * @param \Acme\DemoBundle\Entity\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Get user
     * 
     * @return \Acme\DemoBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
