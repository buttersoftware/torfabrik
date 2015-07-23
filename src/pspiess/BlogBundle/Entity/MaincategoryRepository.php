<?php

namespace pspiess\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MaincategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MaincategoryRepository extends EntityRepository {

    /**
     * @param string search for description
     * 
     * @return array with Maincategory entities
     * 
     */
    public function GetMaincategoryByName($sKeyword = '') {
        $query = $this->createQueryBuilder('m');
        if ($sKeyword) {
            $query->where($this->createQueryBuilder('m')->expr()->like('m.description', ':keyword'))
                    ->setParameter('keyword', '%' . $sKeyword . '%');
        }
        
        return $query->getQuery()->getResult();
    }

}