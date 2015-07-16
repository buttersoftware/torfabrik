<?php

namespace pspiess\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BlogRepository
 *
 */
class BlogRepository extends EntityRepository {

    /**
     * @param string search for
     * 
     * @return array with Blog entities
     * 
     */
    public function GetBlogByName($sKeyword = '', $iMaincategory = null, $iSubcategory = null, $iActive = null, $iOnStart = null) {
        $query = $this->createQueryBuilder('b')
                ->orderBy('b.date', 'DESC');

        if ($sKeyword) {
            //dont need join if there is no keyword
            $query->leftJoin('pspiessBlogBundle:Maincategory', 'm', 'WITH', 'm.id = b.maincategory');
            $query->leftJoin('pspiessBlogBundle:Subcategory', 's', 'WITH', 's.id = b.subcategory');
            
            $query->where($this->createQueryBuilder('b')->expr()->like('b.blogname', ':keyword'))
                    ->setParameter('keyword', '%' . $sKeyword . '%');
            
            $query->orWhere($this->createQueryBuilder('m')->expr()->like('m.description', ':keyword'))
                    ->setParameter('keyword', '%' . $sKeyword . '%');
            $query->orWhere($this->createQueryBuilder('s')->expr()->like('s.description', ':keyword'))
                    ->setParameter('keyword', '%' . $sKeyword . '%');
        }
        if ($iSubcategory) {
            $query->andWhere('b.subcategory = :subcategory')
                    ->setParameter('subcategory', $iSubcategory);
        }
        if ($iMaincategory) {
            $query->andWhere('b.maincategory = :maincategory')
                    ->setParameter('maincategory', $iMaincategory);
        }
        if ($iActive) {
            $query->andWhere('b.active = :active')
                    ->setParameter('active', $iActive);
        }

        if ($iOnStart) {
            $query->andWhere('b.onstart = :onstart')
                    ->setParameter('onstart', $iOnStart);
        }

        return $query->getQuery()->getResult();
    }

    public function GetRandomBlogByName() {
        $query = $this->createQueryBuilder('b')
                ->addSelect('RAND() as HIDDEN rand')
                ->where('b.random = :random')
                ->andWhere('b.active = :active')
                ->setParameter('random', 1)
                ->setParameter('active', 1)
                ->addOrderBy('rand');

        return $query->getQuery()->getResult();
    }

}
