<?php

namespace KidsFrontBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\Reclamation;
use UserBundle\Entity\RendezVous;
use UserBundle\Entity\Service;
use Symfony\Component\HttpFoundation\Response;




class ServicesController extends Controller
{

    public function servicesAction(Request $request)
    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->findAll();
        //$dql="SELECT id FROM UserBundle:Service id";
        /* $query=$Uv->createQuery($dql);

         if ($request->query->getAlnum('filter')) {
             $query
                 ->where('id.nomService LIKE :nomService')
                 ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
         }*/



        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator  = $this->get('knp_paginator');
        $result=$paginator->paginate(
        // $query,
            $Uv,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit',6)
        );





        return $this->render ( '@KidsFront/services.html.twig',array('serv'=>$result));


    }


    public function rechercheAction(Request $request)
    {

        $search = $request->query->get('search');
        $servi= $this->getDoctrine()->getRepository('UserBundle:Service')->findBy(array('nomService'=>$search));


        $paginator  = $this->get('knp_paginator');
        $result=$paginator->paginate(
        // $query,
            $servi,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit',6)
        );

        if (strlen($search)!=0){

            return $this->render('@KidsFront/services.html.twig',array('serv'=>$result));

        } else {
            return  $this->redirectToRoute('KidsFrontBundle:Services:services');
        }
    }



//Affichage

    public function afficherServiceFrontAction ()

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->findAll();
        return $this->render ( '@KidsFront/afficherServiceFront.html.twig',array('serv'=>$Uv));

    }

    public function afficheServFrontAction ()

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->findAll();
        return $this->render ( '@KidsFront/afficheServ.html.twig',array('serv'=>$Uv));

    }

    public function detailServiceFrontAction ($id)

    {


        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->find($id);
        return $this->render( '@KidsFront/detail2sevice.html.twig',array('serv'=>$Uv));

    }


    //ajout RendezVous

    public function ajoutrendezvousAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $status = 'erreur';
        $html = 'erreur';



        if ($request->isMethod('POST'))
        {

            if($request->isXmlHttpRequest()) {

                //extraire les données de modal
                $patient = $request->request->get('nomprenom');
                $dateRendezvous = $request->request->get('daterendezvous');
                $horaire = $request->request->get('horaire');
                $serv = $request->request->get('service');
                //nouveau rendezvous
                $service=$em->getRepository('UserBundle:Service')->find($serv);

                $rd = new RendezVous();
                $user=$this->getUser();
                $rd->setIdUserRendezVous($user);
                $rd->setIdServiceRendezVous($service);
                $rd->setLieuRendezVous($service->getAdresseService());
                $rd->setNomPrenom($patient);

                $date = new \DateTime($dateRendezvous." ".$horaire);

                //$date = new \DateTime($date);
                $date->format('Y-m-d H:i');
                $rd->setDateRendezVous($date);

                $em->persist($rd);


                if($rd!=null){

                    $status = 'success';
                    $html = $rd;
                }

            }
        }

        $em->flush();

        $jsonArray = array(
            'status' => $status,
            'data' => $html,
        );

        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;


    }

    //Gerer Rendez vous
    public function gereRendezvousAction ()

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:RendezVous')->findAll();
        return $this->render ( '@KidsFront/gereRendezvous.html.twig',array('serv'=>$Uv));

    }



    //Other ways of including comments in a page
    public function includeAction(Request $request)
    {
        $id = 'thread_id';
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());

            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);

        return $this->render('@KidsFront/detail2sevice.html.twig', array(
            'comments' => $comments,
            'thread' => $thread,
        ));
    }


    //Affichage mobile

    public function afficherServicejsonFrontAction ()

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($Uv);
        return new JsonResponse($formatted);
    }
    //Ajout mobile
    public function ajoutServicejsonAction (Request $request)

    {
        $em=$this->getDoctrine()->getManager();
        $services=new Service();
        $services->setNomService($request->get('nomService'));
        $services->setDescriptionService($request->get('descriptionService'));
        $services->setAdresseService($request->get('adresseService'));
        $services->setContact($request->get('contact'));
        $services->setImagServ($request->get('imagServ'));
        $type = $request->get('idTypeService');
        $idUser =  $request->get('idUserService');

        $typeser= $this->getDoctrine()->getRepository('UserBundle:TypeService')->find($type) ;
        $user= $this->getDoctrine()->getRepository('UserBundle:User')->find($idUser);


        $services->setIdTypeService($typeser);
        $services->setIdUserService($user);

        $em->persist($services);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($services);
        return new JsonResponse($formatted);
    }

    //supprimer service mobile



    public function supprimerservJsonAction($idserv)
    {
        $em = $this->getDoctrine()->getManager();
        $service = $this->getDoctrine()->getRepository('UserBundle:Service')->find($idserv);
        $em->remove($service);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($service);
        return new JsonResponse($formatted);

        // return new \Symfony\Component\HttpFoundation\Response("Suppression effectué avec succés");
    }






    //ajout Reclamation

    public function ajoutREclamationAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $status = 'erreur';
        $html = 'erreur';

        if ($request->isMethod('POST'))
        {

            if($request->isXmlHttpRequest()) {

                //extraire les données

                $reclam = $request->request->get('reclameur');
                $mailemeteur = $request->request->get('mail');
                $contenureclam = $request->request->get('textreclam');
                //$serv = $request->request->get('service');

                //ajouter reclamation

                $reclamation = new Reclamation();
                $user=$this->getUser();
                $reclamation->setIdUserReclamation($user);
                $reclamation->setNomReclameur($reclam);
                $reclamation->setEmetteurReclamation($mailemeteur);
                $reclamation->setContenuReclamation($contenureclam);

                $em->persist($reclamation);


                if($reclamation!=null){

                    $status = 'success';
                    $html = 'yes';
                }

            }
        }

        $em->flush();

        $jsonArray = array(
            'status' => $status,
            'data' => $html,
        );

        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;

    }


    public function updateJsonAction (Request $request, $idserv)
    {
        $serv = $this->getDoctrine()->getManager()->getRepository('UserBundle:Service')->find($idserv);
        $id = $request->get('id');
        $nom = $request->get('nomService');
        $desc = $request->get('descriptionService');
        $adresse = $request->get('adresseService');
        $contact = $request->get('contact');
        $img = $request->get('imagServ');
        $type =$request->get('idTypeService');
        $iduser = $request->get('idUserService');


        $serv->setNomService($nom);
        $serv->setDescriptionService($desc);
        $serv->setAdresseService($adresse);
        $serv->setContact($contact);
        $serv->setImagServ($img);
        $serv->setIdTypeService($type);
        $serv->setIdUserService($iduser);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($serv);
        return new JsonResponse($formatted);

        //return new \Symfony\Component\HttpFoundation\Response("service modifié avec succés");
    }

}
