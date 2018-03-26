<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    public function parentAction()
    {
        return $this->render('UserBundle::parent.html.twig');
    }

    public function prestataireAction()
    {
        return $this->render('UserBundle::prestataire.html.twig');
    }



}
