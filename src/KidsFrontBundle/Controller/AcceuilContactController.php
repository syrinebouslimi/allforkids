<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AcceuilContactController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function acceuilAction()
    {
        return $this->render('::acceuil.html.twig');

    }


    public function contactAction()
    {
        return $this->render('@KidsFront/contact.html.twig');

    }
}
