<?php

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BookingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookingRepository extends EntityRepository {

    public function GetClearedByDate($dDate) {
        return $this->getEntityManager()
                        ->createQueryBuilder('b')
                        ->innerJoin('pspiessLetsplayBundle:Invoice', 'i', 'WITH', 'i.id = b.invoiceid')
                        ->where('b.end = :date')
                        ->setParameter('date', $dDate)
                        ->getQuery();
    }

    public function GetBookingByFieldId($iFieldid) {
        $query = $this->getEntityManager()
                ->createQueryBuilder('b')
                ->where('b.fieldid = :fieldid')
                ->setParameter('fieldid', $iFieldid)
                ->getQuery();
        return $query->getResult();
    }

}
