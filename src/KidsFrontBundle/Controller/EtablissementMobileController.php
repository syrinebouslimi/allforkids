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
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $em = $this->getDoctrine()->getManager();
        $jsonContent = $serializer->normalize($etab, 'json', array('attributes' => array('id', 'nomEtablissement', 'imageEtablissement'
        , 'adresseEtablissement', 'typeEtablissement', 'descriptionEtablissement', 'avgRating', 'phone'
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
            ->findBy(array('user' => $idUser));
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array('dateCreation', 'user'));
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


    public function allEtablissementWithRatingAction()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());

        $em = $this->getDoctrine()->getManager();


        $etab = $em
            // automatically knows to select Comment
            // the "c" is an alias you'll use in the rest of the query
            ->createQueryBuilder('o')
            ->select('distinct (o.etablissement), (avg(o.vote)) AS avgRating, (e.nomEtablissement) as nomEtablissement')
            ->from('UserBundle:UserEtablissementVote', 'o')
            ->join('UserBundle:Etablissement', 'e')
            ->where('o.etablissement=e.id')
            ->groupBy('o.etablissement')
            ->getQuery()
            ->getResult();


        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->normalize($etab, 'json');
        return new JsonResponse($jsonContent);

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


        $em = $this->getDoctrine()->getManager();
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
            ->from('MessageBundle:Thread', 't')
            ->join('MessageBundle:ThreadMetadata', 'tm')
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
            ->findBy(array('thread' => $idThread));
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

    public function sendNewMessageAction(Request $request)
    {

        $idThread = $request->get('thread');
        $idUser = $request->get('sender');
        $body = $request->get('body');


        $thread = $this->getDoctrine()->getManager()
            ->getRepository('MessageBundle:Thread')
            ->find($idThread);

        $user = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:User')
            ->find($idUser);

        $message = new Message();

        $message->setBody($body);
        $message->setSender($user);
        $message->setThread($thread);



        $save = $this->getDoctrine()->getManager();

        $save->persist($message);
        $save->flush();


        return new \Symfony\Component\HttpFoundation\Response("Message ajouté avec succés");
    }


    public function allNotificationsAction()
    {
        $notifs = $this->getDoctrine()->getManager()
            ->getRepository('MgiletNotificationBundle:Notification')
            ->findAll();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array('date','link'));

        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->normalize($notifs, 'json');

        return new JsonResponse($jsonContent);

    }

    public function supprimerNotifByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $notif = $em
            ->getRepository('MgiletNotificationBundle:Notification')
            ->find($id);

        $em->remove($notif);

        $em->flush();

        return new \Symfony\Component\HttpFoundation\Response("Suppression effectué avec succés");

    }


    public function getEtabForPrestataireAction(Request $request)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $idUser = $request->get('user');
        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Etablissement')
            ->findBy(array('idUserEtablissement'=>$idUser));

        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array('avgRating','userNote','idUserEtablissement','dateCreationEtablissement','userFavorites'));
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->normalize($etab, 'json');
        return new JsonResponse($jsonContent);

    }

    public function getEnseiForPrestataireAction(Request $request)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $idEtab = $request->get('etablissement');

        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Enseignant')
            ->findBy(array('etablissementId'=>$idEtab));

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->normalize($etab, 'json');
        return new JsonResponse($jsonContent);

    }

    public function getGallerieForPrestataireAction(Request $request)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $idEtab = $request->get('etablissement');

        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Gallerie')
            ->findBy(array('etablissementId'=>$idEtab));

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->normalize($etab, 'json');
        return new JsonResponse($jsonContent);

    }

    public function updateEtabAction(Request $request)
    {


        $idEtab = $request->get('id');
        $newNomEtab = $request->get('nom');
        $horaire = $request->get('horaire');
        $description = $request->get('description');
        $exigence = $request->get('exigence');
        $phone = $request->get('phone');
        $adresse = $request->get('adresse');
        $country = $request->get('country');
        $region = $request->get('region');
        $codepostal = $request->get('codepostal');




        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Etablissement')
            ->find($idEtab);

        $etab->setNomEtablissement($newNomEtab);
        $etab->setHoraireEtablissement($horaire);
        $etab->setDescriptionEtablissement($description);
        $etab->setExigenceEtablissement($exigence);
        $etab->setPhone($phone);
        $etab->setAdresseEtablissement($adresse);
        $etab->setCountryEtablissement($country);
        $etab->setRegionEtablissement($region);
        $etab->setCodepostalEtablissement($codepostal);

        $em = $this->getDoctrine()->getManager();
        $em->flush();


        return new \Symfony\Component\HttpFoundation\Response("etablissement modifié avec succés");
    }

    public function updateEnseigAction(Request $request)
    {


        $idEns = $request->get('id');
        $aboutEns = $request->get('about');
        $designation= $request->get('designation');
        $diplome = $request->get('diplome');
        $experience = $request->get('experience');
        $cours = $request->get('cours');
        $email = $request->get('email');
        $phone = $request->get('phone');


        $etab = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:Enseignant')
            ->find($idEns);

        $etab->setAboutEnseignant($aboutEns);
        $etab->setDesignationEnseignant($designation);
        $etab->setDiplomeEnseignant($diplome);
        $etab->setExperienceEnseignant($experience);
        $etab->setPhone($phone);
        $etab->setCoursEnseignant($cours);
        $etab->setEmailEnseignant($email);


        $em = $this->getDoctrine()->getManager();
        $em->flush();


        return new \Symfony\Component\HttpFoundation\Response("enseignant modifié avec succés");
    }




    public function supprimerEnseignantAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $ensei = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->find($id);
        $em->remove($ensei);

        $em->flush();


        return new \Symfony\Component\HttpFoundation\Response("Suppression effectué avec succés");
    }

    public function supprimerImageAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $image = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->find($id);
        $em->remove($image);

        $em->flush();


        return new \Symfony\Component\HttpFoundation\Response("Suppression effectué avec succés");
    }




}
