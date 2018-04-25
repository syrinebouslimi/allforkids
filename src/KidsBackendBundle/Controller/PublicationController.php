<?php

namespace KidsBackendBundle\Controller;

use UserBundle\Entity\CategoriePublication;
use UserBundle\Entity\Publication;
use UserBundle\Entity\TypePublication;
use UserBundle\Form\CategoriePublicationType;
use UserBundle\Form\PublicationType;
use UserBundle\Form\TypePublicationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class PublicationController extends Controller
{

    public function testAction()
    {
        return $this->render('test.html.twig');
    }

    //**************************** All about publication *******************************************/
    public function creerpubAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();


        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);
        $formView = $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagefile = $publication->getImagePublication();
            $videofile = $publication->getContenuPublication();

            $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();
            $fileName1 = md5(uniqid()) . '.' . $videofile->guessExtension();

            $imagefile->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $videofile->move(
                $this->getParameter('videos_directory'),
                $fileName1
            );
            $publication->setImagePublication($fileName);
            $publication->setContenuPublication($fileName1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();
            return $this->forward('KidsBackendBundle:Publication:afficherpub');
        }
        return $this->render('@KidsBackend/CreerPublication.html.twig', array('form' => $formView,'notifiableNotifications' => $allNotif));
    }
    public function afficherpubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->findAll();

        return $this->render('@KidsBackend/AfficherPublication.html.twig', array('publication' => $publication,'notifiableNotifications' => $allNotif));
    }

    public function supprimerpubparidAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->find($id);
        $em->remove($publication);
        $em->flush();
        return $this->forward('KidsBackendBundle:Publication:afficherpub');
    }

    public function modifierpubparidAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->find($id);
        $imageOld =$publication->getImagePublication();
        $videoOld = $publication->getContenuPublication();

        $form = $this->createForm(publicationType::class, $publication);
        $formView = $form->createView();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $imagefile = $publication->getImagePublication();
            $videofile = $publication->getContenuPublication();

            if(is_null($imagefile) or is_null($videofile))
            {
                $publication->setContenuPublication($videoOld);
                $publication->setImagePublication($imageOld);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->forward('KidsBackendBundle:Publication:afficherpub');
            }else
                if(!is_null($imagefile) or !is_null($videofile))
                {
                    $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();
                    $fileName1 = md5(uniqid()) . '.' . $videofile->guessExtension();

                    $imagefile->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                    $videofile->move(
                        $this->getParameter('videos_directory'),
                        $fileName1
                    );

                    $publication->setImagePublication($fileName);
                    $publication->setContenuPublication($fileName1);

                    $em = $this->getDoctrine()->getManager();
                    $em->flush();
                    return $this->forward('KidsBackendBundle:Publication:afficherpub');
                }
        }
        return $this->render('@KidsBackend/CreerPublication.html.twig', array('form' => $formView,'notifiableNotifications' => $allNotif));
    }

    public function recherchePubTitreAction(Request $request)
    {
        $search = $request->query->get('search');
        $publication= $this->getDoctrine()->getRepository('UserBundle:Publication')->findBy(array('nomPublication'=>$search));

        if (strlen($search)!=0){

            return $this->render('@KidsBackend/AfficherPublication.html.twig',array('publication'=>$publication));

        } else {
            return  $this->redirectToRoute('KidsBackendBundle:Publication:afficherpub');
        }
    }


    //**************************** All about type publication *******************************************/
    public function creertypepubAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $typePub = new typePublication();
        $form = $this->createForm(typePublicationType::class, $typePub);
        $formView = $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typePub);
            $em->flush();
        }
        $typePublication = $this->getDoctrine()->getRepository('UserBundle:TypePublication')->findAll();

        return $this->render('@KidsBackend/CreerTypePublication.html.twig', array('typePublication' => $typePublication, 'form' => $formView,'notifiableNotifications' => $allNotif));
    }

    public function supprimertypepubparidAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $typePublication = $this->getDoctrine()->getRepository('UserBundle:TypePublication')->find($id);
        $em->remove($typePublication);
        $em->flush();
        return $this->forward('KidsBackendBundle:Publication:creertypepub');
    }

    //**************************** All about categorie publication *******************************************/
    public function creercategoriepubAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $categoriePub = new categoriePublication();
        $form = $this->createForm(categoriePublicationType::class, $categoriePub);
        $formView = $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriePub);
            $em->flush();
        }
        $categoriePublication = $this->getDoctrine()->getRepository('UserBundle:CategoriePublication')->findAll();

        return $this->render('@KidsBackend/CreerCategoriePublication.html.twig', array('categoriePublication' => $categoriePublication, 'form' => $formView,'notifiableNotifications' => $allNotif));
    }

    public function supprimercategorieparidAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categoriePublication = $this->getDoctrine()->getRepository('UserBundle:CategoriePublication')->find($id);
        $em->remove($categoriePublication);
        $em->flush();
        return $this->forward('KidsBackendBundle:Publication:creercategoriepub');
    }
}