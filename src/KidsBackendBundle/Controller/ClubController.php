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
        return $this->render('@KidsBackend/listeclub.html.twig');

    }

    public function calendrierClubAction()
    {

        $em=$this->getDoctrine()->getManager();
        $evnt=$em->getRepository('UserBundle:EventCustom')->findAll();
        $evntserv=$em->getRepository('UserBundle:Service')->findAll();
        $publica=$em->getRepository('UserBundle:Publication')->findAll();

        return $this->render('KidsBackendBundle::calendar.html.twig',array('events'=>$evnt,'service'=>$evntserv,'publication'=>$publica));
    }

    public function ajouterClubAction(Request $request)
    {
        $Cl = new Club();
        $form=$this->createForm(ClubType::class,$Cl);
        $formView=$form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())

        {

            $em=$this->getDoctrine()->getManager();

            $adresse = new GeocoderAddressRequest($Cl->getAdresse());
          //  var_dump($adresse);
            $reponse = $this->container->get('ivory.google_map.geocoder')->geocode($adresse);
            if(count($reponse->getResults()) < 1)
            {
                $reponse = $this->container->get('ivory.google_map.geocoder')->geocode($adresse);
              //  var_dump('sss');
            }
  //  var_dump($reponse->getResults());
  //  die();
            foreach ($reponse->getResults() as $result) {
                $placeId = $result->getPlaceId();
                $geometry = $result->getGeometry();

            }

            $lat=$geometry->getBound()->getSouthWest()->getLatitude();
            $lang=$geometry->getBound()->getSouthWest()->getLongitude();
            $Cl->setLat($lat);
            $Cl->setLong($lang);
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


        return $this->render ( '@KidsBackend/ajouterclub.html.twig',array('form'=>$formView));


    }

    public function afficherClubAction ()

    {
        $clu=$this->getDoctrine()->getRepository('UserBundle:Club')->findAll();
        return $this->render ( '@KidsBackend/afficherClub.html.twig',array('form'=>$clu));

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


        return $this->render ( '@KidsBackend/ajouterclub.html.twig',array('form'=>$formView));

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
        $nomclub = $em->getRepository('UserBundle:Club')->findAll();
         if($request->isMethod('POST')){
          $club=$request->get('nomClub');
          $nomclub=$em->getRepository('UserBundle:Club')->findBy(array("nomClub"=>$club));

         }


        return $this->render('@KidsBackend/recherche.html.twig', array('form' => $nomclub));
    }

    public function modifierCalendarAction(Request $request,$id)

    {

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


        return $this->render ( '@KidsBackend/ajouterevntClub.html.twig',array('form'=>$formView));

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
        $clu=$this->getDoctrine()->getRepository('UserBundle:EventCustom')->findAll();
        return $this->render ( '@KidsBackend/afficherEvntCostom.html.twig',array('form'=>$clu));

    }


    public function ajouterEvntCalendarClubAction(Request $request)
    {
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


        return $this->render ( '@KidsBackend/ajouterevntClub.html.twig',array('form'=>$formView));


    }


}