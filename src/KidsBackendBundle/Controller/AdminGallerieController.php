<?php

namespace KidsBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
