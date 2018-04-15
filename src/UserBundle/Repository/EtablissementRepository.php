<?php

namespace UserBundle\Repository;

/**
 * EtablissementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EtablissementRepository extends \Doctrine\ORM\EntityRepository
{

    public function createEtabByUserIdQueryBuilder($user)
    {

        //$id = $this->getUser();
        return $this->createQueryBuilder('etablissement')
            ->where('etablissement.idUserEtablissement = :idUser')
            ->setParameter('idUser', $user);
    }
}
