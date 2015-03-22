<?php

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CustomerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CustomerRepository extends EntityRepository
{
    
    /**
     * @param string search for
     * 
     * @return array with Customer entities
     * 
     */
    public function GetCustomerByName($sKeyword = '') {
        $query = $this->createQueryBuilder('c')
                ->where($this->createQueryBuilder('c')->expr()->like('c.vorname', ':name'))
                ->where($this->createQueryBuilder('c')->expr()->like('c.name', ':name'))
                ->setParameter('name', '%'. $sKeyword . '%')
                ->getQuery();

        return $query->getResult();
    }
}
