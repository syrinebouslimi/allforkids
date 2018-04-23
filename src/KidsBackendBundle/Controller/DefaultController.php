<?php

namespace KidsBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function adminAction(Request $request)
    {
        return $this->render('KidsBackendBundle::Template_Admin.html.twig');
    }

    public function testAction()
    {
        return $this->render('KidsBackendBundle::test.html.twig');
    }



}
