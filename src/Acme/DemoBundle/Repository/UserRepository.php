<?php

namespace Acme\DemoBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * Find users who hasn't been activated in last two hours
     * 
     * @return array
     */
    public function findNewNonActivatedUsers()
    {
        return $this->createQueryBuilder('u')
            ->where('u.activated = :activated')
            ->andWhere('u.updatedAt >= :date')
            ->getQuery()
            ->setParameters([
                'activated' => false,
                'date' => new \DateTime('-2 hour'),
            ])
            ->execute()
        ;
    }
}
