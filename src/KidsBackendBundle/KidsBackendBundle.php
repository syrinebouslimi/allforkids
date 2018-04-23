<?php

namespace KidsBackendBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use UserBundle\Entity\Service;
use UserBundle\Form\ServiceType;

class KidsBackendBundle extends Bundle
{
    public function testAction()
    {
        return $this->render('KidsBackendBundle::test.html.twig');
    }

}
