<?php

namespace KidsBackendBundle\Controller;

use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{


    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        return $this->render('KidsBackendBundle::Template_Admin.html.twig', array('notifiableNotifications' => $allNotif));

    }

    public function getNotificationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        return $this->render('@KidsBackend/notification.html.twig', array('notifiableNotifications' => $allNotif));

    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function sendNotificationAction(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');
        $notif->setLink('http://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('Notification subject','Some random text','http://google.fr');

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        try {
            $manager->addNotification(array($this->getUser()), $notif, true);
        } catch (OptimisticLockException $e) {
        }


        return $this->redirectToRoute('homepage');
    }


}
