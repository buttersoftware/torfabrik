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
    
    public function GetBooking($iFieldId, $dDate) {
        
        $query = $this->createQueryBuilder('b')
            ->where('b.field = :fieldid')
            ->andWhere($this->createQueryBuilder('b')->expr()->like('b.start', ':date'))
            ->setParameter('fieldid', $iFieldId)
            ->setParameter('date', $dDate . '%')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param $iFieldId
     * @param $iCustomer
     * @param $dStart
     * @param $dEnd
     * @return array
     */
    public function getBookingSerial($iFieldId, $iCustomer, \DateTime $dStart, \DateTime $dEnd) {
        //
        $dayofweek = date('w', strtotime($dStart->format('d-m-Y')));

        $query = $this->createQueryBuilder('b')
            ->where('b.field = :fieldid')
            ->andWhere('b.customer = :customerid')
            ->andWhere('b.start >= :startdate')
            ->andWhere('DAYOFWEEK(b.start) = ' . ($dayofweek + 1))
            ->andWhere($this->createQueryBuilder('b')->expr()->like('b.start', ':start'))
            ->andWhere($this->createQueryBuilder('b')->expr()->like('b.end', ':end'))
            ->setParameter('fieldid', $iFieldId)
            ->setParameter('customerid', $iCustomer)
            ->setParameter('startdate', $dStart)
            ->setParameter('start', '____-__-__ '.$dStart->format('H:i').':__')
            ->setParameter('end', '____-__-__ '.$dEnd->format('H:i').':__')
            ->getQuery();

        return $query->getResult();
    }

}
