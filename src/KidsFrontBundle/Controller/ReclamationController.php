<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReclamationController extends Controller
{
    public function getAllMessagesAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();


        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));



    }
}
