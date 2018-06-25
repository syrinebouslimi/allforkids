<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Gallerie;
use UserBundle\Form\GallerieType;

class GallerieController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function ajouterGallerieImageAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $etablis = $em->getRepository('UserBundle:Etablissement')->findBy(
            array(
                'idUserEtablissement' => $user
            ));
        $gallerie = new Gallerie();

        $form = $this->createForm(GallerieType::class, $gallerie);

        $formview = $form->createView();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $imagefile = $gallerie->getImageGallery();
            $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();

            $imagefile->move($this->getParameter('images_directory'), $fileName);

            $gallerie->setImageGallery($fileName);

            $etablisNew = $em->getRepository('UserBundle:Etablissement')->find($request->get('idEtab'));

            $gallerie->setEtablissementId($etablisNew);

            $save = $this->getDoctrine()->getManager();
            $save->persist($gallerie);
            $save->flush();
            return $this->redirectToRoute('affichergalleriePres');

        }

        return $this->render('@KidsFront/ajoutergallerie.html.twig', array('form' => $formview, 'e' => $etablis));

    }

    public function affichergallerieAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();

        $etablissementId = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement' => $id));
        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->findBy(array('etablissementId' => $etablissementId));
        return $this->render('@KidsFront/afficherimagegallerie.html.twig', array('gallerie' => $gallerie));

    }

    public function affichergalleriePresAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();

        $etablissementId = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement' => $id));
        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->findBy(array('etablissementId' => $etablissementId));
        return $this->render('@KidsFront/afficherimagegallerieprestataire.html.twig', array('gallerie' => $gallerie));

    }



    public function afficherimagepourmodifierAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();

        $etablissementId = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement' => $id));
        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->findBy(array('etablissementId' => $etablissementId));

        return $this->render('@KidsFront/afficherimagespourmodifier.html.twig', array('gallerie' => $gallerie));

    }

    public function modifierimagebyidAction(Request $request, $id)
    {


        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $etablis = $em->getRepository('UserBundle:Etablissement')->findBy(
            array(
                'idUserEtablissement' => $user
            ));

        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->find($id);
        $imageOld = $gallerie->getImageGallery();

        $form = $this->createForm(GallerieType::class, $gallerie);
        $formView = $form->createView();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imagefile = $gallerie->getImageGallery();

            if (is_null($imagefile)) {
                $gallerie->setImageGallery($imageOld);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('affichergallerie');
            } else
                if (!is_null($imagefile)) {
                    $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();

                    $imagefile->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );


                    $gallerie->setImageGallery($fileName);

                    $em = $this->getDoctrine()->getManager();
                    $em->flush();
                    return $this->redirectToRoute('affichergalleriePres');
                }
        }
        return $this->render('@KidsFront/ajoutergallerie.html.twig', array('form' => $formView, 'e' => $etablis));
    }

    public function afficherimagepoursupprimerAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
//
        $etablissementId = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement' => $id));


        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->findBy(array('etablissementId'=>$etablissementId));

        return $this->render('@KidsFront/afficheimagepoursupprimer.html.twig', array('image' => $gallerie));


    }

    public function supprimerimageparidAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $gallerie = $this->getDoctrine()->getRepository('UserBundle:Gallerie')->find($id);
        $em->remove($gallerie);

        $em->flush();
        return $this->redirectToRoute('affichergalleriePres');
    }


}


