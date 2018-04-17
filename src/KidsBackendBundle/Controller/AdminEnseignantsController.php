<?php

namespace KidsBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminEnseignantsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }



    public function afficherAllEnseignantAction()
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $enseignant = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->findAll();

        return $this->render('@KidsBackend/afficherallenseignant.html.twig', array('enseignant' => $enseignant, 'notifiableNotifications' => $allNotif));
    }

    public function afficherEnseignantbyidAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $enseignant = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->find($id);

        return $this->render('@KidsBackend/detailenseignantparid.html.twig', array('enseignant' => $enseignant, 'notifiableNotifications' => $allNotif));
    }


}
