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
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user'=>$idUser));

        $allEtab = $em->getRepository('UserBundle:Etablissement')->findAll();
        return $this->render('@KidsFront/espaceparent.html.twig', array('etablissement' => $allEtab,'favoris'=>$allFavoris));

    }
}
