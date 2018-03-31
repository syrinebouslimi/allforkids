<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EtablissementController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('UserBundle:User')->findAll();
        return $this->render('KidsFrontBundle::Template_User.html.twig',array('u'=>$users));

    }

    public function contactAction()
    {
        return $this->render('@KidsFront/contact.html.twig');

    }

    public function etablissementsAction()
    {
        return $this->render('@KidsFront/etablissements.html.twig');

    }

    public function acceuilAction()
    {
        return $this->render('::acceuil.html.twig');

    }
}
