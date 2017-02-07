<?php

namespace AppBundle\Repository;

/**
 * QuestionsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionsRepository extends \Doctrine\ORM\EntityRepository
{
    
    
    public function findAPerson($personToCheck) {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
                'SELECT u FROM Workshop5Bundle:Person u'
                . ' WHERE u.name = :personToCheck OR u.surname = :personToCheck'
                )->setParameter('personToCheck', $personToCheck);
        $person = $query->getResult();
        return $person;
    }
}