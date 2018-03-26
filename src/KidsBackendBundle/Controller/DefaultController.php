<?php

namespace KidsBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KidsBackendBundle::Template_Admin.html.twig');
    }
}
