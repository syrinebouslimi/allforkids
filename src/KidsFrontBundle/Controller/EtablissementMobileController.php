<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\UserEtablissementFavoris;


class EtablissementMobileController extends Controller
{


    public function allEtabAction()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Etablissement')
            ->findAll();
        $normalizer = new ObjectNormalizer();
//        $normalizer->setIgnoredAttributes(array('adresseUser'));
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $em = $this->getDoctrine()->getManager();
        $jsonContent = $serializer->normalize($etab, 'json', array('attributes' => array('id', 'nomEtablissement', 'imageEtablissement'
        , 'adresseEtablissement', 'typeEtablissement','descriptionEtablissement','avgRating','phone'
            => ['name'])));
        return new JsonResponse($jsonContent);

    }


    public function allUsersAction()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $users = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:User')
            ->findAll();
        $normalizer = new ObjectNormalizer();
//        $normalizer->setIgnoredAttributes(array('adresseUser'));
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $em = $this->getDoctrine()->getManager();
        $jsonContent = $serializer->normalize($users, 'json', array('attributes' => array('id', 'email', 'nomUser'
        , 'prenomUser', 'roles', 'password'
            => ['name'])));
        return new JsonResponse($jsonContent);

    }


    public function allUserFavorisAction($idUser)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $users = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:UserEtablissementFavoris')
            ->findBy(array('user'=>$idUser));
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array('dateCreation','user'));
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $em = $this->getDoctrine()->getManager();
        $jsonContent = $serializer->normalize($users, 'json');
        return new JsonResponse($jsonContent);

    }






    public function updateEtabAction(Request $request)
    {


        $idEtab = $request->get('idEtab');
        $newNomEtab = $request->get('nomEtablissement');


        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Etablissement')
            ->find($idEtab);

        $etab->setNomEtablissement($newNomEtab);

        $em = $this->getDoctrine()->getManager();
        $em->flush();


        return new \Symfony\Component\HttpFoundation\Response("success update");
    }

    public function addFavorisAction(Request $request)
    {


        $idEtab = $request->get('idEtab');
        $idUser = $request->get('idUser');


        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Etablissement')
            ->find($idEtab);

        $user = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:User')
            ->find($idUser);

        $favoris = new UserEtablissementFavoris();
        $favoris->setDateCreation(new \DateTime());
        $favoris->setEtablissement($etab);
        $favoris->setUser($user);


        $save = $this->getDoctrine()->getManager();

        $save->persist($favoris);
        $save->flush();


        return new \Symfony\Component\HttpFoundation\Response("Favoris ajouté avec succés");
    }

    public function supprimerFavorisAction($idFavoris)
    {


        $em=$this->getDoctrine()->getManager();
        $etablissement = $this->getDoctrine()->getRepository('UserBundle:UserEtablissementFavoris')->find($idFavoris);
        $em->remove($etablissement);

        $em->flush();


        return new \Symfony\Component\HttpFoundation\Response("Suppression effectué avec succés");
    }


}
