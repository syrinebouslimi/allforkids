<?php

namespace KidsBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Publication;
use UserBundle\Form\PublicationType;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function adminAction()
    {
        return $this->render('KidsBackendBundle::Template_Admin.html.twig');
    }
}
