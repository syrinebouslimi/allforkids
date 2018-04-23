<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\ActiviteEnfant;
use UserBundle\Entity\ProfilEnfant;
use UserBundle\Form\ActiviteEnfantType;
use UserBundle\Form\ProfilEnfantType;


class EspaceEnfantController extends Controller
{

    public function afficherespaceenfantAction()
    {
        $profil = $this->getDoctrine()->getRepository('UserBundle:ProfilEnfant')->findAll();

        return $this->render('KidsFrontBundle::EspaceEnfant.html.twig', array('profil' => $profil));
    }

    public function creerespaceAction(Request $request)
    {
        $profil = new ProfilEnfant();
        $form = $this->createForm(ProfilEnfantType::class, $profil);
        $formView = $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagefile = $profil->getPhotoEnfant();

            $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();

            $imagefile->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $profil->setPhotoEnfant($fileName);

            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $iduser = $user->getId();
            $profil->setIdUserProfileEnfant($user);
            $em->persist($profil);
            $em->flush();
            return $this->forward('KidsFrontBundle:EspaceEnfant:afficherespaceenfant');
        }
        return $this->render('KidsFrontBundle::CreerEspaceEnfant.html.twig', array('form' => $formView));
    }

    public function espacedetailsAction($id)
    {
        $profil = $this->getDoctrine()->getRepository('UserBundle:ProfilEnfant')->find($id);
        $profil1 = $this->getDoctrine()->getRepository('UserBundle:ActiviteEnfant')->findAll();

        return $this->render('KidsFrontBundle::EspaceEnfantDetails.html.twig', array('profil'=>$profil, 'profill' =>$profil1));
    }

    public function creeractiviteAction(Request $request, $id)
    {
        $activite = new ActiviteEnfant();
        $form = $this->createForm(ActiviteEnfantType::class, $activite);
        $formView = $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagefile = $activite->getContenuActivite();

            $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();

            $imagefile->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $activite->setContenuActivite($fileName);

            $em = $this->getDoctrine()->getManager();
            $profil = $this->getDoctrine()->getRepository('UserBundle:ProfilEnfant')->find($id);

            $activite->setIdProfileEnfant($profil);
            $em->persist($activite);
            $em->flush();
            return $this->forward('KidsFrontBundle:EspaceEnfant:afficherespaceenfant');
        }
        return $this->render('KidsFrontBundle::CreerActiviteEnfant.html.twig', array('form' => $formView));
    }
}
