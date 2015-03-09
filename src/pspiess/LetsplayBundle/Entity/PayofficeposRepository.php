<?php

/*
 * This file is part of the pspiess package.
 *
 * (c) Peter Spieß <info@pspiess.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PayofficeposRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PayofficeposRepository extends EntityRepository {

    public function getPayofficepos() {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
                ->select('p', 'i')
                ->from('pspiessLetsplayBundle:Payoffice', 'p')
                ->leftJoin('p.invoice_id', 'i');
        try {
            return $query->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     * @param datetime search for
     * 
     * @return array with Payofficepos entities
     * 
     */
    public function GetPayofficeposByDate($dDate) {
        $query = $this->createQueryBuilder('p')
                ->where($this->createQueryBuilder('p')->expr()->like('p.date', ':date'))
                ->setParameter('date', $dDate->format('Y-m-d') . '%')
                ->groupBy('p.date')
                ->getQuery();

        return $query->getResult();
    }

    /**
     * 
     * @return array with Payofficepos entities
     * 
     */
    public function GetOnePayofficeposByDate() {
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addEntityResult('pspiessLetsplayBundle:Payofficepos', 'p');
        $rsm->addScalarResult('daydate', 'date');
        $rsm->addScalarResult('total', 'total');
        $data = $this->getEntityManager()
                ->createNativeQuery(
                    'SELECT DATE(p.date) as daydate, SUM(p.amount) AS total
                    FROM payofficepos p
                    GROUP BY DATE(p.date)
                    ORDER BY DATE(p.date) ASC, total ASC 
                    LIMIT 1', $rsm)
                ->getResult();
        return $data;
    }

}
