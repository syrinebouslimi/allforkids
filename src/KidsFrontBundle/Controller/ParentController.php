<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ParentController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function espaceParentAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));

        return $this->render('@KidsFront/espaceparent.html.twig', array('favoris' => $allFavoris));

    }

    public function afficherEtabParentAction()
    {
//        $user = $this->container->get('security.token_storage')->getToken()->getUser();
//        $idUser = $user->getId();
//
//
//        $em = $this->getDoctrine()->getManager();
//
//
//
//
//        $query = $em->createQueryBuilder();
//        $query->select('avg(o.vote) AS vote');
//        $query->from('UserBundle:UserEtablissementVote', 'o');
//        $query->where('o.user = :userId');
//$query->setParameter('userId', $idUser);
//
//        $a = $query->getQuery();
//
//        $result = $a->getResult();
//
//        var_dump($result).die();


        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();


        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));

        $allEtab = $em->getRepository('UserBundle:Etablissement')->findAll();


//        foreach ($allEtab as $etab) {
//            $query = $em->createQuery(
//                'SELECT AVG(vote),user_id,etablissement_id
//    FROM UserBundle:UserEtablissementVote
//    WHERE user=: idUser AND etablissement=: idEtab'
//            )->setParameter('user', $idUser)
//            ->setParameter('idEtab',$etab->getId());
//
//            $avg = $query->getResult();
//            $etab->setAvgRating($avg);


            $query = $em->createQueryBuilder();
            $query->select('avg(o.vote) AS vote');
            $query->from('UserBundle:UserEtablissementVote', 'o');
            $query->where('o.user = :userId');
            $query->setParameter('userId', $idUser);
            $query->andWhere('o.etablissement = :etabId');

            $query->setParameter('etabId', 37);

                    $a = $query->getQuery();

        $result = $a->getResult();

        var_dump($result).die();



   //     }




        return $this->render('@KidsFront/afficheretablissementparent.html.twig', array('etablissement' => $allEtab, 'favoris' => $allFavoris));

    }
}
