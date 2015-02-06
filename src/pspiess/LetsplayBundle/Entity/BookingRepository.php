<?php

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

/**
 * BookingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookingRepository extends EntityRepository {

    public function GetClearedByDate($dDate) {
        $arrBooking = $this->getEntityManager()
                ->createQueryBuilder('b')
                ->innerJoin('pspiessLetsplayBundle:Invoice', 'i', 'WITH', 'i.id = b.invoiceid')
                ->where('b.end = :date')
                ->setParameter('date', $dDate)
                ->getQuery();

        return $arrBooking;
    }

}
