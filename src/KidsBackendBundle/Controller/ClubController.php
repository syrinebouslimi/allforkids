<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 02/04/2018
 * Time: 11:19
 */

namespace KidsBackendBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use UserBundle\Entity\Club;
use UserBundle\Entity\EventCustom;
use UserBundle\Form\ClubType;
use UserBundle\Form\EventCustomType;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;


use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClubController extends Controller
{

    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('UserBundle:User')->findAll();
        return $this->render('KidsBackendBundle::Template_Admin.html.twig',array('u'=>$users));

    }

    public function listeclubAction()
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        return $this->render('@KidsBackend/listeclub.html.twig',array(
            'notifiableNotifications' => $allNotif
        ));

    }

    public function calendrierClubAction()
    {

        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $em=$this->getDoctrine()->getManager();
        $evnt=$em->getRepository('UserBundle:EventCustom')->findAll();
        $evntserv=$em->getRepository('UserBundle:Service')->findAll();
        $publica=$em->getRepository('UserBundle:Publication')->findAll();

        return $this->render('KidsBackendBundle::calendar.html.twig',array('events'=>$evnt,'service'=>$evntserv,'publication'=>$publica,
            'notifiableNotifications' => $allNotif
            ));
    }

    public function ajouterClubAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $Cl = new Club();
        $form=$this->createForm(ClubType::class,$Cl);
        $formView=$form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())

        {

            $em=$this->getDoctrine()->getManager();

            $adresse = new GeocoderAddressRequest($Cl->getAdresse());

            $reponse = $this->container->get('ivory.google_map.geocoder')->geocode($adresse);
            if(count($reponse->getResults()) < 1)
            {
                $reponse = $this->container->get('ivory.google_map.geocoder')->geocode($adresse);

            }

            foreach ($reponse->getResults() as $result) {
                $placeId = $result->getPlaceId();
                $geometry = $result->getGeometry();

            }

            $lat=$geometry->getBound()->getSouthWest()->getLatitude();
            $langi=$geometry->getBound()->getSouthWest()->getLongitude();
            $Cl->setLat($lat);
            $Cl->setLongi($langi);
            $Cl->setAdresse($Cl->getAdresse());
            //  var_dump($lat);
            //  var_dump($lang);

            $em->persist($Cl);


            // $file stores the uploaded PDF file

            $file = $Cl->getImageClub();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $Cl->setImageClub($fileName);


            $em->flush();

            return $this->redirect($this->generateUrl('afficherClub'));
        }


        return $this->render ( '@KidsBackend/ajouterclub.html.twig',array('form'=>$formView,'notifiableNotifications' => $allNotif));


    }

    public function afficherClubAction ()

    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $clu=$this->getDoctrine()->getRepository('UserBundle:Club')->findAll();
        return $this->render ( '@KidsBackend/afficherClub.html.twig',array('form'=>$clu,'notifiableNotifications' => $allNotif));

    }
    public function afficherClubJsonAction ()

    {
        $clu=$this->getDoctrine()->getRepository('UserBundle:Club')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($clu);
        return new JsonResponse($formatted);

    }

    public function ajouterClubJsonAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $em->flush();
        $cljson = new Club();
        $cljson->setNomClub($request->get('nomClub'));

        $cljson->setDescriptionClub($request->get('descriptionClub'));
        $clb = $request->get('dateCreationClub');

        $cljson->setDateCreationClub(new \ DateTime($clb));
        //   $cljson->setDateCreationClub($request->get('dateCreationClub'));
        // $cljson->setDateCreationClub(new \DateTime());
        $cljson->setAdresse($request->get('adresse'));
        $cljson->setImageClub($request->get('imageClub'));
        $cljson->setLongi($request->get('longi'));
        $cljson->setLat($request->get('lat'));
        $etablisement=$em->getRepository('UserBundle:Etablissement')->find($request->get('idEtablissement'));
        $cljson->setIdEtablissement($etablisement);


        $em->persist($cljson);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $ajouclubJson= $serializer->normalize($cljson);
        return new JsonResponse($ajouclubJson);


        /* $em = $this->getDoctrine()->getManager();
         $an = new Club();
         $an->setNomClub($request->get('nomClub'));
         $an->setDescriptionClub($request->get('descriptionClub'));
         $an->setDateCreationClub($request->get('dateCreationClub'));
         $an->setAdresse($request->get('adresse'));
         //$an->setDateA() = new DateTime();
        // $an->setDateA(new \DateTime());
         $an->setImageClub($request->get('imageClub'));
         $an->setIdEtablissement($request->get('idEtablissement'));
       //  $an->setEtat("nonResolue");

         $em->persist($an);
         $em->flush();
         $serializer = new Serializer([new ObjectNormalizer()]);
         $formatted = $serializer->normalize($an);
         return new JsonResponse($formatted);*/


    }

    public function removeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $store=$em->getRepository("UserBundle:Club")->find($id);
        if ($store!=null){
            $em->remove($store);
            $em->flush();
        }
        return $this->redirectToRoute("afficherClub");
    }

    public function modificationClubAction(Request $request,$id)

    {

        $Uvn=$this->getDoctrine()->getRepository('UserBundle:Club')->find($id);
        $Uvn->setImageClub(null);
        $form=$this->createForm(ClubType::class,$Uvn);
        $formView=$form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())

        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($Uvn);

            //update image

            $file =  $Uvn->getImageClub();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $Uvn->setImageClub($fileName);
            // update image

            $em->flush();
            return $this->redirect($this->generateUrl('afficherClub'));
        }
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        return $this->render ( '@KidsBackend/ajouterclub.html.twig',array('form'=>$formView,'notifiableNotifications' => $allNotif));

    }

    public function ajouterevntClubAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $status = 'erreur';
        $html = 'erreur';
        if ($request->isMethod('POST'))
        {

            if($request->isXmlHttpRequest()) {

                //extraire les données de l'examen
                $titre = $request->request->get('eventName');
                $start = $request->request->get('startTime');
                $end = $request->request->get('endTime');
                //nouveau examen
                $event = new EventCustom();
                $event->setNomEvnt($titre);
                $event->setDatedebutEvnt(new \DateTime($start));
                $event->setDatefinEvnt(new \DateTime($end));
                $event->setEtatEvnt('Active');
                $em->persist($event);
                if($event!=null){

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

    public function searchAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();


        $em = $this->getDoctrine()->getManager();
        $nomclub = $em->getRepository('UserBundle:Club')->findAll();
        if($request->isMethod('POST')){
            $club=$request->get('nomClub');
            $nomclub=$em->getRepository('UserBundle:Club')->findBy(array("nomClub"=>$club));

        }


        return $this->render('@KidsBackend/recherche.html.twig', array('form' => $nomclub,'notifiableNotifications' => $allNotif));
    }

    public function modifierCalendarAction(Request $request,$id)

    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        //modifierCalendar
        $Uvn=$this->getDoctrine()->getRepository('UserBundle:EventCustom')->find($id);
        $form=$this->createForm(EventCustomType::class,$Uvn);
        $formView=$form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($Uvn);
            $em->flush();
            return $this->redirect($this->generateUrl('calendrierClub'));
        }


        return $this->render ( '@KidsBackend/ajouterevntClub.html.twig',array('form'=>$formView,'notifiableNotifications' => $allNotif));

    }

    public function supprimerEvntCalendarAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $store=$em->getRepository("UserBundle:EventCustom")->find($id);
        if ($store!=null){
            $em->remove($store);
            $em->flush();
        }
        return $this->redirectToRoute("afficheEvntCostom");
    }

    public function afficheEvntCostomAction ()

    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $clu=$this->getDoctrine()->getRepository('UserBundle:EventCustom')->findAll();
        return $this->render ( '@KidsBackend/afficherEvntCostom.html.twig',array('form'=>$clu,'notifiableNotifications' => $allNotif));

    }


    public function ajouterEvntCalendarClubAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $cat = new EventCustom();
        $form=$this->createForm(EventCustomType::class,$cat);
        $formView=$form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())

        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            return $this->redirect($this->generateUrl('calendrierClub'));
        }


        return $this->render ( '@KidsBackend/ajouterevntClub.html.twig',array('form'=>$formView,'notifiableNotifications' => $allNotif));


    }


}