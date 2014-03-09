<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Repository\UserRepository")
 */
class User
{
    const MAX_VISIBILITY_LENGTH = 3;
    const STARS = 5;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activated", type="boolean")
     */
    private $activated = false;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set email
     *
     * @param string|null $name
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set activated
     *
     * @param boolean $activated
     * @return User
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * Get activated
     *
     * @return boolean 
     */
    public function getActivated()
    {
        return $this->activated;
    }
    
    /**
     * Get updatedAt
     * 
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * Set updatedAt
     * 
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }
    
    /**
     * Hide name
     * 
     * @return string
     */
    public function hideName()
    {
        return (
            self::MAX_VISIBILITY_LENGTH < strlen($this->name) ? 
                substr($this->name, 0, self::MAX_VISIBILITY_LENGTH) : 
                ''
            ) . str_repeat('*', self::STARS);
    }
}
