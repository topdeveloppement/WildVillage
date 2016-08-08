<?php

namespace UserBundle\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
	public function getAuteur()
	{

		$qb = $this->createQueryBuilder('p');

        $qb->select('p.auteur')->groupBy('p.auteur');
    
        
        return $qb->getQuery()->getResult();    
	}
}