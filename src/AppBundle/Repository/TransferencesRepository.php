<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TransferencesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TransferencesRepository extends EntityRepository
{
	public function getTransferences($id)
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT u 
            FROM AppBundle:Transferences u 
            WHERE u.origin = :id
            	OR u.destination = :id
            ORDER BY u.date DESC');
        
        $query->setparameter('id', $id);
        return $query->getResult();
    }
}