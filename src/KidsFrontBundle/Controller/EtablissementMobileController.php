<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EtablissementMobileController extends Controller
{
    public function allEtablissementAction()
    {
        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Etablissement')
            ->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($etab);
        return new JsonResponse($formatted);



    }
}
