<?php

namespace KidsFrontBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MobileController extends Controller
{
    public function afficherpubjsonAction()
    {
        $clu=$this->getDoctrine()->getRepository('UserBundle:Publication')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($clu);
        return new JsonResponse($formatted);
    }

    public function affichercategoriepubjsonAction()
    {
        $clu=$this->getDoctrine()->getRepository('UserBundle:CategoriePublication')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($clu);
        return new JsonResponse($formatted);
    }

    public function affichertypepubjsonAction()
    {
        $clu=$this->getDoctrine()->getRepository('UserBundle:TypePublication')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($clu);
        return new JsonResponse($formatted);
    }

    public function creerpubjsonAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $em->flush();
        $pubjson = new Publication();
        $pubjson->setNomPublication($request->get('	nomPublication'));
        $pubjson->setDescriptionPublication($request->get('descriptionPublication'));
        $pub = $request->get('datePublication');
        $pubjson->setDatePublication(new \ DateTime($pub));

        $pubjson->imagePublication($request->get('imagePublication'));
        $pubjson->contenuPublication($request->get('contenuPublication'));


        $typepub=$em->getRepository('UserBundle:TypePublication')->find($request->get('typePublication'));
        $pubjson->setTypePublication($typepub);

        $categoriepub=$em->getRepository('UserBundle:CategoriePublication')->find($request->get('categoriePublication'));
        $pubjson->setCategoriePublication($categoriepub);

        $user=$em->getRepository('UserBundle:User')->find($request->get('idUserPublication'));
        $pubjson->setIdUserPublication($user);

        $em->persist($pubjson);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $ajoupubJson= $serializer->normalize($pubjson);
        return new JsonResponse($ajoupubJson);
    }

    public function supprimerpubjsonAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->find($id);

        $em->remove($publication);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($publication);
        return new JsonResponse($formatted);
    }
}
