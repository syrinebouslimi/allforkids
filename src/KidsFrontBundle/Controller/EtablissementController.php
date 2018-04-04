<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Enseignant;
use UserBundle\Entity\Etablissement;
use UserBundle\Form\EnseignantType;
use UserBundle\Form\EtablissementType;

class EtablissementController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('UserBundle:User')->findAll();
        return $this->render('KidsFrontBundle::Template_User.html.twig', array('u' => $users));

    }

    public function contactAction()
    {
        return $this->render('@KidsFront/contact.html.twig');

    }

    public function etablissementsAction()
    {
        return $this->render('@KidsFront/etablissements.html.twig');

    }

    public function acceuilAction()
    {
        return $this->render('::acceuil.html.twig');

    }

    public function ajouterEtablissement1Action(Request $request)
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $formview = $form->createView();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $id = $user->getId();
//            var_dump($id);
//            die($id);
            $affectedUser = $this->getDoctrine()->getRepository('UserBundle:User')->findOneBy(array('id'=>$id));
            $etablissement ->setIdUserEtablissement($affectedUser);

            $imagefile = $etablissement->getImageEtablissement();
            $fileName = md5(uniqid()).'.'.$imagefile ->guessExtension();
            $imagefile ->move($this->getParameter('images_directory'), $fileName);
            $etablissement->setImageEtablissement($fileName);

            $save = $this->getDoctrine()->getManager();

//            $this->get('session')->getFlashBag()->add(
//                'notice',
//                'Patient ajouté avec succée');

            $save->persist($etablissement);
            $save->flush();
            return $this->redirectToRoute('parent_page');

        }

        return $this->render('@KidsFront/ajouteretablissementcheckout1.html.twig',array('form' => $formview));
    }



    public function ajouterEnseignantAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();

        $enseignant = new Enseignant();

        $form = $this->createForm(EnseignantType::class, $enseignant,array('data' => $id));
        $formview = $form->createView();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $imageEnse = $enseignant->getImageEnseignant();
            $fileName = md5(uniqid()).'.'.$imageEnse ->guessExtension();
            $imageEnse ->move($this->getParameter('images_directory'), $fileName);
            $enseignant->setImageEnseignant($fileName);

            $save = $this->getDoctrine()->getManager();

//            $this->get('session')->getFlashBag()->add(
//                'notice',
//                'Patient ajouté avec succée');

            $save->persist($enseignant);
            $save->flush();
            return $this->redirectToRoute('parent_page');

        }

        return $this->render('@KidsFront/ajouterenseignant.html.twig',array('form' => $formview));

    }

    public function ajouterEtablissement3Action()
    {
        return $this->render('@KidsFront/ajouteretablissementcheckout3.html.twig');

    }

    public function afficherprofAction()
    {
        return $this->render('@KidsFront/teachers.html.twig');

    }

    public function afficherdetailprofAction()
    {
        return $this->render('@KidsFront/teacherdetail.html.twig');

    }


}
