<?php

namespace KidsBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

class AdminEtablissementController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }


    public function afficherAllEtablissementAction()
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findBy(array('etat'=>'valide'));

        return $this->render('@KidsBackend/afficheralletablissement.html.twig', array('etablissement' => $etablissement, 'notifiableNotifications' => $allNotif));
    }

    public function afficherINPEtablissementAction()
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findBy(array('etat'=>'in progress'));

        return $this->render('@KidsBackend/afficherinpetablissement.html.twig', array('etablissement' => $etablissement, 'notifiableNotifications' => $allNotif));
    }

    public function accepterEtablissementAction($id){

        $em = $this->getDoctrine()->getManager();
        $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('id'=>$id));
        $etablissement->setEtat("valide");
        $em->flush();
        return $this->redirectToRoute('afficherINPEtablissement');
    }

    public function refuserEtablissementAction($id){

        $em = $this->getDoctrine()->getManager();
        $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('id'=>$id));
        $etablissement->setEtat("invalide");
        $em->flush();
        return $this->redirectToRoute('afficherINPEtablissement');

    }



    public function afficherEtablissementbyidAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->find($id);

        return $this->render('@KidsBackend/detailetablissementparid.html.twig', array('etablissement' => $etablissement, 'notifiableNotifications' => $allNotif));
    }



    public function afficheretablissementparsearchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();


        $search = $request->query->get('search');
        $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findBy(array(
            'nomEtablissement' => $search));

        if (strlen($search) != 0) {
            return $this->render('@KidsBackend/afficheralletablissement.html.twig', array('etablissement' => $etablissement,  'notifiableNotifications' => $allNotif));

        } else {
            return $this->redirectToRoute('afficherAllEtablissement');

        }


    }
}
