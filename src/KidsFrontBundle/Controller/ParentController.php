<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();


        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));
        $allEtab = $em->getRepository('UserBundle:Etablissement')->findAll();


//
//        if ($type == "all"){
//            $allEtab = $em->getRepository('UserBundle:Etablissement')->findAll();
//
//        } else{
//            $allEtab = $em->getRepository('UserBundle:Etablissement')->findBy(array('typeEtablissement'=>$type));
//
//        }

        foreach($allEtab as $e) {

            $query = $em->createQueryBuilder();
            $query->select('avg(o.vote) AS vote');
            $query->from('UserBundle:UserEtablissementVote', 'o');
//            $query->where('o.user = :userId');
//            $query->setParameter('userId', $idUser);
            $query->where('o.etablissement = :etabId');

            $query->setParameter('etabId', $e->getId());

            $a = $query->getQuery();

            $result = $a->getResult();
            $e->setAvgRating($result[0]['vote']);
//            var_dump($result[0]['vote']).die();

            $save = $this->getDoctrine()->getManager();
            $save->persist($e);
            $save->flush();


        }
        return $this->render('@KidsFront/afficheretablissementparent.html.twig', array('etablissement' => $allEtab, 'favoris' => $allFavoris));

    }
}
