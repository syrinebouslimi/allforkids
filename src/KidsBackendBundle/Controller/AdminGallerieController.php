<?php

namespace KidsBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminGallerieController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function afficherAllGallerieAction()
    {
        $em=$this->getDoctrine()->getManager();

        $etablis = $em->getRepository('UserBundle:Etablissement')->findAll();


        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->findAll();


        return $this->render('@KidsBackend/afficherallgallerie.html.twig', array('gallerie' => $gallerie, 'notifiableNotifications' => $allNotif, 'etab'=>$etablis));
    }

    public function afficherGallerieByEtabAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $etablis = $em->getRepository('UserBundle:Etablissement')->findAll();

        $option = $request->query->get('idEtab');
        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->findBy(array(
            'etablissementId' => $option));

        if ($option != "Voir tout"){
            return $this->render('@KidsBackend/afficherfiltredgallerie.html.twig', array('gallerie' => $gallerie,  'notifiableNotifications' => $allNotif,'etab'=>$etablis));

        } else {
           return $this->redirectToRoute('afficherAllGallerie');


        }






//        if (strlen($search) != 0) {
//            return $this->render('@KidsBackend/afficheralletablissement.html.twig', array('etablissement' => $etablissement,  'notifiableNotifications' => $allNotif));
//
//        } else {
//            return $this->redirectToRoute('afficherAllEtablissement');
//
//        }





//        $em=$this->getDoctrine()->getManager();
//
//        $etablis = $em->getRepository('UserBundle:Etablissement')->findAll();
//
//
//        $em = $this->getDoctrine()->getManager();
//        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
//
//        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->findAll();
//
//        return $this->render('@KidsBackend/afficherallgallerie.html.twig', array('gallerie' => $gallerie, 'notifiableNotifications' => $allNotif, 'etab'=>$etablis));
    }
}
