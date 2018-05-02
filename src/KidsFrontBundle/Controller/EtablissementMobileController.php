<?php

namespace KidsFrontBundle\Controller;

use FOS\MessageBundle\Model\ParticipantInterface;
use MessageBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    public function allUserReclamationsAction($idUser)
    {
        $em = $this->getDoctrine()->getManager();



        $message = $em
            // automatically knows to select Comment
            // the "c" is an alias you'll use in the rest of the query
            ->createQueryBuilder('t')
            ->select('t.subject, t.createdAt,t.id')
            ->from('MessageBundle:Thread','t')
            ->join('MessageBundle:ThreadMetadata','tm')
            ->where('t.id=tm.thread')
            ->andWhere('tm.participant= :userId')
            ->andWhere('tm.lastMessageDate  is not null')
            ->orderBy('tm.lastMessageDate ', 'DESC')
            ->setParameter('userId', $idUser)
            ->getQuery()
            ->getResult();



        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->normalize($message, 'json');
        return new JsonResponse($jsonContent);

    }

    public function allMessageByThreadAction($idThread)
    {
        $messages = $this->getDoctrine()->getManager()
            ->getRepository('MessageBundle:Message')
            ->findBy(array('thread'=>$idThread));
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->normalize($messages, 'json');

        return new JsonResponse($jsonContent);

    }

    public function sendNewMessageAction(Request $request){

        $idThread = $request->get('thread');
        $idUser = $request->get('sender');
        $body = $request->get('body');


        $thread = $this->getDoctrine()->getManager()
            ->getRepository('MessageBundle:Thread')
            ->find($idThread);

        $user = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:User')
            ->find($idUser);

        $message= new Message();

        $message->setBody($body);
        $message->setSender($user);
        $message->setThread($thread);


        $save = $this->getDoctrine()->getManager();

        $save->persist($message);
        $save->flush();


        return new \Symfony\Component\HttpFoundation\Response("Message ajouté avec succés");
    }


}
